<?php
include_once '../../includes/constants.php';
include_once '../../includes/propietario.php';
propietario::esPropietarioLogueado();
$inmueble = $_GET['inmueble'];
$apto = $_GET['hangar'];

ob_start();
include './estadoDeCuenta.php';
$content = ob_get_clean();

require_once '../../includes/html2pdf/html2pdf.class.php';

try
{
    $html2pdf = new HTML2PDF('P', 'Letter', 'fr',true,'UTF-8');
//      $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('estadodecuenta.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}