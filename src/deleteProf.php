<?php
function deleteProf($param){
    require_once('../db/sql_connect.php');   // points to the correct file
    $sql = "DELETE FROM professors WHERE id = ?";
    if($statement = $mysqli->prepare($sql)){
        if($statement->bind_param('i',$param['id_prof'])){
            $statement->execute();
                if($mysqli->query("DELETE FROM courses WHERE id_prof = ".$param['id_prof'])){
                    echo json_encode("OK");
             }
        }
    }
}