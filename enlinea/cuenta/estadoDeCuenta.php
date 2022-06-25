<?php
include_once '../../includes/constants.php';
$facturas = new factura();
$result = $facturas->estadoDeCuentaDetallado($inmueble, $apto);
$totales = $facturas->totalEstadoDeCuentaPropiedad($inmueble, $apto);

$recibos = 0;
$saldo = 0;
$acumulado = 0;
$n = 0;
$pagina=1;
$limite=33;
$fecha = new DateTime();
if ($totales['suceed'] && count($totales['data'])>0) {
    $recibos = $totales['data'][0]['recibos'];
    $saldo = $totales['data'][0]['saldo'];
}
$session = $_SESSION;
?>
<page backtop="10mm" backbottom="10mm" backleft="5mm" backright="5mm">
    <page_footer>
        <table style="width: 100%;">
            <tr>
                <td style="text-align: center;"> </td>
            </tr>
            <tr><td style="text-align: right;">Página [[page_cu]]/[[page_nb]]</td></tr>
        </table>
    </page_footer>
    <div style="font-size: 28px; font-weight: bold; text-align: right">Estado de Cuenta</div>
    <div style="font-size: 20px; font-weight: bold; text-align: right; height: 8mm"><?php echo(TITULO) ?></div>
    <div style="text-align: right; font-size: 10px; height: 4mm">Fecha de Impresión: <?php echo strftime("%d/%m/%Y %I:%M %p");?></div>
    <br>
<table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 12px;">
    <tr>
        <td style="width:40%; font-weight: bold; height: 8mm; text-align: left">&nbsp;<?php echo($apto." - ".$session['usuario']['nombre']) ?></td>
        <td style="width:30%; font-weight: bold">Rec.Ven.: <?php echo $recibos ?></td>
        <td style="width:30%; text-align: right; font-weight: bold">Total a Pagar: <?php echo number_format($saldo,2,",",".") ?>&nbsp;</td>
    </tr>
</table>
<br>

<table style="width: 100%;font-size: 10px">
    <tr>
        <td style="width: 10%"></td>
        <td style="width: 80%">
    <table  cellspacing="0" style="width: 100%;border: solid 1px #000; border-bottom: solid 2px #000">
        <thead>
        <tr>
            <th style="width: 12.5%;border:1px solid #000; height: 6mm;text-align: center">Período</th>
            <th style="width: 50%;border:1px solid #000;text-align: center">Detalle</th>
            <th style="width: 12.5%;border:1px solid #000;text-align: center">Debe</th>
            <th style="width: 12.5%;border:1px solid #000;text-align: center">Haber</th>
            <th style="width: 12.5%;border:1px solid #000;text-align: center">Acumulado</th>
        </tr>
        </thead>
        
    <?php foreach ($result['data'] as $registro) { 
        if ($registro['monto']>0) { 
            $date = new DateTime($registro['periodo']);
            $n = $n + 1;
            if ($pagina > 1) {
                $limite = 39;
            }
            if ($n==$limite) {
                $n=0;
                $pagina = $pagina + 1;
                echo('</table></td><td style="width: 10%"></td></tr></table></page>');
                echo('<page pageset="old">');
                echo('<table style="width: 100%;font-size: 10px">
    <tr>
        <td style="width: 10%"></td>
        <td style="width: 80%">
    <table  cellspacing="0" style="width: 100%;border: solid 1px #000; border-bottom: solid 2px #000">
        <thead>
        <tr>
            <th style="width: 12.5%;border:1px solid #000; height: 6mm;text-align: center">Período</th>
            <th style="width: 50%;border:1px solid #000;text-align: center">Detalle</th>
            <th style="width: 12.5%;border:1px solid #000;text-align: center">Debe</th>
            <th style="width: 12.5%;border:1px solid #000;text-align: center">Haber</th>
            <th style="width: 12.5%;border:1px solid #000;text-align: center">Acumulado</th></tr></thead>');
            }
            ?>
        <tr>
        <td style="border-color: #000000;border-style:solid;height: 4mm;text-align: center;<?php if($fecha<>$date) { echo "border-width: 1px 1px 0 1px;"; } else {echo "border-width:0 1px 0 1px";}?>">
            <?php
            if ($fecha <> $date) {
                $acumulado = $acumulado + $registro['facturado'] - $registro['abonado'];
                echo date_format($date,('m-Y'));
            }
            ?>
        </td>
        <td style="border-color: #000000;border-style:solid;<?php if($fecha<>$date) { echo "border-width: 1px 1px 0 1px;"; } else {echo "border-width:0 1px 0 1px";}?>"><?php echo $registro['detalle'] ?></td>
        <td style="text-align: right;border-color: #000000;border-style:solid;<?php if($fecha<>$date) { echo "border-width: 1px 1px 0 1px;"; } else {echo "border-width:0 1px 0 1px";}?>"><?php echo number_format($registro['monto'],2,",",".") ?>&nbsp;</td>
        <td style="text-align: right;border-color: #000000;border-style:solid;<?php if($fecha<>$date) { echo "border-width: 1px 1px 0 1px;"; } else {echo "border-width:0 1px 0 1px";}?>"><?php if ($fecha <> $date) { echo number_format($registro['abonado'],2,",","."); } ?>&nbsp;</td>
        <td style="text-align: right;border-color: #000000;border-style:solid;<?php if($fecha<>$date) { echo "border-width: 1px 1px 0 1px;"; } else {echo "border-width:0 1px 0 1px";}?>"><?php if ($fecha <> $date) { echo number_format($acumulado,2,",","."); } ?>&nbsp;</td>
        </tr>
    <?php 
    if ($fecha <> $date) { $fecha = $date; }
        }} ?>
        </table>
        </td>
    <td style="width: 10%"></td>
    </tr>
</table>
</page>