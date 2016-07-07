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
$id_tabla70=isset($_POST['id_tabla70']) ? intval($_POST['id_tabla70']) : NULL;
$offset=$_POST["offset"]; 
$rela_tabla72='';


if ($id_tabla70!="")
{
	$sql="select * from tabla_70_tbl_persona  
	where id_tabla70=$id_tabla70";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla70=$row["id_tabla70"];
		$t->set_var("tabla70_nombre_apellido",htmlentities($row["tabla70_nombre_apellido"],ENT_QUOTES));
		$t->set_var("tabla70_razon_social",$row["tabla70_razon_social"]);
		$t->set_var("tabla70_cuit",$row["tabla70_cuit"]);
		$t->set_var("tabla70_dni",htmlentities($row["tabla70_dni"],ENT_QUOTES));
		$t->set_var("tabla70_foto",htmlentities($row["tabla70_foto"],ENT_QUOTES));
		$t->set_var("tabla70_email",$row["tabla70_email"]);
		$t->set_var("tabla70_telefono",$row["tabla70_telefono"]);
		$t->set_var("tabla70_direccion",$row["tabla70_direccion"]);

	}
	
	
	$url="'modulos/personal/php/abm_personal_interfaz.php'";
	$vars="'nombre_funcion=modificar_personal&";
	$vars.="id_tabla70=$id_tabla70&";
	$vars.="tabla70_nombre_apellido='+abm_personal.tabla70_nombre_apellido.value+'&";
	$vars.="tabla70_razon_social='+abm_personal.tabla70_razon_social.value+'&";
	$vars.="tabla70_cuit='+abm_personal.tabla70_cuit.value+'&";
	$vars.="tabla70_dni='+abm_personal.tabla70_dni.value+'&";
	$vars.="tabla70_foto='+abm_personal.tabla70_foto.value+'&";
	$vars.="tabla70_email='+abm_personal.tabla70_email.value+'&";
	$vars.="tabla70_telefono='+abm_personal.tabla70_telefono.value+'&";
	$vars.="tabla70_direccion='+abm_personal.tabla70_direccion.value";
	
	$url_exito="'modulos/personal/php/ver_personal_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	$t->set_var("tit","Modificar Personal");
}
else
{
	$t->set_var("tabla70_razon_social","");
	$t->set_var("tabla70_cuit","");
	$t->set_var("tabla70_nombre_apellido","");
	$t->set_var("tabla70_dni","");
	$t->set_var("tabla70_foto","");
	$t->set_var("tabla70_email","");
	$t->set_var("tabla70_telefono","");
	$t->set_var("tabla70_direccion","");
	
	$url="'modulos/personal/php/abm_personal_interfaz.php'";
	$vars="'nombre_funcion=agregar_personal&";
	$vars.="tabla70_razon_social='+abm_personal.tabla70_razon_social.value+'&";
	$vars.="tabla70_cuit='+abm_personal.tabla70_cuit.value+'&";
	$vars.="tabla70_nombre_apellido='+abm_personal.tabla70_nombre_apellido.value+'&";
	$vars.="tabla70_dni='+abm_personal.tabla70_dni.value+'&";
	$vars.="tabla70_foto='+abm_personal.tabla70_foto.value+'&";		
	$vars.="tabla70_email='+abm_personal.tabla70_email.value+'&";
	$vars.="tabla70_telefono='+abm_personal.tabla70_telefono.value+'&";
	$vars.="tabla70_direccion='+abm_personal.tabla70_direccion.value";

	$url_exito="'modulos/personal/php/ver_personal_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Personal");
}

// //TEMAS
// 	$sql="Select * from  tabla_72_tbl_tipo_personal  order by tabla72_descripcion ASC";
// 	$rs = $pdo->query($sql);//
// 	$num_rows = $rs->rowCount();
// 	if ($num_rows>0)
// 	{
// 		while ($row = $rs->fetch()) 
// 		{
// 				$id_tabla72=$row["id_tabla72"];
// 				if ($id_tabla72==$rela_tabla72)
// 				{
// 						$t->set_var("ID","\"$id_tabla72\" SELECTED ");
// 						$t->set_var("NOMBRE",utf8_encode($row["tabla72_descripcion"]));	

// 				}else{
// 						$t->set_var("ID",$row["id_tabla72"]);
// 						$t->set_var("NOMBRE",utf8_encode($row["tabla72_descripcion"]));	
// 				}
// 			$t->parse("TEMAS","una_opcion",true);
// 		}	
// 	}
	
	

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		


$url="'modulos/personal/php/ver_personal_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
