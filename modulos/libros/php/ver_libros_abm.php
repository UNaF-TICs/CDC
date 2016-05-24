<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_libros_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla10=isset($_POST['id_tabla10']) ? intval($_POST['id_tabla10']) : NULL;
$offset=$_POST["offset"]; 
$rela_tabla09='';
$rela_tabla11=''; 

if ($id_tabla10!="")
{
	$sql="select * from tabla_10_libros  
	where id_tabla10=$id_tabla10";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla10=$row["id_tabla10"];
		$rela_tabla09=$row["rela_tabla09"];
		$rela_tabla11=$row["rela_tabla11"];
		$t->set_var("rela_tabla09",$row["rela_tabla09"]);
		$t->set_var("rela_tabla11",$row["rela_tabla11"]);
		$t->set_var("tabla10_titulo",htmlentities($row["tabla10_titulo"],ENT_QUOTES));
		$t->set_var("tabla10_subtitulo",htmlentities($row["tabla10_subtitulo"],ENT_QUOTES));
		$t->set_var("tabla10_descripcion",htmlentities($row["tabla10_descripcion"],ENT_QUOTES));
		$t->set_var("tabla10_fecha_entrada",ver_fecha($row["tabla10_fecha_entrada"]));
		$t->set_var("tabla10_tomo",$row["tabla10_tomo"]);
		$t->set_var("tabla10_cantidad",$row["tabla10_cantidad"]);

	}
	
	
	$url="'modulos/libros/php/abm_libros_interfaz.php'";
	$vars="'nombre_funcion=modificar_libros&";
	$vars.="id_tabla10=$id_tabla10&";
	$vars.="tabla10_titulo='+abm_libros.tabla10_titulo.value+'&";
	$vars.="rela_tabla09='+abm_libros.rela_tabla09.value+'&";
	$vars.="rela_tabla11='+abm_libros.rela_tabla11.value+'&";
	$vars.="tabla10_subtitulo='+abm_libros.tabla10_subtitulo.value+'&";
	$vars.="tabla10_fecha_entrada='+abm_libros.tabla10_fecha_entrada.value+'&";
	$vars.="tabla10_tomo='+abm_libros.tabla10_tomo.value+'&";
	$vars.="tabla10_cantidad='+abm_libros.tabla10_cantidad.value+'&";
	$vars.="tabla10_descripcion='+abm_libros.tabla10_descripcion.value";
	
	$url_exito="'modulos/libros/php/ver_libros_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	$t->set_var("tit","Modificar Libro");
}
else
{
	$t->set_var("tabla10_titulo","");
	$t->set_var("tabla10_subtitulo","");
	$t->set_var("tabla10_descripcion","");
	$t->set_var("rela_tabla09","");
	$t->set_var("rela_tabla11","");
	$t->set_var("tabla10_fecha_entrada","");
	$t->set_var("tabla10_tomo","");
	$t->set_var("tabla10_cantidad","");
	
	$url="'modulos/libros/php/abm_libros_interfaz.php'";
	$vars="'nombre_funcion=agregar_libros&";
	$vars.="tabla10_titulo='+abm_libros.tabla10_titulo.value+'&";
	$vars.="rela_tabla09='+abm_libros.rela_tabla09.value+'&";
	$vars.="rela_tabla11='+abm_libros.rela_tabla11.value+'&";
	$vars.="tabla10_subtitulo='+abm_libros.tabla10_subtitulo.value+'&";
	$vars.="tabla10_fecha_entrada='+abm_libros.tabla10_fecha_entrada.value+'&";
	$vars.="tabla10_tomo='+abm_libros.tabla10_tomo.value+'&";
	$vars.="tabla10_cantidad='+abm_libros.tabla10_cantidad.value+'&";
	$vars.="tabla10_descripcion='+abm_libros.tabla10_descripcion.value";
			
	$url_exito="'modulos/libros/php/ver_libros_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Libro");
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
	
	//TEMAS
	$sql="Select * from  tabla_11_editoriales  order by tabla11_nombre ASC";
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

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		


$url="'modulos/libros/php/ver_libros_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
