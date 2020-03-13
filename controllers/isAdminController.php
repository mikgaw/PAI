<?php

require_once('../src/isAdmin.php');
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "POST"){
    echo(json_encode(isAdmin($_POST)));
}



