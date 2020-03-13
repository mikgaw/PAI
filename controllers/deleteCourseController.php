<?php
require_once('../src/deleteCourse.php'); // points to the correct file
$method = $_SERVER["REQUEST_METHOD"];
if($method == "POST" && isset($_POST["id_course"])){
    deleteCourse($_POST);
}