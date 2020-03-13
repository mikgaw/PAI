<?php
session_start();
require_once('../models/User.php');

abstract class getUserDataController{
    private $data;

    public function getUserData($param){
        echo json_encode( User::getData($param));
    }
}

if($_SERVER["REQUEST_METHOD"] == "GET"){
    getUserDataController::getUserData($_SESSION);
}
