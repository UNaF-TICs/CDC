<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_semillas_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla25=isset($_POST['id_tabla25']) ? intval($_POST['id_tabla25']) : NULL;
$offset=$_POST["offset"]; 
$rela_tabla26='';
$rela_tabla27=''; 
$rela_tabla15='';
$rela_tabla28='';
$rela_tabla74='';
$rela_tabla76='';

if ($id_tabla25!="")
{
	$sql="select * from tabla_25_cab_semilla  
	where id_tabla25=$id_tabla25";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla25=$row["id_tabla25"];
		$rela_tabla26=$row["rela_tabla26"];
		$rela_tabla27=$row["rela_tabla27"];
		$rela_tabla15=$row["rela_tabla15"];
		$rela_tabla28=$row["rela_tabla28"];
		$rela_tabla74=$row["rela_tabla74"];
		$rela_tabla76=$row["rela_tabla76"];
		$t->set_var("rela_tabla26",$row["rela_tabla26"]);
		$t->set_var("rela_tabla27",$row["rela_tabla27"]);
		$t->set_var("tabla25_nombre",$row["tabla25_nombre"]);
		$t->set_var("rela_tabla15",$row["rela_tabla15"]);
		$t->set_var("tabla25_dosis",$row["tabla25_dosis"]);
		$t->set_var("rela_tabla28",$row["rela_tabla28"]);
		$t->set_var("rela_tabla74",$row["rela_tabla74"]);
		$t->set_var("rela_tabla76",$row["rela_tabla76"]);

	}
	
	
	$url="'modulos/semillas/php/abm_semillas_interfaz.php'";
	$vars="'nombre_funcion=modificar_semilla&";
	$vars.="id_tabla25=$id_tabla25&";
	$vars.="tabla25_nombre='+abm_semillas.tabla25_nombre.value+'&";
	$vars.="rela_tabla26='+abm_semillas.rela_tabla26.value+'&";
	$vars.="rela_tabla27='+abm_semillas.rela_tabla27.value+'&";
	$vars.="rela_tabla15='+abm_semillas.rela_tabla15.value+'&";
	$vars.="rela_tabla28='+abm_semillas.rela_tabla28.value+'&";
	$vars.="rela_tabla74='+abm_semillas.rela_tabla74.value+'&";
	$vars.="rela_tabla76='+abm_semillas.rela_tabla76.value+'&";
	$vars.="tabla25_dosis='+abm_semillas.tabla25_dosis.value";
	
	$url_exito="'modulos/semillas/php/ver_semillas_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	$t->set_var("tit","Modificar semilla");
}
else
{
	$t->set_var("tabla25_nombre","");
	$t->set_var("rela_tabla15","");
	$t->set_var("tabla25_dosis","");
	$t->set_var("rela_tabla26","");
	$t->set_var("rela_tabla27","");
	$t->set_var("rela_tabla28","");
	$t->set_var("rela_tabla74","");
	$t->set_var("rela_tabla76","");
	
	$url="'modulos/semillas/php/abm_semillas_interfaz.php'";
	$vars="'nombre_funcion=agregar_semilla&";
	$vars.="tabla25_nombre='+abm_semillas.tabla25_nombre.value+'&";
	$vars.="rela_tabla26='+abm_semillas.rela_tabla26.value+'&";
	$vars.="rela_tabla27='+abm_semillas.rela_tabla27.value+'&";
	$vars.="rela_tabla15='+abm_semillas.rela_tabla15.value+'&";
	$vars.="rela_tabla28='+abm_semillas.rela_tabla28.value+'&";
	$vars.="rela_tabla74='+abm_semillas.rela_tabla74.value+'&";
	$vars.="rela_tabla76='+abm_semillas.rela_tabla76.value+'&";
	$vars.="tabla25_dosis='+abm_semillas.tabla25_dosis.value";
			
	$url_exito="'modulos/semillas/php/ver_semillas_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Libro");
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
	
	
	//TIPO DE FRUTO
	$sql="Select * from  tabla_26_tbl_tipo_fruto order by tabla26_descripcion ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch())  
		{
				$id_tabla26=$row["id_tabla26"];
				if ($id_tabla26==$rela_tabla26)
				{
						$t->set_var("ID","\"$id_tabla26\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla26_descripcion"]));	

				}else{
						$t->set_var("ID",$row["id_tabla26"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla26_descripcion"]));	
				}
			$t->parse("TIPO_FRUTO","una_opcion",true);
		}	
	}


		//TIPO DE GERMINACION
	$sql="Select * from  tabla_27_tbl_tipo_germinacion order by tabla27_descripcion ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch())  
		{
				$id_tabla27=$row["id_tabla27"];
				if ($id_tabla27==$rela_tabla27)
				{
						$t->set_var("ID","\"$id_tabla27\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla27_descripcion"]));	

				}else{
						$t->set_var("ID",$row["id_tabla27"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla27_descripcion"]));	
				}
			$t->parse("TIPO_GERMINACION","una_opcion",true);
		}	
	}

			//TEMPERATURA Y HUMEDAD
	$sql="Select * from  tabla_28_tbl_temperatura_humedad order by tabla28_descripcion ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch())  
		{
				$id_tabla28=$row["id_tabla28"];
				if ($id_tabla28==$rela_tabla28)
				{
						$t->set_var("ID","\"$id_tabla28\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla28_descripcion"]));	

				}else{
						$t->set_var("ID",$row["id_tabla28"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla28_descripcion"]));	
				}
			$t->parse("TEMPERATURA_HUMEDAD","una_opcion",true);
		}	
	}

				//UNIDAD DE MEDICION
	$sql="Select * from  tabla_74_tbl_unidad_medicion order by tabla74_Tipo_Unidad ASC";
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
			$t->parse("UNIDAD_MEDICION","una_opcion",true);
		}	
	}

				//UNIDAD DE DOSIS
	$sql="Select * from  tabla_76_tbl_unidad_dosis order by tabla76_descripcion ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch())  
		{
				$id_tabla76=$row["id_tabla76"];
				if ($id_tabla76==$rela_tabla76)
				{
						$t->set_var("ID","\"$id_tabla76\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla76_descripcion"]));	

				}else{
						$t->set_var("ID",$row["id_tabla76"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla76_descripcion"]));	
				}
			$t->parse("UNIDAD_DOSIS","una_opcion",true);
		}	
	}

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		


$url="'modulos/semillas/php/ver_semillas_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
