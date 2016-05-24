<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
require "../../../php/fpdf16/fpdf.php";
session_start();
$where=$_SESSION['where_control'];
//Select the Products you want to show in your PDF file
$sql="select tabla05_fecha,tabla05_hora,sysform03_login,tabla05_accion,tabla05_accion,tabla05_operacion
sysform01_nombre,sysform15_ip_visitante from 
	(sys_form_15_det_log 
		left outer join tabla_01_usuarios on id_tabla01=rela_tabla01) 
		left outer join sys_form_01_cab_modulos on id_tabla02=rela_tabla02 
		$where
		order by tabla05_fecha DESC, tabla05_hora DESC";
$result = mysql_query($sql,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{

//Initialize the 3 columns and the total
$column_fecha_hora= "";
$column_usuario = "";
$column_accion = "";
$column_operacion = "";
$column_resultado = "";
$column_modulo = "";
$column_visitante = "";

//For each row, add the field to the corresponding column
	while($row = mysql_fetch_array($result))
	{
		$fecha_hora = $row["tabla05_fecha"]." - ".substr($row["tabla05_hora"],0,8);
		$usuario = $row["sysform03_login"];
		$accion = $row["tabla05_accion"];
		$operacion = $row["tabla05_operacion"];
		$resultado  = $row["tabla05_operacion"];
		$modulo = $row["sysform01_nombre"];
		$visitante=$row["sysform15_ip_visitante"];
	
		$column_fecha_hora = $column_fecha_hora.$fecha_hora."\n";
		$column_usuario = $column_usuario.$usuario."\n";
		$column_accion = $column_accion.$accion."\n";
		$column_operacion = $column_operacion.$operacion."\n";
		$column_resultado = $column_resultado.$resultado."\n";
		$column_modulo = $column_modulo.$modulo."\n";
		$column_visitante = $column_visitante.$visitante."\n";
	}
}
mysql_close();
//Create a new PDF file
$pdf=new FPDF();
$pdf->AddPage();
//Fields Name position
$Y_Fields_Name_position = 20;
//Table position, under Fields Name
$Y_Table_Position = 26;
//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(45);
$pdf->Cell(20,6,'Fecha - Hora',1,0,'L',1);
$pdf->SetX(65);
$pdf->Cell(100,6,'Usuario',1,0,'L',1);
$pdf->SetX(135);
$pdf->Cell(30,6,'Acción',1,0,'R',1);
$pdf->SetX(145);
$pdf->Cell(30,6,'Operación',1,0,'R',1);
$pdf->SetX(155);
$pdf->Cell(30,6,'Resultado',1,0,'R',1);
$pdf->SetX(165);
$pdf->Cell(30,6,'Módulo',1,0,'R',1);
$pdf->SetX(175);
$pdf->Cell(30,6,'IP',1,0,'R',1);
$pdf->Ln();
//Now show the 3 columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(45);
$pdf->MultiCell(20,6,$column_fecha_hora,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(65);
$pdf->MultiCell(100,6,$column_usuario,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
$pdf->MultiCell(30,6,$column_accion,1,'R');
$pdf->SetX(145);
$pdf->MultiCell(30,6,$column_operacion,1,'R');
$pdf->SetX(155);
$pdf->MultiCell(30,6,$column_resultado,1,'R');
$pdf->SetX(165);
$pdf->MultiCell(30,6,$column_modulo,1,'R');
$pdf->SetX(175);
$pdf->MultiCell(30,6,$column_visitante,1,'R');
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $num_rows)
{
    $pdf->SetX(45);
    $pdf->MultiCell(120,6,'',1);
    $i = $i +1;
}
$pdf->Output();
?>