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
	"ver"		=> "ver_personas_reporte.html",
	"un"		=> "un_personas_reporte.html",
	));
	
$fecha_actual=date('d-m-Y');
$t->set_var("fecha_actual",$fecha_actual);	
	
if ($_SESSION['where_personas']!="")
{	
	$where="where ".$_SESSION['where_personas'];
}else{
	$where="";
}

$sql="select * from tabla_07_personas 
		$where 
		order by  tabla07_apellido ASC,tabla07_nombre ASC";
$result = mysql_query($sql,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{
	
	$t->set_var("cantidad",$num_rows);
	while ($row = mysql_fetch_assoc($result))
	{


		$id_tabla07=$row["id_taid_tabla07bla12"];
		$tabla07_esbeneficiario=$row["tabla07_esbeneficiario"];
		if($tabla07_esbeneficiario==1){
		$t->set_var("beneficiario","<strong>SÍ</strong>");
		}else{
		$t->set_var("beneficiario","NO");
		}
		$t->set_var("tabla07_nropersona",htmlentities($row["tabla07_nropersona"]));
		$t->set_var("tabla07_nombre",htmlentities($row["tabla07_nombre"]));
		$t->set_var("tabla07_apellido",htmlentities($row["tabla07_apellido"]));

       if ($row["tabla07_telfijo"]=="")
		{
			$t->set_var("tabla07_telfijo","<strong>Sin Datos</strong>");
		}else{
			$t->set_var("tabla07_telfijo",htmlentities($row["tabla07_telfijo"], ENT_QUOTES));
		}	

       
	   if ($row["tabla07_celular"]=="")
		{
			$t->set_var("tabla07_celular","<strong>Sin Datos</strong>");
		}else{
			$t->set_var("tabla07_celular",htmlentities($row["tabla07_celular"], ENT_QUOTES));
		}	
	  
	    
		 if ($row["tabla07_direccion"]=="")
		{
			$t->set_var("tabla07_direccion","<strong>Sin Datos</strong>");
		}else{
			$t->set_var("tabla07_direccion",htmlentities($row["tabla07_direccion"], ENT_QUOTES));
		}	
		$t->set_var("tabla07_cumple",ver_fecha($row["tabla07_cumple"]));
		
		if ($row["tabla07_mail"]=="")
		{
			$t->set_var("tabla07_mail","<strong>Sin Datos</strong>");
		}else{
			$t->set_var("tabla07_mail",htmlentities($row["tabla07_mail"], ENT_QUOTES));
		}
		$t->set_var("tabla07_dni",htmlentities($row["tabla07_dni"]));
		if ($row["tabla07_nrotarjeta"]=="")
		{
			$t->set_var("tabla07_nrotarjeta","<strong>Sin Datos</strong>");
		}else{
		   $t->set_var("tabla07_nrotarjeta",htmlentities($row["tabla07_nrotarjeta"]));
		}
		
		if ($row["tabla07_fechaalta"]=="")
		{
			$t->set_var("tabla07_fechaalta","<strong>Sin Datos</strong>");
		}else{
			$t->set_var("tabla07_fechaalta",ver_fecha($row["tabla07_fechaalta"]));
		}
		
		
		$t->parse("LISTADO","un",true);
	}

}else{
	$t->set_var("LISTADO","<tr class='alt' align='center'><td colspan='10'>No se encuentra ning&uacute;n personas cargado. </td> </tr>");
}
$t->set_var("cantidad",$num_rows);
$t->pparse("OUT","ver");
?>