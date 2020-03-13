<?php
    function reserveCourse($param){
        require_once('../db/sql_connect.php');   // points to the correct file
        $sql = "INSERT INTO reservations (`id_client`,`id_course`,`date`) VALUES (?,?,?)";
        if($statement = $mysqli->prepare($sql)){
            if($statement->bind_param('iis',$param['id_client'],$param['book_id'],$param['date'])){
                $statement->execute();
                $mysqli->query("UPDATE courses SET number = number + 1 WHERE id = ".$param['book_id'] ); 
                echo json_encode("OK");    
            }
        }
    }
?>