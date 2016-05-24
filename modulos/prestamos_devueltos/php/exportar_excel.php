<?php
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
require_once "../../../php/funciones_comunes.php";
session_start();
$tipo=$_GET['tipo'];

if ($tipo!="")
{
	if ($tipo=="xls")
	{
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=personas_".date("d-m-Y").".xls");
		set_time_limit(0);
		ob_implicit_flush();
	}
}else{
	set_time_limit(0);
	ob_implicit_flush();
}
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_reporte.html",
	"un"		=> "un_reporte.html",
	));
	
$fecha_actual=date('d-m-Y');
$t->set_var("fecha_actual",$fecha_actual);	
	
if ($_SESSION['where_titulos']!="")
{	
	$where="where ".$_SESSION['where_titulos'];
}else{
	$where="";
}

$sql="select * from tabla_12_prestamos 
inner join tabla_10_libros on id_tabla10 = rela_tabla10
inner join tabla_07_personas on id_tabla07 = rela_tabla07
		$where and tabla12_fecha_devolucion is not null
		order by id_tabla12 ASC ";
$result = mysql_query($sql,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{
	
	$t->set_var("cantidad",$num_rows);
	while ($row = mysql_fetch_assoc($result))
	{


		$id_tabla12=$row["id_tabla12"];
		$t->set_var("rela_tabla10",$row["rela_tabla10"]);
		$t->set_var("rela_tabla07",$row["rela_tabla07"]);
		$t->set_var("tabla12_fecha_prestamo",$row["tabla12_fecha_prestamo"]);
		$t->set_var("tabla12_fecha_a_devolver",$row["tabla12_fecha_a_devolver"]);
		$t->set_var("tabla12_fecha_devolucion",$row["tabla12_fecha_devolucion"]);
		
		$t->set_var("tabla10_titulo",$row["tabla10_titulo"]);
		$t->set_var("socio",$row["tabla07_apellido"]."  ,".$row["tabla07_nombre"]);

		
		
		$t->parse("LISTADO","un",true);
	}

}else{
	$t->set_var("LISTADO","<tr class='alt' align='center'><td colspan='10'>No se encuentra registro cargado. </td> </tr>");
}
$t->set_var("cantidad",$num_rows);
$t->pparse("OUT","ver");
?>