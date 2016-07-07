<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_fitosanitarios_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla18=isset($_POST['id_tabla18']) ? intval($_POST['id_tabla18']) : NULL;
$offset=$_POST["offset"]; 
$Rela_tabla21='';
$Rela_tabla33=''; 

if ($id_tabla18!="")
{
	$sql="select * from tabla_18_cab_fitosanitario  
	where id_tabla18=$id_tabla18";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla18=$row["id_tabla18"];
		$Rela_tabla21=$row["Rela_tabla21"];
		$Rela_tabla33=$row["Rela_tabla33"];
		$t->set_var("Rela_tabla21",$row["Rela_tabla21"]);
		$t->set_var("Rela_tabla33",$row["Rela_tabla33"]);
		$t->set_var("Fitosanitario_Nombre",htmlentities($row["Fitosanitario_Nombre"],ENT_QUOTES));
		$t->set_var("Fitosanitario_Fabricante",htmlentities($row["Fitosanitario_Fabricante"],ENT_QUOTES));
		$t->set_var("Cantidad_Agua",htmlentities($row["Cantidad_Agua"],ENT_QUOTES));
		$t->set_var("Fitosanitario_Fecha_caducidad",ver_fecha($row["Fitosanitario_Fecha_caducidad"]));
		$t->set_var("Rela_tabla19",$row["Rela_tabla19"]);
		$t->set_var("Rela_tabla20",$row["Rela_tabla20"]);

	}
	
	
	$url="'modulos/fitosanitarios/php/abm_fitosanitarios_interfaz.php'";
	$vars="'nombre_funcion=modificar_fitosanitarios&";
	$vars.="id_tabla18=$id_tabla18&";
	$vars.="Fitosanitario_Nombre='+abm_fitosanitarios.Fitosanitario_Nombre.value+'&";
	$vars.="Rela_tabla21='+abm_fitosanitarios.Rela_tabla21.value+'&";
	$vars.="Rela_tabla33='+abm_fitosanitarios.Rela_tabla33.value+'&";
	$vars.="Fitosanitario_Fabricante='+abm_fitosanitarios.Fitosanitario_Fabricante.value+'&";
	$vars.="Fitosanitario_Fecha_caducidad='+abm_fitosanitarios.Fitosanitario_Fecha_caducidad.value+'&";
	$vars.="Rela_tabla19='+abm_fitosanitarios.Rela_tabla19.value+'&";
	$vars.="Rela_tabla20='+abm_fitosanitarios.Rela_tabla20.value+'&";
	$vars.="Cantidad_Agua='+abm_fitosanitarios.Cantidad_Agua.value";
	
	$url_exito="'modulos/fitosanitarios/php/ver_fitosanitarios_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	$t->set_var("tit","Modificar Fitosanitario");
}
else
{
	$t->set_var("Fitosanitario_Nombre","");
	$t->set_var("Fitosanitario_Fabricante","");
	$t->set_var("Cantidad_Agua","");
	$t->set_var("Rela_tabla21","");
	$t->set_var("Rela_tabla33","");
	$t->set_var("Fitosanitario_Fecha_caducidad","");
	$t->set_var("Rela_tabla19","");
	$t->set_var("Rela_tabla20","");
	
	$url="'modulos/fitosanitarios/php/abm_fitosanitarios_interfaz.php'";
	$vars="'nombre_funcion=agregar_fitosanitarios&";
	$vars.="Fitosanitario_Nombre='+abm_fitosanitarios.Fitosanitario_Nombre.value+'&";
	$vars.="Rela_tabla21='+abm_fitosanitarios.Rela_tabla21.value+'&";
	$vars.="Rela_tabla33='+abm_fitosanitarios.Rela_tabla33.value+'&";
	$vars.="Fitosanitario_Fabricante='+abm_fitosanitarios.Fitosanitario_Fabricante.value+'&";
	$vars.="Fitosanitario_Fecha_caducidad='+abm_fitosanitarios.Fitosanitario_Fecha_caducidad.value+'&";
	$vars.="Rela_tabla19='+abm_fitosanitarios.Rela_tabla19.value+'&";
	$vars.="Rela_tabla20='+abm_fitosanitarios.Rela_tabla20.value+'&";
	$vars.="Cantidad_Agua='+abm_fitosanitarios.Cantidad_Agua.value";
			
	$url_exito="'modulos/fitosanitarios/php/ver_fitosanitarios_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Fitosanitario");
}

//TEMAS
	$sql="Select * from  tabla_19_tbl_tipo_dosis  order by Tipo_Dosis ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch()) 
		{
				$id_tabla19=$row["id_tabla19"];
				if ($id_tabla19=="Rela_tabla19")
				{
						$t->set_var("ID","\"$id_tabla19\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["Tipo_Dosis"]));	

				}else{
						$t->set_var("ID",$row["id_tabla19"]);
						$t->set_var("NOMBRE",utf8_encode($row["Tipo_Dosis"]));	
				}
			$t->parse("DOSIS","una_opcion",true);
		}	
	}


	$sql="Select * from  tabla_20_tbl_tipo_preparado  order by tabla20_descripcion ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch()) 
		{
				$id_tabla20=$row["id_tabla20"];
				
				if ($id_tabla20=="Rela_tabla20")
				{
						$t->set_var("ID","\"$id_tabla20\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla20_descripcion"]));	

				}else{
						$t->set_var("ID",$row["id_tabla20"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla20_descripcion"]));	
				}
			$t->parse("PREPARADO","una_opcion",true);
		}	
	}


	$sql="Select * from  tabla_21_tbl_tipo_funcion  order by tabla21_funcion ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch()) 
		{
				$id_tabla21=$row["id_tabla21"];
				if ($id_tabla21=="Rela_tabla21")
				{
						$t->set_var("ID","\"$id_tabla21\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla21_funcion"]));	

				}else{
						$t->set_var("ID",$row["id_tabla21"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla21_funcion"]));	
				}
			$t->parse("FUNCION","una_opcion",true);
		}	
	}
	
	//TEMAS
	$sql="Select * from  tabla_33_tbl_plaga  order by tabla33_descripcion ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch())  
		{
				$id_tabla33=$row["id_tabla33"];
				if ($id_tabla33=="Rela_tabla33")
				{
						$t->set_var("ID","\"$id_tabla33\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla33_descripcion"]));	

				}else{
						$t->set_var("ID",$row["id_tabla33"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla33_descripcion"]));	
				}
			$t->parse("PLAGAS","una_opcion",true);
		}	
	}

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		


$url="'modulos/fitosanitarios/php/ver_fitosanitarios_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
