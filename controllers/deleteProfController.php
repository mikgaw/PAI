<?php
require_once('../src/deleteProf.php'); // points to the correct file
$method = $_SERVER["REQUEST_METHOD"];
if($method == "POST" && isset($_POST["id_prof"])){
    deleteProf($_POST);
}
