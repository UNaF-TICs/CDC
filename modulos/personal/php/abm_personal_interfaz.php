<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_personal.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="personal"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla70=isset($_POST['id_tabla70']) ? intval($_POST['id_tabla70']) : NULL;
$tabla70_nombre_apellido=isset($_POST['tabla70_nombre_apellido']) ? strval($_POST['tabla70_nombre_apellido']) : '';
$tabla70_razon_social=isset($_POST['tabla70_razon_social']) ? strval($_POST['tabla70_razon_social']) : '';
$tabla70_cuit=isset($_POST['tabla70_cuit']) ? strval($_POST['tabla70_cuit']) : '';
$tabla70_dni=isset($_POST['tabla70_dni']) ? strval($_POST['tabla70_dni']) : '';
$tabla70_foto=isset($_POST['tabla70_foto']) ? strval($_POST['tabla70_foto']) : '';
$tabla70_email=isset($_POST['tabla70_email']) ? strval($_POST['tabla70_email']) : '';
$tabla70_telefono=isset($_POST['tabla70_telefono']) ? strval($_POST['tabla70_telefono']) : '';
$tabla70_direccion=isset($_POST['tabla70_direccion']) ? strval($_POST['tabla70_direccion']) : '';

$tabla70_nombre_apellido=utf8_decode($tabla70_nombre_apellido);
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';

switch ($nombre_funcion) {
    case "agregar_personal":
		$id_res=agregar_personal($tabla70_razon_social,$tabla70_cuit,$tabla70_nombre_apellido,$tabla70_dni,$tabla70_foto,$tabla70_email,$tabla70_telefono,$tabla70_direccion,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
        break;
    case "borrar_personal":		
		$id_res=borrar_personal($id_tabla70,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_personal":
		$id_res=modificar_personal($id_tabla70,$tabla70_razon_social,$tabla70_cuit,$tabla70_nombre_apellido,$tabla70_dni,$tabla70_foto,$tabla70_email,$tabla70_telefono,$tabla70_direccion,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;	


}
$datos="";
$datos.="id_tabla70<@n:> $id_tabla70<@n>";
$datos.="tabla70_razon_social<@n:> $tabla70_razon_social<@n>";
$datos.="tabla70_cuit<@n:> $tabla70_cuit<@n>";
$datos.="tabla70_dni<@n:> $tabla70_dni<@n>";
$datos.="tabla70_foto<@n:> $tabla70_foto<@n>";
$datos.="tabla70_email<@n:> $tabla70_email<@n>";
$datos.="tabla70_telefono<@n:> $tabla70_telefono<@n>";
$datos.="tabla70_direccion<@n:> $tabla70_direccion<@n>";
//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>