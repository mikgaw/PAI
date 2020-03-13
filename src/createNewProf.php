<?php
function createNewProf($param){
    require_once('../db/sql_connect.php');   // points to the correct file
    $sql = "INSERT INTO professors (`name`,`surname`,`specialization`) VALUES (?,?,?)";
    if($statement = $mysqli->prepare($sql)){
        if($statement->bind_param('sss',$param['name'],$param['surname'],$param['specialization'])){
            $statement->execute();
            echo json_encode("OK");
        }
    } else{
        die('Niepoprawne zapytanie'.$mysqli->err_message());
    }
}
