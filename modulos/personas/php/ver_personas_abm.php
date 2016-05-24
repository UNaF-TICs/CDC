<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
require_once "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"main"		=> "ver_personas_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
$id_tablamodulo=$_POST["id_tablamodulo"];
$id_tabla07=$_POST["id_tabla07"]; 
$offset=$_POST["offset"]; 

if ($id_tabla07!="")
{
	$sql="select * from tabla_07_personas 
			where id_tabla07=$id_tabla07";
	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		$row = mysql_fetch_assoc($result);
		$id_tabla07 = $row["id_tabla07"];
		$tabla07_sexo = $row["tabla07_sexo"];
		$rela_tabla08 = $row["rela_tabla08"];
		$t->set_var("rela_tabla08",$rela_tabla08);
		$t->set_var("tabla07_dni", $row["tabla07_dni"]);
		$t->set_var("tabla07_sexo",$tabla07_sexo);
		$t->set_var("tabla07_nropersona",htmlentities($row["tabla07_nropersona"],ENT_QUOTES));
		$t->set_var("tabla07_nombre",htmlentities($row["tabla07_nombre"],ENT_QUOTES));
		$t->set_var("tabla07_apellido",htmlentities($row["tabla07_apellido"],ENT_QUOTES));
		$t->set_var("tabla07_direccion",htmlentities($row["tabla07_direccion"],ENT_QUOTES));
		$t->set_var("tabla07_telfijo",htmlentities($row["tabla07_telfijo"],ENT_QUOTES));
		$t->set_var("tabla07_celular",htmlentities($row["tabla07_celular"],ENT_QUOTES));
		$t->set_var("tabla07_cumple",ver_fecha($row["tabla07_cumple"]));
		$t->set_var("tabla07_mail",htmlentities($row["tabla07_mail"],ENT_QUOTES));
		
		$edad=calculaedad($row["tabla07_cumple"]);
		
		$t->set_var("edad",$edad);

		switch ($tabla07_sexo) {
			case "0":
				$t->set_var("selected_hab","");		
				$t->set_var("selected_des","selected");		
			break;
			case "1":
				$t->set_var("selected_hab","selected");		
				$t->set_var("selected_des","");		
			break;
		}
		
		
	}
	
	
	$url="'modulos/personas/php/abm_personas_interfaz.php'";
	$vars="'nombre_funcion=modificar_personas&";
	$vars.="id_tabla07=$id_tabla07&";
	$vars.="tabla07_nropersona='+abm.tabla07_nropersona.value+'&";
	$vars.="tabla07_nombre='+abm.tabla07_nombre.value+'&";
	$vars.="tabla07_apellido='+abm.tabla07_apellido.value+'&";
	$vars.="tabla07_telfijo='+abm.tabla07_telfijo.value+'&";
	$vars.="tabla07_direccion='+abm.tabla07_direccion.value+'&";
	$vars.="tabla07_celular='+abm.tabla07_celular.value+'&";
	$vars.="tabla07_cumple='+abm.tabla07_cumple.value+'&";
	$vars.="tabla07_mail='+abm.tabla07_mail.value+'&";
	$vars.="tabla07_sexo='+abm.tabla07_sexo.value+'&";
	$vars.="tabla07_dni='+abm.tabla07_dni.value";
	
	$url_exito="'modulos/personas/php/ver_personas_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Modificar Personas");

}
else
{
	$t->set_var("tabla07_nombre","");
	$t->set_var("tabla07_apellido","");
	$t->set_var("tabla07_direccion","");
	$t->set_var("tabla07_telfijo","");
	$t->set_var("tabla07_celular","");
	$t->set_var("tabla07_cumple","");
	$t->set_var("tabla07_mail","");
	$t->set_var("tabla07_dni","");
	$t->set_var("edad","");
	$t->set_var("rela_tabla08","");
	$t->set_var("tabla07_nropersona","");

			
	$url="'modulos/personas/php/abm_personas_interfaz.php'";
	$vars="'nombre_funcion=agregar_personas&";
	$vars.="tabla07_nropersona='+abm.tabla07_nropersona.value+'&";
	$vars.="tabla07_nombre='+abm.tabla07_nombre.value+'&";
	$vars.="tabla07_apellido='+abm.tabla07_apellido.value+'&";
	$vars.="tabla07_telfijo='+abm.tabla07_telfijo.value+'&";
	$vars.="tabla07_direccion='+abm.tabla07_direccion.value+'&";
	$vars.="tabla07_celular='+abm.tabla07_celular.value+'&";
	$vars.="tabla07_cumple='+abm.tabla07_cumple.value+'&";
	$vars.="tabla07_mail='+abm.tabla07_mail.value+'&";
	$vars.="tabla07_sexo='+abm.tabla07_sexo.value+'&";
	$vars.="tabla07_dni='+abm.tabla07_dni.value";
	
	$url_exito="'modulos/personas/php/ver_personas_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Personas");
}
	
switch ($tabla07_sexo) {
			case "0":
				$t->set_var("selected_hab","");		
				$t->set_var("selected_des","selected");		
			break;
			case "1":
				$t->set_var("selected_hab","selected");		
				$t->set_var("selected_des","");		
			break;
		}

function calculaedad($fechanacimiento){
    list($ano,$mes,$dia) = explode("-",$fechanacimiento);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
    return $ano_diferencia;
}



		
$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		

$url_exito="'modulos/personas/php/ver_personas_abm.php'";
$id="'tabs-$id_tablamodulo'";
$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
$t->set_var("funcion_guardar_volver","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");

$t->set_var("funcion_cancelar","cargar_post('modulos/personas/php/ver_personas_busqueda.php','tabs-$id_tablamodulo','offset=$offset&id_tablamodulo=$id_tablamodulo');");	
$t->set_var("funcion_cerrar","cargar_post('modulos/personas/php/ver_personas_busqueda.php','tabs-$id_tablamodulo','offset=$offset&id_tablamodulo=$id_tablamodulo');");	

$t->pparse("OUT", "main");
?>