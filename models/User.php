<?php
require_once('../db/dbClass.php');
abstract class User{
    
     public static function register( $param ){
        if(empty(trim($param["name"])) || empty(trim($param["surname"]))){
            header("Location: ../register.php?fail=Proszę podać imię i nazwisko!");
            exit;
        }
			
        $name_path = '/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i';
        if(strlen(trim($param['name']))<3 || strlen(trim($param['surname']))<3){
            header("Location: ../register.php?fail=imię lub nazwisko jest za krótkie!");
            exit;
        }
		
        if(preg_match($name_path,trim($param['name'])) || preg_match($name_path,trim($param['surname']))){
            header("Location: ../register.php?fail=imię lub nazwisko zawiera znaki specjalne!");
            exit;
        }

        if(empty(trim($param["email"]))) {
            header("Location: ../register.php?fail=Adres e-mail jest pusty");
            exit;
        } else {
          $check_email = "/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/";
          if(!preg_match($check_email, $param['email'])){
            header("Location: ../register.php?fail=Adres e-mail jest niepoprawny");
            exit;
            }

            require_once('../db/sql_connect.php');
            $sql = "SELECT id FROM clients WHERE email = ?";
            if($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param("s", $param['email']);
                if($stmt->execute()){
                    $stmt->store_result();                   
                    if($stmt->num_rows == 1){
                        header("Location: ../register.php?fail=Adres e-mail jest już zajęty");
                        exit;
                    }
                } else{
                    header("Location: ../register.php?fail=Wystąpił błąd, spróbuj ponownie");
                    exit;
                }
            }
		
		    if(strlen(trim($param["password"])) < 6){
                header("Location: ../register.php?fail=Hasło musi się składać co najmniej z 6 znaków");
                exit;
            }
            if(empty(trim($param["confirm_password"]))){
                header("Location: ../register.php?fail=Proszę potwierdzić hasło");
                exit;    
            } else{
                $param['confirm_password'] = trim($param["confirm_password"]);
                if(($param['password']!= $param['confirm_password'])){
                    header("Location: ../register.php?fail=Hasła nie pasują do siebie");
                    exit;
                }
            }
        
            if(strlen($param['phone_number'])!=9){
                header("Location: ../register.php?fail=Niepoprawny numer telefonu");
                exit;
            }
                $code = md5($param['email']);
                $sql = "INSERT INTO clients (name, surname, password,email,phone_number,code) VALUES (?, ?, ?, ?, ?, ?)";
                 
                if($stmt = $mysqli->prepare($sql)){
                    $param['password'] = hash('whirlpool',$param['password']);
                    $stmt->bind_param("ssssss", $param['name'], $param['surname'],$param['password'],$param['email'],$param['phone_number'],$code);
        
                    if($stmt->execute()){
                        require_once '../mailtest.php';
                       header("Location: ../login.php?done=Na podany adres został wysłany link aktywacyjny");
                       exit;
                    } else{
                        header("Location: ../register.php?fail=Wystąpił błąd");
                        exit;
                    }
            }
        }
    }
    public static function getData($param){
        $sql = new DB();
        $result = $sql->select_where(['id','name','surname','email','phone_number'],'clients','id',$param['loggedUser']);
        return $result[0];
    }
    public static function loginUser($param){
        session_start();
        require('../db/sql_connect.php');
        if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true) {
            header("Location: ../index.php"); 
        }
        else if (empty($param['email']) || empty($param['password'])) {
            header("Location:../login.php?fail=Podaj login i hasło"); 
            exit;
        }
        
        $sql = "SELECT id,password FROM clients WHERE email = ?";
        if ($statement = $mysqli->prepare($sql)) {
            if ($statement->bind_param('s', $param['email'])) {
                $statement->execute();
                $result = $statement->get_result();
                $row = $result->fetch_row();
                $user_password = $row[1];
                $user_id = $row[0];
                $param['password'] = hash('whirlpool',$param['password']);
                if ($user_password == $param['password']) {
                    $ipAddress = $_SERVER['REMOTE_ADDR'];
                    $sql = "UPDATE clients SET logged_ip = ? WHERE email = ?";
                    if($stmt = $mysqli->prepare($sql)){
                        $stmt->bind_param("ss",$ipAddress ,$param['email']);
                        if($stmt->execute()){
                            session_start();
                            $_SESSION['isLogged'] = true;
                            $_SESSION['loggedUser'] = $user_id;
                            header("Location: ../index.php"); 
                            exit;
                        } else {
                            header("Location: ../login.php?fail=Wystąpił błąd");
                            exit;
                        }
                    }
                } else {
                    header("Location:../login.php?fail=Błędny login lub hasło"); 
                    exit;
                }
            }
            $mysqli->close();
        } else {
            header("Location:../login.php?fail=Wystąpił błąd"); 
            exit;
        }
    }
}
