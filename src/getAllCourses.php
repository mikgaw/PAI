<?php
function getAllCourses(){
    require_once('../db/sql_connect.php');
        $sql = "SELECT courses.*,professors.name,professors.surname FROM courses INNER JOIN professors ON courses.id_prof = professors.id";
        $result = $mysqli->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }