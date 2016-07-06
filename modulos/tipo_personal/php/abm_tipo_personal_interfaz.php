<?php
/*
Librería: Funciones ABM y de recuperación de datos.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_tipo_personal.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="tipo_personal"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla72=isset($_POST['id_tabla72']) ? intval($_POST['id_tabla72']) : NULL;
$tabla72_descripcion=isset($_POST['tabla72_descripcion']) ? strval($_POST['tabla72_descripcion']) : '';
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';

switch ($nombre_funcion) {
	case "agregar_tipo_personal":
		$id_res=agregar_tipo_personal($tabla72_descripcion, $pdo);
		$vsplit=split("-", $id_res);
		echo $vsplit[1];
		break;
	case "borrar_tipo_personal":
		$id_res=borrar_tipo_personal($id_tabla72, $pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_tipo_personal":
		$id_res=modificar_tipo_personal($id_tabla72, $tabla72_descripcion, $pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;


}
$datos="";
$datos.="id_tabla72<@n:> $id_tabla72<@n>";
$datos.="tabla72_descripcion<@n:> $tabla72_descripcion<@n>";
//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>
