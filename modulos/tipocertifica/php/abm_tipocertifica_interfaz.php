<?php
/*
Librería: Funciones ABM y de recuperación de datos.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_tipocertifica.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="tipocertifica"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla67=isset($_POST['id_tabla67']) ? intval($_POST['id_tabla67']) : NULL;
$tabla67_descrip=isset($_POST['tabla67_descrip']) ? strval($_POST['tabla67_descrip']) : '';
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';

switch ($nombre_funcion) {
    case "agregar_tipocertifica":
		$id_res=agregar_tipocertifica($tabla67_descrip, $pdo);
		$vsplit=split("-", $id_res);
		echo $vsplit[1];
        break;
    case "borrar_tipocertifica":
		$id_res=borrar_tipocertifica($id_tabla67, $pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_tipocertifica":
		$id_res=modificar_tipocertifica($id_tabla67, $tabla67_descrip, $pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;


}
$datos="";
$datos.="id_tabla67<@n:> $id_tabla67<@n>";
$datos.="tabla67_descrip<@n:> $tabla67_descrip<@n>";
//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>
