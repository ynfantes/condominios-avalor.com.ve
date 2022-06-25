<?php
include_once './constants.php';
include './mailto.php';
define("SMTP_SERVER","mail.administradora-jeserla.com.ve");
define("PORT",25);
define("USER_MAIL","info@administradora-jeserla.com.ve");
define("PASS_MAIL","Jeserla5231");
define("SMTP",2);
define("Administradora Jeserla","Administradora Jeserla");
$mail = new mailto(SMTP);

$r = $mail->enviar_email(NOMBRE_APLICACION, "Este es un mensaje de prueba", '', "ynfantes@gmail.com", "Edgar Messia");

if ($r=='') {
    echo(".- Mensaje enviado a Ok!\n");
} else {
    echo(".- Mensaje enviado a Falló\n");
}
