<?php

function createNewCourse($param){
    require_once('../db/sql_connect.php');
    $sql = "INSERT INTO courses (`title`,`id_prof`,`description`,`number`) VALUES (?,?,?,?)";
    if ($statement = $mysqli->prepare($sql)) {
        if ($statement->bind_param('sisi', $param['title'], $param['id_prof'], $param['description'], $param['number'] = 0)) {
            $statement->execute();
            echo json_encode("OK");
        }
    } else {
        die('Niepoprawne zapytanie' . $mysqli->err_message());
    }

}
