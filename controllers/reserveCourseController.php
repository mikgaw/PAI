<?php
session_start();
    require_once('../src/reserveCourse.php'); // points to the correct file
    $method = $_SERVER["REQUEST_METHOD"];
    if($method == "POST"){
        $param = array_merge($_POST,['id_client' => $_SESSION['loggedUser']]);
        reserveCourse($param);
    }
