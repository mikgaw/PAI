<?php
require_once('../src/createNewProf.php'); // points to the correct file
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "POST" && isset($_POST["name"])) {
    createNewProf($_POST);
}
