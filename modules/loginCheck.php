<?php
session_start();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"127.0.0.1/praca/controllers/isLoggedController.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,"loggedUser=".$_SESSION['loggedUser']."&isLogged=".$_SESSION['isLogged']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);
if ($server_output != "OK") {
    header('Location: login.php');
}
