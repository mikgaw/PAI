<?php
    require_once('../models/User.php');
    class registerUserController{
       public static function passRegisterUser($param){
          User::register($param);
       }
    }
    $method = $_SERVER["REQUEST_METHOD"];
    if($method == "POST" && isset($_POST["name"]) && isset($_POST["password"])){;
       registerUserController::passRegisterUser($_POST);
    }
