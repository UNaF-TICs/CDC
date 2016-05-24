<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_prestamos_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
$id_tablamodulo=$_POST["id_tablamodulo"];

$id_tabla12=$_POST["id_tabla12"];
$rela_tabla10=$_POST["rela_tabla10"];
$rela_tabla07=$_POST["rela_tabla07"];
$tabla12_fecha_prestamo=$_POST["tabla12_fecha_prestamo"];
$tabla12_fecha_a_devolver=$_POST["tabla12_fecha_a_devolver"];
$tabla12_fecha_devolucion=$_POST["tabla12_fecha_devolucion"];


$offset=$_POST["offset"]; 

if ($id_tabla12!="")
{
	$sql="select * from tabla_12_prestamos  
			where id_tabla12=$id_tabla12";

	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		$row = mysql_fetch_assoc($result);
		$id_tabla12=$row["id_tabla12"];
		$rela_tabla10=$row["rela_tabla10"];
		$rela_tabla07=$row["rela_tabla07"];
		//$tabla12_fecha_devolucion=$row["tabla12_fecha_devolucion"];
		if($row["tabla12_fecha_devolucion"] != "")
		{
		  echo "ERROR - El libro ya se encuentra devuelto";
		  return;
		}
		$t->set_var("rela_tabla10",$row["rela_tabla10"]);
		$t->set_var("rela_tabla07",$row["rela_tabla07"]);
		$t->set_var("tabla12_fecha_prestamo",$row["tabla12_fecha_prestamo"]);
		$t->set_var("tabla12_fecha_a_devolver",$row["tabla12_fecha_a_devolver"]);
		$fecha_devolucion=date('d-m-Y');
		$t->set_var("tabla12_fecha_devolucion",$fecha_devolucion);
        $t->set_var("disabled",'disabled');
		
	}
	
	
	$url="'modulos/prestamos/php/abm_prestamos_interfaz.php'";
	$vars="'nombre_funcion=modificar_prestamos&";
	$vars.="id_tabla12=$id_tabla12&";
	$vars.="rela_tabla10='+abm_prestamos.rela_tabla10.value+'&";
	$vars.="rela_tabla07='+abm_prestamos.rela_tabla07.value+'&";
	$vars.="tabla12_fecha_prestamo='+abm_prestamos.tabla12_fecha_prestamo.value+'&";
	$vars.="tabla12_fecha_devolucion='+abm_prestamos.tabla12_fecha_devolucion.value+'&";
	$vars.="tabla12_fecha_a_devolver='+abm_prestamos.tabla12_fecha_a_devolver.value";
	
	$url_exito="'modulos/prestamos/php/ver_prestamos_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	$t->set_var("tit","Devolver Libro");
}
else
{
	$t->set_var("tabla12_fecha_prestamo","");
	$t->set_var("tabla12_fecha_a_devolver","");
	$t->set_var("rela_tabla10","");
	$t->set_var("rela_tabla07","");
	$t->set_var("tabla12_fecha_devolucion","");
    $t->set_var("hide",'none');
	
	$url="'modulos/prestamos/php/abm_prestamos_interfaz.php'";
	$vars="'nombre_funcion=agregar_prestamos&";
	$vars.="rela_tabla10='+abm_prestamos.rela_tabla10.value+'&";
	$vars.="rela_tabla07='+abm_prestamos.rela_tabla07.value+'&";
	$vars.="tabla12_fecha_prestamo='+abm_prestamos.tabla12_fecha_prestamo.value+'&";
	$vars.="tabla12_fecha_devolucion='+abm_prestamos.tabla12_fecha_devolucion.value+'&";
	$vars.="tabla12_fecha_a_devolver='+abm_prestamos.tabla12_fecha_a_devolver.value";
			
	$url_exito="'modulos/prestamos/php/ver_prestamos_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Prestamo");
}

//LOBROS
	$sql="Select * from  tabla_10_libros  order by tabla10_titulo ASC";
	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		while ($row = mysql_fetch_assoc($result))
		{
				$id_tabla10=$row["id_tabla10"];
				if ($id_tabla10==$rela_tabla10)
				{
						$t->set_var("ID","\"$id_tabla10\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla10_titulo"]));	

				}else{
						$t->set_var("ID",$row["id_tabla10"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla10_titulo"]));	
				}
			$t->parse("LIBROS","una_opcion",true);
		}	
	}
	
	//TEMAS
	$sql="Select * from  tabla_07_personas  order by tabla07_apellido ASC , tabla07_nombre ASC";
	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		while ($row = mysql_fetch_assoc($result))
		{
				$id_tabla07=$row["id_tabla07"];
				if ($id_tabla07==$rela_tabla07)
				{
						$t->set_var("ID","\"$id_tabla07\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla07_apellido"]." - ".$row["tabla07_nombre"]));	

				}else{
						$t->set_var("ID",$row["id_tabla07"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla07_apellido"]." - ".$row["tabla07_nombre"]));	
				}
			$t->parse("SOCIOS","una_opcion",true);
		}	
	}

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		


$url="'modulos/prestamos/php/ver_prestamos_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
