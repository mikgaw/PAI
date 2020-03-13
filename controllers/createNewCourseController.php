<?php
require_once('../src/createNewCourse.php');
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "POST" && isset($_POST["title"])) {
    createNewCourse($_POST);
}
