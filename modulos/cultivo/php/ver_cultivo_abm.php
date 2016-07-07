<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_cultivo_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla16=isset($_POST['id_tabla16']) ? intval($_POST['id_tabla16']) : NULL;
$offset=$_POST["offset"]; 
$rela_tabla15='';
$rela_tabla65=''; 

if ($id_tabla16!="")
{
	$sql="select * from tabla_16_cab_cultivo  
	where id_tabla16=$id_tabla16";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla16=$row["id_tabla16"];
		$rela_tabla15=$row["rela_tabla15"];
		$rela_tabla65=$row["rela_tabla65"];
		$t->set_var("rela_tabla15",$row["rela_tabla15"]);
		$t->set_var("rela_tabla65",$row["rela_tabla65"]);
		$t->set_var("tabla16_fecha_cosecha",ver_fecha($row["tabla16_fecha_cosecha"]));
		$t->set_var("tabla16_fecha_siembra",ver_fecha($row["tabla16_fecha_siembra"]));

	}
	
	
	$url="'modulos/cultivo/php/abm_cultivo_interfaz.php'";
	$vars="'nombre_funcion=modificar_cultivo&";
	$vars.="id_tabla16=$id_tabla16&";
	$vars.="tabla16_fecha_cosecha='+abm_cultivo.tabla16_fecha_cosecha.value+'&";
	$vars.="rela_tabla15='+abm_cultivo.rela_tabla15.value+'&";
	$vars.="rela_tabla65='+abm_cultivo.rela_tabla65.value+'&";
	$vars.="tabla16_fecha_siembra='+abm_cultivo.tabla16_fecha_siembra.value";
	
	$url_exito="'modulos/cultivo/php/ver_cultivo_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	$t->set_var("tit","Modificar Cultivo");
}
else
{
	$t->set_var("tabla16_fecha_cosecha","");
	$t->set_var("tabla16_fecha_siembra","");
	$t->set_var("rela_tabla16","");
	$t->set_var("rela_tabla65","");
	
	
	$url="'modulos/cultivo/php/abm_cultivo_interfaz.php'";
	$vars="'nombre_funcion=agregar_cultivo&";
	$vars.="tabla16_fecha_cosecha='+abm_cultivo.tabla16_fecha_cosecha.value+'&";
	$vars.="rela_tabla15='+abm_cultivo.rela_tabla15.value+'&";
	$vars.="rela_tabla65='+abm_cultivo.rela_tabla65.value+'&";
	$vars.="tabla16_fecha_siembra='+abm_cultivo.tabla16_fecha_siembra.value";// aca tenes otro estas por
	//concatenar en la ultima linea y despues no concatenas nada 
				
	$url_exito="'modulos/cultivo/php/ver_cultivo_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Cultivo");
}

//VARIEDAD	
	$sql="Select * from  tabla_15_tbl_variedad  order by tabla15_nombre ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch()) 
		{
				$id_tabla15=$row["id_tabla15"];
				if ($id_tabla15==$rela_tabla15)
				{
						$t->set_var("ID","\"$id_tabla15\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla15_nombre"]));	

				}else{
						$t->set_var("ID",$row["id_tabla15"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla15_nombre"]));	
				}
			$t->parse("VARIEDAD","una_opcion",true);
		}	
	}
	 
	//PARCELAS
	$sql="Select * from  tabla_65_tbl_parcela  order by tabla65_numero ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row_cultivo = $rs->fetch())  
		{
				$id_tabla65=$row_cultivo["id_tabla65"];
				$tabla65_numero=$row_cultivo["id_tabla65"];
				if ($id_tabla65==$rela_tabla65) 
				{
						$t->set_var("ID","\"$id_tabla65\" SELECTED ");
						$t->set_var("NOMBRE",($row_cultivo["tabla65_numero"]));	// aca esta el error

				}else{
						$t->set_var("ID",$row_cultivo["id_tabla65"]);
						$t->set_var("NOMBRE",($row_cultivo["tabla65_numero"]));	
				}
			$t->parse("PARCELA","una_opcion",true);
		}	
	}

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		


$url="'modulos/cultivo/php/ver_cultivo_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
