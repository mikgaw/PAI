<?php
function getAllProf(){
    require_once('../db/sql_connect.php');
        $sql = "SELECT professors.*, (SELECT COUNT(*) FROM courses b WHERE professors.id = b.id_prof ) as number_of_courses FROM professors";
        $result = $mysqli->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }