<?php
/*
Librería: Funciones ABM y de recuperación de datos.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_sisriego.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="sisriego"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla66=isset($_POST['id_tabla66']) ? intval($_POST['id_tabla66']) : NULL;
$tabla66_descrip=isset($_POST['tabla66_descrip']) ? strval($_POST['tabla66_descrip']) : '';
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';

switch ($nombre_funcion) {
	case "agregar_sisriego":
		$id_res=agregar_sisriego($tabla66_descrip, $pdo);
		$vexplode=explode("-",$id_res);
		$mensaje=$vexplode[1];
		echo $mensaje ;
		break;
	case "borrar_sisriego":
		$id_res=borrar_sisriego($id_tabla66, $pdo);
		$vexplode=explode("-",$id_res);
		$mensaje=$vexplode[1];
		echo $mensaje ;
		break;
	case "modificar_sisriego":
		$id_res=modificar_sisriego($id_tabla66, $tabla66_descrip, $pdo);
		$vexplode=explode("-",$id_res);
		$mensaje=$vexplode[1];
		echo $mensaje ;
		break;
}
$datos="";
$datos.="id_tabla66<@n:> $id_tabla66<@n>";
$datos.="tabla66_descrip<@n:> $tabla66_descrip<@n>";
//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>
