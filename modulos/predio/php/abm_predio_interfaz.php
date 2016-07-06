<?php
/*
Librería: Funciones ABM y de recuperación de datos de predios.
*/
require_once "../../../php/check.php";
require_once "../../../php/funciones_comunes.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_predio.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="predio"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla64=isset($_POST['id_tabla64']) ? intval($_POST['id_tabla64']) : NULL;
$rela_tabla09=isset($_POST['rela_tabla09']) ? intval($_POST['rela_tabla09']) : NULL;
$rela_tabla63=isset($_POST['rela_tabla63']) ? intval($_POST['rela_tabla63']) : NULL;
$tabla64_nombrepredio=isset($_POST['tabla64_nombrepredio']) ? strval($_POST['tabla64_nombrepredio']) : '';
$tabla64_limites=isset($_POST['tabla64_limites']) ? strval($_POST['tabla64_limites']) : '';
$tabla64_areatotal=isset($_POST['tabla64_areatotal']) ? strval($_POST['tabla64_areatotal']) : '';
$tabla64_nombrepredio=utf8_decode($tabla64_nombrepredio);

$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';

switch ($nombre_funcion) {
	case "agregar_predio":
		$id_res=agregar_predio($tabla64_nombrepredio,$rela_tabla09,$rela_tabla63,$tabla64_limites,$tabla64_areatotal,$pdo);
		$vsplit=split("-",$id_res);
		if ($vsplit[0] == 1) {
			echo $vsplit[1];
		} else {
			phpConsoleLog($vsplit[1]);
		}
		break;
	case "borrar_predio":
		$id_res=borrar_predio($id_tabla64,$pdo);
		$vsplit=split("-",$id_res);
		if ($vsplit[0] == 1) {
			echo $vsplit[1];
		} else {
			phpConsoleLog($vsplit[1]);
		}
		break;
	case "modificar_predio":
		$id_res=modificar_predio($id_tabla64,$tabla64_nombrepredio,$rela_tabla09,$rela_tabla63,$tabla64_limites,$tabla64_areatotal,$pdo);
		$vsplit=split("-",$id_res);
		if ($vsplit[0] == 1) {
			echo $vsplit[1];
		} else {
			phpConsoleLog($vsplit[1]);
		}
		break;
	default:
		phpConsoleLog("No encuentra ".$nombre_funcion);
}
$datos="";
$datos.="id_tabla64<@n:> $id_tabla64<@n>";
$datos.="tabla64_nombrepredio<@n:> $tabla64_nombrepredio<@n>";
$datos.="rela_tabla09<@n:> $rela_tabla09<@n>";
$datos.="rela_tabla63<@n:> $rela_tabla63<@n>";
$datos.="tabla64_limites<@n:> $tabla64_limites<@n>";
$datos.="tabla64_areatotal<@n:> $tabla64_areatotal<@n>";
//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>
