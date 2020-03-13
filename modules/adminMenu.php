<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"127.0.0.1/praca/controllers/isAdminController.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,"loggedUser=".$_SESSION['loggedUser']."&isLogged=".$_SESSION['isLogged']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);
$ans = json_decode($server_output);

if ($ans->is_admin == '1') {
   echo ' <li class="nav-item pr-3">
                <a class="nav-link" href="./admin/courses.php">PANEL ADMINISTRACYJNY</a>
           </li>';
}
