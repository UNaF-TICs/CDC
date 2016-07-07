<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_mantenimiento_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla23=isset($_POST['id_tabla23']) ? intval($_POST['id_tabla23']) : NULL;
$offset=$_POST["offset"]; 
$rela_tabla22='';


if ($id_tabla23!="")
{
	//MODIFICCION

	$sql="select * from tabla_23_tbl_mantenimiento  
	where id_tabla23=$id_tabla23";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla23=$row["id_tabla23"];
		$rela_tabla22=$row["rela_tabla22"];
		
		$t->set_var("rela_tabla22",$row["rela_tabla22"]);
		$t->set_var("tabla23_descripcion",htmlentities($row["tabla23_descripcion"],ENT_QUOTES));
		$t->set_var("tabla23_fecha_mantenimiento",ver_fecha($row["tabla23_fecha_mantenimiento"]));
		$t->set_var("tabla23_estado",htmlentities($row["tabla23_estado"],ENT_QUOTES));
		$t->set_var("tabla23_fecha_trabajo",ver_fecha($row["tabla23_fecha_trabajo"]));
		$t->set_var("tabla23_observacion",htmlentities($row["tabla23_observacion"],ENT_QUOTES));

	}
	
	$url="'modulos/mantenimiento/php/abm_mantenimiento_interfaz.php'";
	$vars="'nombre_funcion=modificar_mantenimiento&";
	$vars.="id_tabla23=$id_tabla23&";
	$vars.="rela_tabla22='+abm_mantenimiento.rela_tabla22.value+'&";
	$vars.="tabla23_descripcion='+abm_mantenimiento.tabla23_descripcion.value+'&";
	$vars.="tabla23_fecha_mantenimiento='+abm_mantenimiento.tabla23_fecha_mantenimiento.value+'&";
	$vars.="tabla23_estado='+abm_mantenimiento.tabla23_estado.value+'&";
	$vars.="tabla23_fecha_trabajo='+abm_mantenimiento.tabla23_fecha_trabajo.value+'&";
	$vars.="tabla23_observacion='+abm_mantenimiento.tabla23_observacion.value";
	
	$url_exito="'modulos/mantenimiento/php/ver_mantenimiento_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	$t->set_var("tit","Modificar Mantenimiento");
}
else
{
	//ALTA

	$t->set_var("tabla23_descripcion","");
	$t->set_var("rela_tabla22","");
	$t->set_var("tabla23_fecha_mantenimiento","");
	$t->set_var("tabla23_estado","");
	$t->set_var("tabla23_fecha_trabajo","");
	$t->set_var("tabla23_observacion","");

	$url="'modulos/mantenimiento/php/abm_mantenimiento_interfaz.php'";
	$vars="'nombre_funcion=agregar_mantenimiento&";
	$vars.="tabla23_descripcion='+abm_mantenimiento.tabla23_descripcion.value+'&";
	$vars.="rela_tabla22='+abm_mantenimiento.rela_tabla22.value+'&";
	$vars.="tabla23_fecha_mantenimiento='+abm_mantenimiento.tabla23_fecha_mantenimiento.value+'&";
	$vars.="tabla23_estado='+abm_mantenimiento.tabla23_estado.value+'&";
	$vars.="tabla23_fecha_trabajo='+abm_mantenimiento.tabla23_fecha_trabajo.value+'&";
	$vars.="tabla23_observacion='+abm_mantenimiento.tabla23_observacion.value";
			
	$url_exito="'modulos/mantenimiento/php/ver_mantenimiento_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Mantenimiento");
}
			
//TEMAS
	$sql="Select * from  tabla_22_tbl_maquinaria order by tabla22_nombre ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	
	{
		while ($row = $rs->fetch()) 
		{
				$id_tabla22=$row["id_tabla22"];
				
				if ($id_tabla22==$rela_tabla22)

				{
					//modificacion
						$t->set_var("ID","\"$id_tabla22\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla22_nombre"]));	

				}else{
					//alta
						$t->set_var("ID",$row["id_tabla22"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla22_nombre"]));	
				}
			$t->parse("MAQUINAS","una_opcion",true);
		}	
	}
	

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		

$url="'modulos/variedad/php/ver_variedad_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
