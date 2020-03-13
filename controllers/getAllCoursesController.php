<?php
require_once('../src/getAllCourses.php');
    $method = $_SERVER["REQUEST_METHOD"];
    if($method == "GET"){
       echo json_encode(getAllCourses());
    }

