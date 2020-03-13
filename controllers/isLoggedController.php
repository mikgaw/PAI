<?php
    $isLogged = $_POST['isLogged'];
    $loggedUser = $_POST['loggedUser'];
    $method = $_SERVER["REQUEST_METHOD"];
    if($method == "POST"){
       if(( $isLogged==true && isset($loggedUser ) )){
         echo 'OK';
       }
    }
