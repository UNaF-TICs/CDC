<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_personal_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla12=isset($_POST['id_tabla12']) ? intval($_POST['id_tabla12']) : NULL;
$offset=$_POST["offset"]; 
$rela_tabla09='';


if ($id_tabla12!="")
{
	$sql="select * from tabla_12_personal  
	where id_tabla12=$id_tabla12";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla12=$row["id_tabla12"];
		$rela_tabla09=$row["rela_tabla09"];
		$t->set_var("tabla12_nombre_empresa",htmlentities($row["tabla12_nombre_empresa"],ENT_QUOTES));
		$t->set_var("rela_tabla09",$row["rela_tabla09"]);
		$t->set_var("tabla12_dni_nif",htmlentities($row["tabla12_dni_nif"],ENT_QUOTES));
		$t->set_var("tabla12_num_carne",htmlentities($row["tabla12_num_carne"],ENT_QUOTES));
		$t->set_var("tabla12_email",$row["tabla12_email"]);
		$t->set_var("tabla12_telefono",$row["tabla12_telefono"]);
		$t->set_var("tabla12_direccion",$row["tabla12_direccion"]);
		$t->set_var("tabla12_comentario",$row["tabla12_comentario"]);

	}
	
	
	$url="'modulos/personal/php/abm_personal_interfaz.php'";
	$vars="'nombre_funcion=modificar_personal&";
	$vars.="id_tabla12=$id_tabla12&";
	$vars.="tabla12_nombre_empresa='+abm_personal.tabla12_nombre_empresa.value+'&";
	$vars.="rela_tabla09='+abm_personal.rela_tabla09.value+'&";
	$vars.="tabla12_dni_nif='+abm_personal.tabla12_dni_nif.value+'&";
	$vars.="tabla12_num_carne='+abm_personal.tabla12_num_carne.value+'&";
	$vars.="tabla12_email='+abm_personal.tabla12_email.value+'&";
	$vars.="tabla12_telefono='+abm_personal.tabla12_telefono.value+'&";
	$vars.="tabla12_direccion='+abm_personal.tabla12_direccion.value+'&";
	$vars.="tabla12_comentario='+abm_personal.tabla12_comentario.value";
	
	$url_exito="'modulos/personal/php/ver_personal_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	$t->set_var("tit","Modificar Personal");
}
else
{
	$t->set_var("tabla12_nombre_empresa","");
	$t->set_var("rela_tabla09","");
	$t->set_var("tabla12_dni_nif","");
	$t->set_var("tabla12_num_carne","");
	$t->set_var("tabla12_email","");
	$t->set_var("tabla12_telefono","");
	$t->set_var("tabla12_direccion","");
	$t->set_var("tabla12_comentario","");
	
	$url="'modulos/personal/php/abm_personal_interfaz.php'";
	$vars="'nombre_funcion=agregar_personal&";
	$vars.="tabla12_nombre_empresa='+abm_personal.tabla12_nombre_empresa.value+'&";
	$vars.="rela_tabla09='+abm_personal.rela_tabla09.value+'&";
	$vars.="tabla12_dni_nif='+abm_personal.tabla12_dni_nif.value+'&";
	$vars.="tabla12_num_carne='+abm_personal.tabla12_num_carne.value+'&";		
	$vars.="tabla12_email='+abm_personal.tabla12_email.value+'&";
	$vars.="tabla12_telefono='+abm_personal.tabla12_telefono.value+'&";
	$vars.="tabla12_direccion='+abm_personal.tabla12_direccion.value+'&";
	$vars.="tabla12_comentario='+abm_personal.tabla12_comentario.value";
	$url_exito="'modulos/personal/php/ver_personal_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Personal");
}

//TEMAS
	$sql="Select * from  tabla_09_temas  order by tabla09_nombre ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch()) 
		{
				$id_tabla09=$row["id_tabla09"];
				if ($id_tabla09==$rela_tabla09)
				{
						$t->set_var("ID","\"$id_tabla09\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla09_nombre"]));	

				}else{
						$t->set_var("ID",$row["id_tabla09"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla09_nombre"]));	
				}
			$t->parse("TEMAS","una_opcion",true);
		}	
	}
	
	

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		


$url="'modulos/personal/php/ver_personal_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
