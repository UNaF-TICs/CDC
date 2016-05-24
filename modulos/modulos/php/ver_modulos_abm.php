<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"main"		=> "ver_modulo_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
if (isset($_POST['id_tablamodulo'])) {
$id_tablamodulo=$_POST["id_tablamodulo"];
} else {
$id_tablamodulo = "";
}
if (isset($_POST['id_tabla02'])) {
$id_tabla02=$_POST["id_tabla02"];
} else {
$id_tabla02 = "";
}
if (isset($_POST['offset'])) {
$offset=$_POST["offset"];
} else {
$offset = "";
}
$rela_padre="";
$tabla02_tipo="";
if ($id_tabla02!="")
{

	$rs = $pdo->query("select * from tabla_02_modulos 
	where id_tabla02=$id_tabla02");//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$rela_padre=$row["rela_padre"];
		$tabla02_tipo=$row["tabla02_tipo"];
		$t->set_var("tabla02_nombre",htmlentities($row["tabla02_nombre"],ENT_QUOTES));
		$t->set_var("tabla02_orden",htmlentities($row["tabla02_orden"],ENT_QUOTES));
		$t->set_var("tabla02_path_home",htmlentities($row["tabla02_path_home"],ENT_QUOTES));
		$t->set_var("tabla02_ayuda",htmlentities($row["tabla02_ayuda"],ENT_QUOTES));
	}
	
	
	$url="'modulos/modulos/php/abm_modulos_interfaz.php'";
	$vars="'nombre_funcion=modificar_modulo&";
	$vars.="id_tabla02=$id_tabla02&";
	$vars.="tabla02_tipo='+abm.tabla02_tipo.value+'&";
	$vars.="rela_padre='+abm.rela_padre.value+'&";
	$vars.="tabla02_nombre='+abm.tabla02_nombre.value+'&";
	$vars.="tabla02_orden='+abm.tabla02_orden.value+'&";
	$vars.="tabla02_path_home='+abm.tabla02_path_home.value+'&";
	$vars.="tabla02_ayuda='+abm.tabla02_ayuda.value";
			
	$url_exito="'modulos/modulos/php/ver_modulos.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Modificar M&oacute;dulo");

}
else
{
	$t->set_var("tabla02_nombre");
	$t->set_var("tabla02_orden");
	$t->set_var("tabla02_path_home");
	$t->set_var("tabla02_ayuda");

	$url="'modulos/modulos/php/abm_modulos_interfaz.php'";
	$vars="'nombre_funcion=agregar_modulo&";
	$vars.="tabla02_tipo='+abm.tabla02_tipo.value+'&";
	$vars.="rela_padre='+abm.rela_padre.value+'&";
	$vars.="tabla02_nombre='+abm.tabla02_nombre.value+'&";
	$vars.="tabla02_orden='+abm.tabla02_orden.value+'&";
	$vars.="tabla02_path_home='+abm.tabla02_path_home.value+'&";
	$vars.="tabla02_ayuda='+abm.tabla02_ayuda.value";
			
	$url_exito="'modulos/modulos/php/ver_modulos.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar M&oacute;dulo");
}

$rs = $pdo->query("select * from tabla_02_modulos order by tabla02_nombre ASC");//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row_tipo = $rs->fetch())
	{
		$id_tabla02=$row_tipo["id_tabla02"];
		if ($id_tabla02==$rela_padre)
		{
			$t->set_var("ID","\"$id_tabla02\" SELECTED");
			$t->set_var("NOMBRE",htmlentities($row_tipo["tabla02_nombre"],ENT_QUOTES));
			$t->parse("PADRES","una_opcion",true);
		}
		else
		{
			$t->set_var("ID",$id_tabla02);
			$t->set_var("NOMBRE",htmlentities($row_tipo["tabla02_nombre"],ENT_QUOTES));
			$t->parse("PADRES","una_opcion",true);

		}				
	}
}

$tipo = array('0' => 'Sub Modulo','1' => 'Contenedor'); 
while ($fruit_name = current($tipo)) 
{
	$id_tipo=key($tipo);
    if ($id_tipo == $tabla02_tipo) 
	{
        //echo key($array).'<br />';
		$t->set_var("ID","\"$id_tipo\" SELECTED");
		$t->set_var("NOMBRE",htmlentities($fruit_name, ENT_QUOTES));	
		$t->parse("TIPO","una_opcion",true);
    }
	else
	{
		$t->set_var("ID",$id_tipo);
		$t->set_var("NOMBRE",htmlentities($fruit_name, ENT_QUOTES));	
		$t->parse("TIPO","una_opcion",true);	
	}
    next($tipo);
}
	
$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		
//$t->set_var("funcion_guardar","alert($estructura_hc);");		
$t->set_var("funcion_cancelar","cargar_post('modulos/modulos/php/ver_modulos.php','tabs-$id_tablamodulo','offset=$offset&id_tablamodulo=$id_tablamodulo');");	
$t->set_var("funcion_cerrar","cargar_post('modulos/modulos/php/ver_modulos.php','tabs-$id_tablamodulo','offset=$offset&id_tablamodulo=$id_tablamodulo');");	

//echo $estructura_hc;
$t->pparse("OUT", "main");

?>



