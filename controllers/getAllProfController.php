<?php
require_once('../src/getAllProf.php');
    $method = $_SERVER["REQUEST_METHOD"];
    if($method == "GET"){
       echo json_encode(getAllProf());
    }

