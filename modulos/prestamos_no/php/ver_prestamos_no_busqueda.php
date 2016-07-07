<?php
require_once "../../../php/check.php";
include "../../../lib/link_mysql.php";
require_once "../../../lib/template.inc";
//require_once "../../../php/funciones_comunes.php";
include "../../../php/funciones_comunes.php";
session_start();
/*Recibo los parametros para cargar el formulario ABM
Si son vacios es porque tengo que agregar uno nuevo.
*/
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"				=> "ver_prestamos_no_busqueda.html",
	"un"				=> "un_prestamos_no.html",
	"una_opcion"		=> "una_opcion.html",
));

$offset=$_POST["offset"];
$id_tabla12=$_POST["id_tabla12"];
$tabla10_titulo=$_POST["tabla10_titulo"];
$rela_tabla10=$_POST["rela_tabla10"];
$rela_tabla07=$_POST["rela_tabla07"];
$tabla12_fecha_prestamo=$_POST["tabla12_fecha_prestamo"];
$tabla12_fecha_a_devolver=$_POST["tabla12_fecha_a_devolver"];
$tabla12_fecha_devolucion=$_POST["tabla12_fecha_devolucion"];
$tabla10_tomo=$_POST["tabla10_tomo"];
$tabla10_cantidad=$_POST["tabla10_cantidad"];
//Configuración Inicial
$id_tablamodulo=$_POST["id_tablamodulo"];
//recuperar_perfiles_con_modulo($id_tablamodulo,$link_mysql);
$titulo="Listado de prestamos";
$t->set_var("titulo",$titulo);
//
//Otras Funciones
//$t->set_var("funcion_pdf","modulos/pasajeros/php/printpdf.php");
$t->set_var("funcion_excel","modulos/prestamos_no/php/exportar_excel.php?tipo=xls");
$t->set_var("funcion_doc","modulos/prestamos_no/php/exportar_excel.php?tipo=doc");
$t->set_var("funcion_pdf","modulos/prestamos_no/php/exportar_excel.php");
//

$qr="Select * from  tabla_10_libros  order by tabla10_titulo ASC";
$result = mysql_query($qr,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{

	while ($row_tipo = mysql_fetch_assoc($result))
	{
		$t->set_var("ID",$row_tipo["id_tabla10"]);
		$t->set_var("NOMBRE",htmlentities($row_tipo["tabla10_titulo"]));	
		$t->parse("LIBROS","una_opcion",true);
	}
	
}	

$qr="Select * from  tabla_07_personas  order by tabla07_apellido ASC , tabla07_nombre ASC";
$result = mysql_query($qr,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{

	while ($row_tipo = mysql_fetch_assoc($result))
	{
		$t->set_var("ID",$row_tipo["id_tabla07"]);
		$t->set_var("NOMBRE",utf8_encode($row_tipo["tabla07_apellido"]." - ".$row_tipo["tabla07_nombre"]));	
		$t->parse("SOCIOS","una_opcion",true);
	}
	
}	



$url="'modulos/prestamos_no/php/ver_prestamos_no.php'";
$id="'listado_prestamos_no'";
$vars="'es_buscar=si&id_tablamodulo=$id_tablamodulo&";	
$vars.="rela_tabla10='+ver_busqueda_prestamos_no.rela_tabla10.value+'&";
$vars.="rela_tabla07='+ver_busqueda_prestamos_no.rela_tabla07.value+'&";
$vars.="fecha_hasta_devolver_1='+ver_busqueda_prestamos_no.fecha_hasta_devolver_1.value+'&";
$vars.="fecha_desde_devolver_1='+ver_busqueda_prestamos_no.fecha_desde_devolver_1.value";	
$t->set_var("funcion_busqueda","cargar_post($url,$id,$vars)");
/*
// New Paginador
$totalporpag=25;
if(!$offset){ 
	$off=0;$offset=1;
}
else{
    $off=($offset-1);
}
$ini=$off*$totalporpag;
// End New	
*/

$offset=$_POST["offset"];

// New Paginador
$totalporpag=10;
if(!$offset){ 
	$off=0;$offset=1;
}
else{
    $off=($offset-1);
}
$ini=$off*$totalporpag;
// End New	
$sql="select * from tabla_12_prestamos 
inner join tabla_10_libros on id_tabla10 = rela_tabla10
inner join tabla_07_personas on id_tabla07 = rela_tabla07
where tabla12_fecha_devolucion is null
		order by id_tabla12 ASC  
		Limit $totalporpag OFFSET $ini ";
//echo $sql;
$result = mysql_query($sql,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{ 
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

		$url="'modulos/prestamos_no/php/ver_prestamos_no_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla12=$id_tabla12'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/prestamos_no/php/abm_prestamos_no_interfaz.php'";
		$vars="'nombre_funcion=borrar_prestamos&";
		$vars.="id_tabla12=$id_tabla12'";
		$url_exito="'modulos/prestamos_no/php/ver_prestamos_no_busqueda.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
		$msg="'Esta seguro que quiere eliminar el Registro?'";
		$t->set_var("funcion_borrar","eliminar_mostrar($url,$vars,$url_exito,$id,$vars_exito,$msg);");
		
		$t->parse("LISTADO","un",true);
	}
}	
else
{
	$t->set_var("LISTADO","<tr align='center' class='alt'><td colspan='6'>No se encuentran Registros Cargados. </td></tr>");
	
}	
	// New Paginador
	$qrT="select * from tabla_12_prestamos
	inner join tabla_10_libros on id_tabla10 = rela_tabla10
    inner join tabla_07_personas on id_tabla07 = rela_tabla07
	where tabla12_fecha_devolucion is null
	 " ;
	// echo $qrT;
	$result = mysql_query($qrT,$link_mysql);
	$totalregistros = mysql_num_rows($result);
	$t->set_var("cantidad",$totalregistros);
	$totalpaginas=$totalregistros/$totalporpag;
	$test=explode("\.",$totalpaginas);
	if($test[1])
	{
		$totalpaginas=$test[0]+1;
	}
	// << Anterior
	if($offset>1)
	{
		$pag.="<td><a href=\"javascript:cargar_post('modulos/prestamos_no/php/ver_prestamos_no.php','listado_prestamos_no','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
	}
	else
	{
		$pag.="<td></td>";
	}
						 
	// Numeros
	if($totalpaginas>15)
	{
		$faltan=($totalpaginas-$off);
		if($faltan<15)
		{
			$ter=$totalpaginas;
			$com=$off -(15-($totalpaginas-$off));
		}
		elseif($off<8)
		{
			$ter=15;
			$com=1;
		}
		else
		{
			$ter=$off+7;
			$com=$off-7;
		}
	}
	else
	{
		$com=1;
		$ter=$totalpaginas;
	}
		  
	$pag.="<td align='center'>";
	for($i=$com;$i<=$ter;$i++)
	{
		if($i==$offset)
		{
			$pag.="<font color=#000000><b>$i</b></font>&nbsp;";
		}
		else
		{
			$pag.="<a href=\"javascript:cargar_post('modulos/prestamos_no/php/ver_prestamos_no.php','listado_prestamos_no','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/prestamos_no/php/ver_prestamos_no.php','listado_prestamos_no','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
	
	$url="'modulos/prestamos_no/php/ver_prestamos_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	

$t->pparse("OUT", "ver");
?>