<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_tipotrabajo_abm.html",
	"una_opciontipotrabajo"			=> "una_opciontipotrabajo.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_Tabla14=isset($_POST['id_Tabla14']) ? intval($_POST['id_Tabla14']) : NULL;
$offset=$_POST["offset"]; 
//$Rela_Tabla14='';

if ($id_Tabla14!="")
{
	$sql="SELECT * FROM tabla_14_det_tipo_trabajo  
	where id_Tabla14=$id_Tabla14";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_Tabla14=$row["id_Tabla14"];
		$t->set_var("tabla14_Descripcion",htmlentities($row["tabla14_Descripcion"],ENT_QUOTES));
		

	}
	
	
	$url="'modulos/tipotrabajo/php/abm_tipotrabajo_interfaz.php'";
	$vars="'nombre_funcion=modificar_tipotrabajo&";
	$vars.="id_Tabla14=$id_Tabla14&";
	$vars.="tabla14_Descripcion='+abm_tipotrabajo.tabla14_Descripcion.value";
	
	
	
	$url_exito="'modulos/tipotrabajo/php/ver_tipotrabajo_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	

	$t->set_var("tit","Modificar Tipo Trabajo");
}
else
{
	$t->set_var("tabla14_Descripcion","");
	
	
	
	$url="'modulos/tipotrabajo/php/abm_tipotrabajo_interfaz.php'";
	$vars="'nombre_funcion=agregar_tipotrabajo&";
	$vars.="tabla14_Descripcion='+abm_tipotrabajo.tabla14_Descripcion.value";
	
				
	$url_exito="'modulos/tipotrabajo/php/ver_tipotrabajo_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Tipo Trabajo");
}

/*TEMAS
	$sql="SELECT * from  tabla_14_det_tipo_trabajo  order by tabla14_Descripcion ASC";
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
			$t->parse("TEMAS","una_opciontipotrabajo",true);
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


$url="'modulos/tipotrabajo/php/ver_tipoTrabajo_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
