<?php

function isAdmin($param){
    require_once('../db/sql_connect.php');
    $sql = "SELECT is_admin FROM clients WHERE id =". $param['loggedUser'];
    $result = $mysqli->query($sql);
    $rows = $result->fetch_assoc();
    return $rows;
}