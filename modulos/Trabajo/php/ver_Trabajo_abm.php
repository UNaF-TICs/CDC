<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_trabajo_abm.html",
	"una_opciontrabajo"			=> "una_opciontrabajo.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla13=isset($_POST['id_tabla13']) ? intval($_POST['id_tabla13']) : NULL;
$offset=$_POST["offset"]; 
$Rela_Tabla14='';


if ($id_tabla13!="")
{
	$sql="SELECT * FROM tabla_13_cab_trabajo
	where id_tabla13=$id_tabla13";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla13=$row["id_tabla13"];
		$Rela_Tabla14=$row["Rela_Tabla14"];
		$t->set_var("Rela_Tabla14",$row["Rela_Tabla14"]);
		$t->set_var("Tabla13_Descripcion",htmlentities($row["Tabla13_Descripcion"],ENT_QUOTES));
		

	}
	
	
	$url="'modulos/Trabajo/php/abm_Trabajo_interfaz.php'";
	$vars="'nombre_funcion=modificar_trabajo&";
	$vars.="id_tabla13=$id_tabla13&";
	$vars.="Rela_Tabla14='+abm_trabajos.Rela_Tabla14.value+'&";
	$vars.="Tabla13_Descripcion='+abm_trabajos.Tabla13_Descripcion.value";
	
	
	
	$url_exito="'modulos/Trabajo/php/ver_Trabajo_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	
	$t->set_var("tit","Modificar trabajo");
}
else
{
	$t->set_var("Rela_Tabla14","");
	$t->set_var("Tabla13_Descripcion","");
	
	
	$url="'modulos/Trabajo/php/abm_Trabajo_interfaz.php'";
	$vars="'nombre_funcion=agregar_trabajo&";
	$vars.="Rela_Tabla14='+abm_trabajos.Rela_Tabla14.value+'&";
	$vars.="Tabla13_Descripcion='+abm_trabajos.Tabla13_Descripcion.value";
	
				
	$url_exito="'modulos/Trabajo/php/ver_Trabajo_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Trabajo");
}

//TEMAS
	$sql="SELECT * FROM  tabla_14_det_tipo_trabajo  order by tabla14_Descripcion ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch()) 
		{
				$id_Tabla14=$row["id_Tabla14"];
				if ($id_Tabla14==$Rela_Tabla14)
				{
						$t->set_var("ID","\"$id_Tabla14\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla14_Descripcion"]));	

				}else{
						$t->set_var("ID",$row["id_Tabla14"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla14_Descripcion"]));	
				}
			$t->parse("TEMAS","una_opciontrabajo",true);
		}	
	}
	
	//TEMAS
	/*$sql="Select * from  tabla_11_editoriales  order by tabla11_nombre ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch())  
		{
				$id_tabla11=$row["id_tabla11"];
				if ($id_tabla11==$rela_tabla11)
				{
						$t->set_var("ID","\"$id_tabla11\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla11_nombre"]));	

				}else{
						$t->set_var("ID",$row["id_tabla11"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla11_nombre"]));	
				}
			$t->parse("EDITORIALES","una_opcion",true);
		}	
	}
*/
$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito);");
		


$url="'modulos/Trabajo/php/ver_trabajo_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
