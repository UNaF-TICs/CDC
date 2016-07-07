<?php
require_once "../../../php/check.php";
include "../../../lib/link_mysql.php";
require_once "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";
session_start();

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"				=> "ver_mantenimiento_busqueda.html",
	"un"				=> "un_mantenimiento.html",
	"una_opcion"		=> "una_opcion.html",
));
 
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$titulo="Listado de Mantenimiento";
$t->set_var("titulo",$titulo);

//
//Otras Funciones
//$t->set_var("funcion_excel","modulos/libros/php/exportar_excel.php?tipo=xls");
//$t->set_var("funcion_doc","modulos/libros/php/exportar_excel.php?tipo=doc");
//$t->set_var("funcion_pdf","modulos/libros/php/exportar_excel.php");
//

$url="'modulos/mantenimiento/php/ver_mantenimiento.php'";
$id="'listado_mantenimiento'";
$vars="'es_buscar=si&id_tablamodulo=$id_tablamodulo&";	
$vars.="tabla23_descripcion='+ver_busqueda_mantenimiento.tabla23_descripcion.value";	
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
$sql="select * from tabla_23_tbl_mantenimiento 
		order by tabla_23_tbl_mantenimiento.tabla23_fecha_mantenimiento desc  
		Limit $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla23=$row["id_tabla23"];
		$rela_tabla22=$row["rela_tabla22"];

		//encontrar el nombre de la MAQUINA por medio del rela_tabla22
		$sql2="select * from tabla_22_tbl_maquinaria where id_tabla22=$rela_tabla22";
		$rs2=$pdo->query($sql2);
		$num_rows2 = $rs2->rowCount();
			if ($num_rows2>0){
				while ($row2 = $rs2->fetch())
			{
				$rela_tabla22=$row2["tabla22_nombre"];
			}
			}
				$t->set_var("rela_tabla22",$rela_tabla22);

		$t->set_var("tabla23_descripcion",htmlentities($row["tabla23_descripcion"],ENT_QUOTES));
		$t->set_var("tabla23_fecha_mantenimiento",$row["tabla23_fecha_mantenimiento"]);
		$t->set_var("tabla23_estado",$row["tabla23_estado"]);
		$t->set_var("tabla23_fecha_trabajo",$row["tabla23_fecha_trabajo"]);
		$t->set_var("tabla23_observacion",$row["tabla23_observacion"]);

//$t->set_var("rela_tabla22",$row["rela_tabla22"]);
		
		
		$url="'modulos/mantenimiento/php/ver_mantenimiento_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla23=$id_tabla23'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/mantenimiento/php/abm_mantenimiento_interfaz.php'";
		$vars="'nombre_funcion=borrar_mantenimiento&";
		$vars.="id_tabla23=$id_tabla23'";
		$url_exito="'modulos/mantenimiento/php/ver_mantenimiento_busqueda.php'";
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
	$qrT="select * from tabla_23_tbl_mantenimiento";
	$rs = $pdo->query($qrT);//
	$totalregistros = $rs->rowCount();
	$t->set_var("cantidad",$totalregistros);
	$totalpaginas=$totalregistros/$totalporpag;
	$test=explode("\.",$totalpaginas);
	$pag=''; 
	if(isset($test[1]))
	{
		$totalpaginas=$test[0]+1;
	}
	// << Anterior
	if($offset>1)
	{
		$pag.="<td><a href=\"javascript:cargar_post('modulos/mantenimiento/php/ver_mantenimiento.php','listado_mantenimiento','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/mantenimiento/php/ver_mantenimiento.php','listado_mantenimiento','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/mantenimiento/php/ver_mantenimiento.php','listado_mantenimiento','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
	
	$url="'modulos/mantenimiento/php/ver_mantenimiento_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	

$t->pparse("OUT", "ver");
?>