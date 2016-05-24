<?php
require "../../../php/mysql_report.php";
session_start();
$datodb[server] = "localhost";
$datodb[usuario] = "colescri";
$datodb[contra] = "colesfor753";
$datodb[nombre] = "colescri_consultas";

$where="where ".$_SESSION['where_personas'];

$sql="select tabla08_talla as Apellido, tabla08_nombre as Nombre,
		tabla08_nombre as Departamento, tabla08_nombre as Localidad,
		tabla08_color as Matricula, tabla07_nrodoc as DNI,
		tabla11_nombre as Categoria 
		from tabla_12_cuenta_corriente  
		left outer join tabla_09_localidades on id_tabla12=rela_tabla09
		left outer join tabla_10_departamentos on id_tabla10=rela_tabla10
		left outer join tabla_11_categoria  on id_tabla11=rela_tabla11
		$where order by tabla08_talla DESC";
$pdf = new PDF('L','pt','A4');
$pdf->SetFont('Arial','',10);
$pdf->connect($datodb[server],$datodb[usuario],$datodb[contra],$datodb[nombre]);
$attr = array('titleFontSize'=>18, 'titleText'=>'Listado de Escribanos');

$pdf->mysql_report($sql,false,$attr);
$pdf->Output();

?>