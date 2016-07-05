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

$id_tabla12=isset($_POST['id_tabla12']) ? intval($_POST['id_tabla12']) : NULL;
$tabla12_nombre_empresa=isset($_POST['tabla12_nombre_empresa']) ? strval($_POST['tabla12_nombre_empresa']) : '';
$rela_tabla09=isset($_POST['rela_tabla09']) ? intval($_POST['rela_tabla09']) : NULL;
$tabla12_dni_nif=isset($_POST['tabla12_dni_nif']) ? strval($_POST['tabla12_dni_nif']) : '';
$tabla12_num_carne=isset($_POST['tabla12_num_carne']) ? strval($_POST['tabla12_num_carne']) : '';
$tabla12_email=isset($_POST['tabla12_email']) ? strval($_POST['tabla12_email']) : '';
$tabla12_telefono=isset($_POST['tabla12_telefono']) ? strval($_POST['tabla12_telefono']) : '';
$tabla12_direccion=isset($_POST['tabla12_direccion']) ? strval($_POST['tabla12_direccion']) : '';
$tabla12_comentario=isset($_POST['tabla12_comentario']) ? strval($_POST['tabla12_comentario']) : '';
$tabla12_nombre_empresa=utf8_decode($tabla12_nombre_empresa);
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';

switch ($nombre_funcion) {
    case "agregar_personal":
		$id_res=agregar_personal($tabla12_nombre_empresa,$rela_tabla09,$tabla12_dni_nif,$tabla12_num_carne,
$tabla12_email,$tabla12_telefono,$tabla12_direccion,$tabla12_comentario,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
        break;
    case "borrar_personal":		
		$id_res=borrar_personal($id_tabla12,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_personal":
		$id_res=modificar_personal($id_tabla12,$rela_tabla09,$tabla12_nombre_empresa,$tabla12_dni_nif,$tabla12_num_carne,$tabla12_email,$tabla12_telefono,$tabla12_direccion,$tabla12_comentario,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;	


}
$datos="";
$datos.="id_tabla12<@n:> $id_tabla12<@n>";
$datos.="rela_tabla09<@n:> $rela_tabla09<@n>";
$datos.="rela_tabla09<@n:> $rela_tabla09<@n>";
$datos.="tabla12_dni_nif<@n:> $tabla12_dni_nif<@n>";
$datos.="tabla12_num_carne<@n:> $tabla12_num_carne<@n>";
$datos.="tabla12_email<@n:> $tabla12_email<@n>";
$datos.="tabla12_telefono<@n:> $tabla12_telefono<@n>";
$datos.="tabla12_direccion<@n:> $tabla12_direccion<@n>";
$datos.="tabla12_comentario<@n:> $tabla12_comentario<@n>";
//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>