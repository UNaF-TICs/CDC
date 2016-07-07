<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_semillas.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="semilla"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla25=isset($_POST['id_tabla25']) ? intval($_POST['id_tabla25']) : NULL;
$rela_tabla26=isset($_POST['rela_tabla26']) ? intval($_POST['rela_tabla26']) : NULL;
$rela_tabla27=isset($_POST['rela_tabla27']) ? intval($_POST['rela_tabla27']) : NULL; 
$tabla25_nombre=isset($_POST['tabla25_nombre']) ? strval($_POST['tabla25_nombre']) : '';
$rela_tabla15=isset($_POST['rela_tabla15']) ? strval($_POST['rela_tabla15']) : '';
$tabla25_dosis=isset($_POST['tabla25_dosis']) ? strval($_POST['tabla25_dosis']) : '';
$rela_tabla28=isset($_POST['rela_tabla28']) ? strval($_POST['rela_tabla28']) : '';
$rela_tabla74=isset($_POST['rela_tabla74']) ? strval($_POST['rela_tabla74']) : '';
$rela_tabla76=isset($_POST['rela_tabla76']) ? strval($_POST['rela_tabla76']) : '';
$tabla25_nombre=utf8_decode($tabla25_nombre);
$tabla25_dosis=utf8_decode($tabla25_dosis);
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';

switch ($nombre_funcion) {
    case "agregar_semilla":
		$id_res=agregar_semilla($tabla25_nombre,$rela_tabla26,$rela_tabla27,$rela_tabla15,$tabla25_dosis,
$rela_tabla28,$rela_tabla74,$rela_tabla76,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
        break;
    case "borrar_semilla":		
		$id_res=borrar_semilla($id_tabla25,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_semilla":
		$id_res=modificar_semilla($id_tabla25,$tabla25_nombre,$rela_tabla26,$rela_tabla27,$rela_tabla15,$tabla25_dosis,
$rela_tabla28,$rela_tabla74,$rela_tabla76,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;	


}
$datos="";
$datos.="id_tabla25<@n:> $id_tabla25<@n>";
$datos.="tabla25_nombre<@n:> $tabla25_nombre<@n>";
$datos.="rela_tabla26<@n:> $rela_tabla26<@n>";
$datos.="rela_tabla27<@n:> $rela_tabla27<@n>";
$datos.="rela_tabla15<@n:> $rela_tabla15<@n>";
$datos.="tabla25_dosis<@n:> $tabla25_dosis<@n>";
$datos.="rela_tabla28<@n:> $rela_tabla28<@n>";
$datos.="rela_tabla74<@n:> $rela_tabla74<@n>";
$datos.="rela_tabla76<@n:> $rela_tabla76<@n>";
//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>