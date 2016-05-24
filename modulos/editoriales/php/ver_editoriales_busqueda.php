<?php
require_once "../../../php/check.php";
include "../../../lib/link_mysql.php";
require_once "../../../lib/template.inc";
require_once "../../../php/funciones_comunes.php";
session_start();
/*Recibo los parametros para cargar el formulario ABM
Si son vacios es porque tengo que agregar uno nuevo.
*/
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"				=> "ver_editoriales_busqueda.html",
	"un"				=> "un_editoriales.html",
	"una_opcion"		=> "una_opcion.html",
));

$offset=$_POST["offset"];
$id_tabla11=$_POST["id_tabla11"];
$tabla11_nombre=$_POST["tabla11_nombre"];
$tabla11_descripcion=$_POST["tabla11_descripcion"];
$tabla09_subtema=$_POST["tabla09_subtema"];
//Configuración Inicial
$id_tablamodulo=$_POST["id_tablamodulo"];
//recuperar_perfiles_con_modulo($id_tablamodulo,$link_mysql);
$titulo="Listado de temas";
$t->set_var("titulo",$titulo);
//
//Otras Funciones
//$t->set_var("funcion_pdf","modulos/pasajeros/php/printpdf.php");
$t->set_var("funcion_excel","modulos/temas/php/exportar_excel.php?tipo=xls");
$t->set_var("funcion_doc","modulos/temas/php/exportar_excel.php?tipo=doc");
$t->set_var("funcion_pdf","modulos/temas/php/exportar_excel.php");
//




$url="'modulos/editoriales/php/ver_editoriales.php'";
$id="'listado_editoriales'";
$vars="'es_buscar=si&id_tablamodulo=$id_tablamodulo&";	
$vars.="tabla11_nombre='+ver_busqueda_editoriales.tabla11_nombre.value";	
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
$sql="select * from tabla_11_editoriales 
		order by tabla11_nombre ASC  
		Limit $totalporpag OFFSET $ini ";
//echo $sql;
$result = mysql_query($sql,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{ 
    while ($row = mysql_fetch_assoc($result))
	{
		$id_tabla11=$row["id_tabla11"];
		$t->set_var("tabla11_nombre",htmlentities($row["tabla11_nombre"],ENT_QUOTES));
		$t->set_var("tabla11_descripcion",htmlentities($row["tabla11_descripcion"],ENT_QUOTES));
		$t->set_var("tabla09_subtema",htmlentities($row["tabla09_subtema"],ENT_QUOTES));
		

		$url="'modulos/editoriales/php/ver_editoriales_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla11=$id_tabla11'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/editoriales/php/abm_editoriales_interfaz.php'";
		$vars="'nombre_funcion=borrar_temas&";
		$vars.="id_tabla11=$id_tabla11'";
		$url_exito="'modulos/editoriales/php/ver_editoriales_busqueda.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
		$msg="'Esta seguro que quiere eliminar el Registro?'";
		$t->set_var("funcion_borrar","eliminar_mostrar($url,$vars,$url_exito,$id,$vars_exito,$msg);");
		
		$t->parse("LISTADO","un",true);
	}
}	
else
{
	$t->set_var("LISTADO","<tr align='center' class='alt'><td colspan='5'>No se encuentran Registros Cargados. </td></tr>");
	
}	
	// New Paginador
	$qrT="select * from tabla_11_editoriales
	 " ;
	$result = mysql_query($qrT,$link_mysql);
	$totalregistros = mysql_num_rows($result);
	$t->set_var("cantidad",$totalregistros);
	$totalpaginas=$totalregistros/$totalporpag;
	$test=split("\.",$totalpaginas);
	if($test[1])
	{
		$totalpaginas=$test[0]+1;
	}
	// << Anterior
	if($offset>1)
	{
		$pag.="<td><a href=\"javascript:cargar_post('modulos/editoriales/php/ver_editoriales.php','listado_editoriales','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/editoriales/php/ver_editoriales.php','listado_editoriales','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/editoriales/php/ver_editoriales.php','listado_editoriales','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
	
	$url="'modulos/editoriales/php/ver_editoriales_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	

$t->pparse("OUT", "ver");
?>