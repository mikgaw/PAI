<?php

function getUserData($param){
    require_once('../db/sql_connect.php');
        $sql = "SELECT id,name,surname,email,phone_number,logged_ip,is_admin FROM clients WHERE id =". $param['loggedUser'];
        $result = $mysqli->query($sql);
        $rows = $result->fetch_assoc();
        return $rows;
    }