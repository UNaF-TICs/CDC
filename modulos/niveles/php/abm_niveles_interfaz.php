<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/

require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_arbol_ubicacion_geografica.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="niveles"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla09=isset($_POST['id_tabla10']) ? intval($_POST['id_tabla10']) : NULL;
$rela_padre=isset($_POST['tabla10_descripcion']) ? intval($_POST['tabla10_descripcion']) : NULL;
$rela_tabla10=isset($_POST['rela_tabla11']) ? intval($_POST['rela_tabla11']) : NULL; 
$tabla09_descripcion=isset($_POST['tabla10_nivel']) ? strval($_POST['tabla10_nivel']) : '';

$nombre_funcion=$_POST["nombre_funcion"];


switch ($nombre_funcion) {
    case "agregar_arbol_ubicacion_geografica":
		$id_res=agregar_arbol_ubicacion_geografica($rela_padre,$rela_tabla10,$tabla09_descripcion,$tabla09_codigo,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
        break;
    case "borrar_arbol_ubicacion_geografica":		
		$id_res=borrar_libros($id_tabla09,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_arbol_ubicacion_geografica":
		$id_res=modificar_libros($id_tabla09,$rela_padre,$rela_tabla10,$tabla09_descripcion,$tabla09_codigo,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;	


}
$datos="";
$datos.="id_tabla10<@n:> $id_tabla10<@n>";
$datos.="tabla10_descripcion<@n:> $tabla10_descripcion<@n>";
$datos.="rela_tabla11<@n:> $rela_tabla11<@n>";
$datos.="tabla10_nivel<@n:> $tabla10_nivel<@n>";

//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>