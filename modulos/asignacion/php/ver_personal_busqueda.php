<?php
require_once "../../../php/check.php";
include "../../../lib/link_mysql.php";
require_once "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";
session_start();

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"				=> "ver_personal_busqueda.html",
	"un"				=> "un_personal.html",
	"una_opcion"		=> "una_opcion.html",
));
 
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$nombre_empresa="Listado de Personales";
$t->set_var("nombre_empresa",$nombre_empresa);

//
//Otras Funciones
//$t->set_var("funcion_excel","modulos/libros/php/exportar_excel.php?tipo=xls");
//$t->set_var("funcion_doc","modulos/libros/php/exportar_excel.php?tipo=doc");
//$t->set_var("funcion_pdf","modulos/libros/php/exportar_excel.php");
//

$url="'modulos/asignacion/php/ver_personal.php'";
$id="'listado_personal'";
$vars="'es_buscar=si&id_tablamodulo=$id_tablamodulo&";	
$vars.="='+ver_busqueda_personal..value";	
$t->set_var("funcion_busqueda","cargar_post($url,$id,$vars)");

if (isset($_POST['offset'])) {
	$offset=$_POST["offset"];
} else {
	$offset = "";
} 

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


$sql="select * from tabla_71_cab_personal, tabla_70_tbl_persona, tabla_72_tbl_tipo_personal
		where rela_tabla70 = id_tabla70 And rela_tabla72 = id_tabla72   
		order by tabla72_descripcion, tabla70_nombre_apellido, tabla70_razon_social  ASC  
		Limit $totalporpag OFFSET $ini ";


$rs = $pdo->query($sql);
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla71=$row["id_tabla71"];
		
		$rela_tabla72=$row["rela_tabla72"];
		

		if ($rela_tabla72==$rela_tabla72) {
		$t->set_var("rela_tabla72",$row["tabla72_descripcion"]);
		}
		
		
		$rela_tabla70=$row["rela_tabla70"];

		if ($rela_tabla70==$rela_tabla70) {
		$t->set_var("rela_tabla70",$row["tabla70_nombre_apellido"]);
		}


		$rela_tabla63=$row["rela_tabla63"];
		
		if ($rela_tabla63==$rela_tabla63) {
		$t->set_var("rela_tabla63",$row["tabla70_razon_social"]);
		}

		
		$url="'modulos/asignacion/php/ver_personal_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla71=$id_tabla71'";
		
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/asignacion/php/abm_personal_interfaz.php'";
		$vars="'nombre_funcion=borrar_personal&";
		$vars.="id_tabla71=$id_tabla71'";
		$url_exito="'modulos/asignacion/php/ver_personal_busqueda.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
		$msg="'Esta seguro que quiere eliminar el Registro?'";
		$t->set_var("funcion_borrar","eliminar_mostrar($url,$vars,$url_exito,$id,$vars_exito,$msg);");
		
		$t->parse("LISTADO","un",true);
	}
}	

else
{
	$t->set_var("LISTADO","<tr align='center' class='alt'><td colspan='10'>No se encuentran Registros Cargados. </td></tr>");
	
}	

	$qrT="select * from tabla_71_cab_personal";
	$rs = $pdo->query($qrT);//
	$totalregistros = $rs->rowCount();
	$t->set_var("cantidad",$totalregistros);
	$totalpaginas=$totalregistros/$totalporpag;
	$test=split("\.",$totalpaginas);
	$pag=''; 
	if(isset($test[1]))
	{
		$totalpaginas=$test[0]+1;
	}
	// << Anterior
	if($offset>1)
	{
		$pag.="<td><a href=\"javascript:cargar_post('modulos/asignacion/php/ver_personal.php','listado_personal','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/asignacion/php/ver_personal.php','listado_personal','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/asignacion/php/ver_personal.php','listado_personal','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
	
	$url="'modulos/asignacion/php/ver_personal_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	

$t->pparse("OUT", "ver");
?>