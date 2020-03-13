<?php
session_start();
    require_once('../models/User.php');
    class loginUserController{
       public static function passLoginUser($param){
            User::loginUser($param);
       }
    }
    $method = $_SERVER["REQUEST_METHOD"];
    if($method == "POST" && isset($_POST["email"])){
       loginUserController::passloginUser($_POST);
    }
