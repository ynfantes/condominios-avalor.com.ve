<?php
include_once 'includes/constants.php';

// echo $twig->render('mantenimiento.html.twig');
// die();

$result = array();
$password = '';
$apto   = '';
$propietario = new propietario();

if (isset($_POST['cedula']) && isset($_POST['password'])) {

//if (isset($_POST['submit'])) {
    $apto = filter_input(INPUT_POST,'cedula');
    $password = filter_input(INPUT_POST,'password');
    $result = $propietario->login($apto,$password, 0);    
//    if ($result['suceed']=='true') {
//        
//        if ($_SESSION['status'] == 'logueado') {
//            header("location:" . URL_SISTEMA );
//        }
//        die();
//    } else {
        echo json_encode($result);
        die();
//    }
} else {
    if (isset($_POST['email'])) {
        $result = $propietario->recuperarContraSena($_POST['email']);
        echo json_encode($result);
        die();
    }
}

echo $twig->render('login.html.twig', array("mensaje" => $result,"apto"=>$apto,"password"=>$password));