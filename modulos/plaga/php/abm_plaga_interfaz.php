<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_plaga.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="plaga"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla33=isset($_POST['id_tabla33']) ? intval($_POST['id_tabla33']) : NULL;
$tabla33_descripcion=isset($_POST['tabla33_descripcion']) ? strval($_POST['tabla33_descripcion']) : '';
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';


switch ($nombre_funcion) {
    case "agregar_plaga":

		$id_res=agregar_plaga($tabla33_descripcion,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
        break;
    case "borrar_plaga":		
		$id_res=borrar_plaga($id_tabla33,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_plaga":
		$id_res=modificar_plaga($id_tabla33,$tabla33_descripcion,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;	


}
$datos="";
$datos.="id_tabla33<@n:> $id_tabla33<@n>";
$datos.="tabla33_descripcion<@n:> $tabla33_descripcion<@n>";

//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>