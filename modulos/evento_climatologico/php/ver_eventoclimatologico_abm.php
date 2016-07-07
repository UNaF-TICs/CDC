<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_eventoclimatologico_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla99=isset($_POST['id_tabla99']) ? intval($_POST['id_tabla99']) : NULL;
$offset=$_POST["offset"]; 
$rela_tabla16='';
$rela_tabla01=''; 
$rela_tabla74=''; 
$rela_tabla71=''; 
$rela_tabla98=''; 



if ($id_tabla99!="")
{
	$sql="select * from tabla_99_cab_eventoclimatologico  
	where id_tabla99=$id_tabla99";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla99=$row["id_tabla99"];
		$rela_tabla16=$row["rela_tabla16"];
		$rela_tabla01=$row["rela_tabla01"];
		$rela_tabla74=$row["rela_tabla74"];
		$rela_tabla71=$row["rela_tabla71"];
		$rela_tabla98=$row["rela_tabla98"];
		

		$t->set_var("tabla99_observacion",htmlentities($row["tabla99_observacion"],ENT_QUOTES));
		$t->set_var("tabla99_fecha_inicio",htmlentities($row["tabla99_fecha_inicio"],ENT_QUOTES));
		$t->set_var("tabla99_fecha_fin",htmlentities($row["tabla99_fecha_fin"],ENT_QUOTES));
		$t->set_var("rela_tabla16",$row["rela_tabla16"]);
		$t->set_var("rela_tabla01",$row["rela_tabla01"]);
		$t->set_var("rela_tabla74",$row["rela_tabla74"]);
		$t->set_var("rela_tabla71",$row["rela_tabla71"]);
		$t->set_var("tabla99_cantidad",$row["tabla99_cantidad"]);
		$t->set_var("rela_tabla98",$row["rela_tabla98"]);

	}
	
	
	$url="'modulos/evento_climatologico/php/abm_eventoclima_interfaz.php'";
	$vars="'nombre_funcion=modificar_eventoclimatico&";
	$vars.="id_tabla99=$id_tabla99&";
	$vars.="tabla99_observacion='+abm_eventoclimatologico.tabla99_observacion.value+'&";
	$vars.="tabla99_fecha_inicio='+abm_eventoclimatologico.tabla99_fecha_inicio.value+'&";
	$vars.="tabla99_fecha_fin='+abm_eventoclimatologico.tabla99_fecha_fin.value+'&";
	$vars.="rela_tabla16='+abm_eventoclimatologico.rela_tabla16.value+'&";
	$vars.="rela_tabla01='+abm_eventoclimatologico.rela_tabla01.value+'&";
	$vars.="rela_tabla74='+abm_eventoclimatologico.rela_tabla74.value+'&";
	$vars.="rela_tabla71='+abm_eventoclimatologico.rela_tabla71.value+'&";
	$vars.="tabla99_cantidad='+abm_eventoclimatologico.tabla99_cantidad.value+'&";
	$vars.="rela_tabla98='+abm_eventoclimatologico.rela_tabla98.value";
	
	$url_exito="'modulos/evento_climatologico/php/ver_eventoclimatologico_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	$t->set_var("tit","Modificar Evento Climatologico");
}
else
{
	$t->set_var("tabla99_observacion","");
	$t->set_var("tabla99_fecha_inicio","");
	$t->set_var("tabla99_fecha_fin","");
	$t->set_var("rela_tabla16","");
	$t->set_var("rela_tabla01","");
	$t->set_var("rela_tabla71","");
	$t->set_var("rela_tabla74","");
	$t->set_var("tabla99_cantidad","");
	$t->set_var("rela_tabla98","");
	
	$url="'modulos/evento_climatologico/php/abm_eventoclima_interfaz.php'";
	$vars="'nombre_funcion=agregar_eventoclimatico&";
	$vars.="tabla99_observacion='+abm_eventoclimatologico.tabla99_observacion.value+'&";
	$vars.="tabla99_fecha_inicio='+abm_eventoclimatologico.tabla99_fecha_inicio.value+'&";
	$vars.="tabla99_fecha_fin='+abm_eventoclimatologico.tabla99_fecha_fin.value+'&";
	$vars.="rela_tabla16='+abm_eventoclimatologico.rela_tabla16.value+'&";
	$vars.="rela_tabla01='+abm_eventoclimatologico.rela_tabla01.value+'&";
	$vars.="rela_tabla74='+abm_eventoclimatologico.rela_tabla74.value+'&";
	$vars.="rela_tabla71='+abm_eventoclimatologico.rela_tabla71.value+'&";
	$vars.="tabla99_cantidad='+abm_eventoclimatologico.tabla99_cantidad.value+'&";
	$vars.="rela_tabla98='+abm_eventoclimatologico.rela_tabla98.value";
			
	$url_exito="'modulos/evento_climatologico/php/ver_eventoclimatologico_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar eventoclimatologico");
}

    $sql="select * from tabla_16_cab_cultivo join tabla_15_tbl_variedad on tabla_16_cab_cultivo.rela_tabla15=tabla_15_tbl_variedad.id_tabla15 ";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch()) 
		{
				$id_tabla16=$row["id_tabla16"];
				$id_tabla15=$row["id_tabla15"];
				if ($id_tabla16==$rela_tabla16)
				{
						$t->set_var("ID","\"$id_tabla16\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla15_nombre"]));	

				}else{
						$t->set_var("ID",$row["id_tabla16"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla15_nombre"]));	
				}
			$t->parse("CULTIVO","una_opcion",true);
		}	
	}
	
	//TEMAS
	$sql="Select * from  tabla_01_usuarios  order by tabla01_nombre ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch())  
		{
				$id_tabla01=$row["id_tabla01"];
				if ($id_tabla01==$rela_tabla01)
				{
						$t->set_var("ID","\"$id_tabla01\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla01_nombre"]));	

				}else{
						$t->set_var("ID",$row["id_tabla01"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla01_nombre"]));	
				}
			$t->parse("USUARIO","una_opcion",true);
		}	
	}

	$sql="Select * from  tabla_74_tbl_unidad_medicion  order by tabla74_Tipo_Unidad ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch())  
		{
				$id_tabla74=$row["id_tabla74"];
				if ($id_tabla74==$rela_tabla74)
				{
						$t->set_var("ID","\"$id_tabla74\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla74_Tipo_Unidad"]));	

				}else{
						$t->set_var("ID",$row["id_tabla74"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla74_Tipo_Unidad"]));	
				}
			$t->parse("TIPOUNIDAD","una_opcion",true);
		}	
	}

	$sql="select * from tabla_71_cab_personal inner join tabla_70_tbl_persona on tabla_71_cab_personal.rela_tabla70=tabla_70_tbl_persona.id_tabla70";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch())  
		{
				$id_tabla71=$row["id_tabla71"];
				if ($id_tabla71==$rela_tabla71)
				{
						$t->set_var("ID","\"$id_tabla71\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla70_nombre_apellido"]));	

				}else{
						$t->set_var("ID",$row["id_tabla71"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla70_nombre_apellido"]));	
				}
			$t->parse("PERSONAL","una_opcion",true);
		}	
	}


	$sql="Select * from  tabla_98_tbl_tipo_evento  order by tabla98_descripcion ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch())  
		{
				$id_tabla98=$row["id_tabla98"];
				if ($id_tabla98==$rela_tabla98)
				{
						$t->set_var("ID","\"$id_tabla98\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla98_descripcion"]));	

				}else{
						$t->set_var("ID",$row["id_tabla98"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla98_descripcion"]));	
				}
			$t->parse("TIPOEVENTO","una_opcion",true);
		}	
	}

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		


$url="'modulos/evento_climatologico/php/ver_eventoclimatologico_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
