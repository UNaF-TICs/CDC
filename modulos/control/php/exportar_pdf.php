<?php
require "../../../php/mysql_report.php";
session_start();
$datodb[server] = 'localhost';
$datodb[usuario] = 'root';
$datodb[contra] = 'root';
$datodb[nombre] = 'sysproduccion_v2';

$where=$_SESSION['where_control'];
$pdf = new PDF('L','pt','A4');
$pdf->SetFont('Arial','',11.5);
$pdf->connect($datodb[server],$datodb[usuario],$datodb[contra],$datodb[nombre]);
$attr = array('titleFontSize'=>18, 'titleText'=>'Sistema Control - Log de Operaciones');
	$pdf->mysql_report("select tabla05_fecha as FECHA,tabla05_hora as HORA,sysform03_login as USUARIO,tabla05_accion as ACCION,tabla05_operacion as OPERACION
,sysform01_nombre as MODULO,sysform15_ip_visitante as IP from 
	(sys_form_15_det_log 
		left outer join tabla_01_usuarios on id_tabla01=rela_tabla01) 
		left outer join sys_form_01_cab_modulos on id_tabla02=rela_tabla02 
		$where
		order by tabla05_fecha DESC, tabla05_hora DESC",false,$attr);
$pdf->Output();
?>