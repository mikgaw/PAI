<?php



function registerUser($param){
require_once('../db/sql_connect.php');   // points to the correct file
    global $mysqli;
if(!empty($param)){
    if(empty(trim($param["name"])) || empty(trim($param["surname"]))){
        header("Location: ../register.php?fail=Proszę podać imię i nazwisko!");
        exit;
    } else{
        $name_path = '/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i';
        if(strlen(trim($param['name']))<3 || strlen(trim($param['surname']))<3){
            header("Location: ../register.php?fail=imię lub nazwisko jest za krótkie!");
            exit;
        }
        else if(preg_match($name_path,trim($param['name'])) || preg_match($name_path,trim($param['surname']))){
            header("Location: ../register.php?fail=imię lub nazwisko zawiera znaki specjalne!");
            exit;
        }
    }

    if(empty(trim($param["email"]))) {
        header("Location: ../register.php?fail=Adres e-mail jest pusty");
        exit;
    } else {
      $check_email = "/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/";
      if(!preg_match($check_email, $param['email'])){
        header("Location: ../register.php?fail=Adres e-mail jest niepoprawny");
        exit;
        } else{
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
    else{
        header("Location: ../register.php?fail=Wystąpił błąd");
        exit;
    }
}
