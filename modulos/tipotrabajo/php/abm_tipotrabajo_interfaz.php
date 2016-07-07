<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_tipotrabajo.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="tipotrabajo"; // Poner Nombre del Modulo Actual
//Para el Control

$id_Tabla14=isset($_POST['id_Tabla14']) ? intval($_POST['id_Tabla14']) : NULL;
$tabla14_Descripcion=isset($_POST['tabla14_Descripcion']) ? strval($_POST['tabla14_Descripcion']) : '';
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';


switch ($nombre_funcion) {
    case "agregar_tipotrabajo":
		$id_res=agregar_tipotrabajo($tabla14_Descripcion,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
        break;
    case "borrar_tipotrabajo":		
		$id_res=borrar_tipotrabajo($id_Tabla14,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_tipotrabajo":
		$id_res=modificar_tipotrabajo($id_Tabla14,$tabla14_Descripcion,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;	


}
$datos="";
$datos.="id_Tabla14<@n:> $id_Tabla14<@n>";
$datos.="tabla14_Descripcion<@n:> $tabla14_Descripcion<@n>";
//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>