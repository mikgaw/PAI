<?php

function loginUser($param){
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
                        header("Location: ../index.php"); //TODO: change url
                        exit;
                    } else {
                        header("Location: ../login.php?fail=Wystąpił błąd");
                        exit;
                    }
                }
            } else {
                header("Location:../login.php?fail=Błędny login lub hasło"); //TODO: change url
                exit;
            }
        }
        $mysqli->close();
    } else {
        header("Location:../login.php?fail=Wystąpił błąd"); //TODO: change url
        exit;
    }
}


?>

