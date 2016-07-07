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
$id_tabla71=isset($_POST['id_tabla71']) ? intval($_POST['id_tabla71']) : NULL;
$offset=$_POST["offset"]; 
$rela_tabla72='';
$rela_tabla70='';
$rela_tabla63='';


if ($id_tabla71!="")
{
	$sql="select * from tabla_71_cab_personal  
	where id_tabla71=$id_tabla71";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla71=$row["id_tabla71"];
		$rela_tabla72=$row["rela_tabla72"];
		$rela_tabla70=$row["rela_tabla70"];
		$rela_tabla63=$row["rela_tabla63"];
		$t->set_var("rela_tabla72",$row["rela_tabla72"]);
		$t->set_var("rela_tabla70",$row["rela_tabla70"]);
		$t->set_var("rela_tabla63",$row["rela_tabla63"]);
		

	}
	
	
	$url="'modulos/asignacion/php/abm_personal_interfaz.php'";
	$vars="'nombre_funcion=modificar_personal&";
	$vars.="id_tabla71=$id_tabla71&";
	$vars.="rela_tabla72='+abm_personal.rela_tabla72.value+'&";
	$vars.="rela_tabla70='+abm_personal.rela_tabla70.value+'&";
	$vars.="rela_tabla63='+abm_personal.rela_tabla63.value";
	
	
	$url_exito="'modulos/asignacion/php/ver_personal_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	$t->set_var("tit","Modificar Personal");
}
else
{
	$t->set_var("rela_tabla72","");
	$t->set_var("rela_tabla70","");
	$t->set_var("rela_tabla63","");
	
	
	$url="'modulos/asignacion/php/abm_personal_interfaz.php'";
	$vars="'nombre_funcion=agregar_personal&";
	$vars.="rela_tabla72='+abm_personal.rela_tabla72.value+'&";
	$vars.="rela_tabla70='+abm_personal.rela_tabla70.value+'&";
	$vars.="rela_tabla63='+abm_personal.rela_tabla63.value";
	
	$url_exito="'modulos/asignacion/php/ver_personal_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Personal");
}


//TEMAS
	$sql="Select * from  tabla_72_tbl_tipo_personal  order by tabla72_descripcion ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch()) 
		{
				$id_tabla72=$row["id_tabla72"];
				if ($id_tabla72==$rela_tabla72)
				{
						$t->set_var("ID","\"$id_tabla72\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla72_descripcion"]));	

				}else{
						$t->set_var("ID",$row["id_tabla72"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla72_descripcion"]));	
				}
			$t->parse("TIPO","una_opcion",true);
		}	
	}


	$sql="Select * from  tabla_70_tbl_persona  order by tabla70_nombre_apellido ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch()) 
		{
				$id_tabla70=$row["id_tabla70"];
				if ($id_tabla70==$rela_tabla70)
				{
						$t->set_var("ID","\"$id_tabla70\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla70_nombre_apellido"]));	

				}else{
						$t->set_var("ID",$row["id_tabla70"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla70_nombre_apellido"]));	
				}
			$t->parse("PERSONA","una_opcion",true);
		}	
	}




	$sql="select * from tabla_70_tbl_persona left outer join tabla_63_tbl_finca on rela_tabla70_finca = id_tabla70 order by tabla70_razon_social ASC ";

$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch()) 
		{
				$id_tabla63=$row["id_tabla63"];
				if ($id_tabla63==$rela_tabla63)
				{
						$t->set_var("ID","\"$id_tabla63\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla70_razon_social"]));	

				}else{
						$t->set_var("ID",$row["id_tabla63"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla70_razon_social"]));	
				}
			$t->parse("FINCA","una_opcion",true);
		}	
	}	
	

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		


$url="'modulos/asignacion/php/ver_personal_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
