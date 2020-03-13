<?php
error_reporting(E_ERROR | E_PARSE);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

    /* Server settings */
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      /* Enable verbose debug output */
    $mail->isSMTP();
    $mail->SMTPSecure = 'ssl';
    /* Send using SMTP */
    $mail->Host       = 'ssl://smtp.poczta.onet.pl';                    /* Set the SMTP server to send through */
    $mail->SMTPAuth   = true;                                   /* Enable SMTP authentication */
    $mail->Username   = 'lokalna.biblioteka@onet.pl';                     /* SMTP username */
    $mail->Password   = 'bibliotekaLokalna1';                               /* SMTP password */
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         /* Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted */
    $mail->Port       = 465;
/* Recipients */
    $mail->setFrom('lokalna.biblioteka@onet.pl', 'Biblioteka');
    $mail->addAddress($param['email'], $param['name']);     /* Add a recipient */
    $mail->addReplyTo('lokalna.biblioteka@onet.pl', 'Biblioteka');

    /* Content */
    $mail->isHTML(true);                                  /* Set email format to HTML */
    $mail->Subject = 'Rejestracja w serwisie';
    $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url = str_replace('controllers/registerUserController.php','confirm.php',$url);
    $mail->Body    = '
    <div style="height:100vh;background-color:#EDEDED;">
        <h2 style="padding-top:50px;margin:0 auto;text-align: center;">Dziękujemy za rejestrację w bibliotece</h2>
        <p style="padding-top:50px;margin:0 auto;text-align: center;">Twoje konto zostało założone. Potwierdź teraz swoją tożsamość klikając w poniższy link aktywacyjny lub wklejając jego zawartość w pasku adresu: </p>
        <div style="text-align:center;display:flex;align-items: center;justify-content:center;height:100px;margin-top:200px;background:white;">
        <a href="'.$url.'?confirm='.$code.'" style="padding-top:25px;margin:0 auto;text-decoration: underline;color:blue;">'.$url.'?'.$code.'</a>
</div>
    </div>

';
    $mail->AltBody = 'Wystąpiły problemy z mailem';

    $mail->send();
    echo('<Script>document.body.innerHTML=" "; location.href=location.href.replace("controllers/registerUserController.php","login.php?done=Wyslano link atywacyjny");</script>');

