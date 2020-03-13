<?php
function deleteCourse($param){
    require_once('../db/sql_connect.php');
    $sql = "DELETE FROM courses WHERE id = ?";
    if($statement = $mysqli->prepare($sql)){
        if($statement->bind_param('i',$param['id_course'])){
            $statement->execute();
            echo json_encode("OK");
        }
    }
}