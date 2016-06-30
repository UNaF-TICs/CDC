<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_temas.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="Temas"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla09=$_POST["id_tabla09"];
$tabla09_nombre=$_POST["tabla09_nombre"];
$tabla09_descripcion=$_POST["tabla09_descripcion"];
$tabla09_subtema=$_POST["tabla09_subtema"];

$tabla09_nombre=utf8_decode($tabla09_nombre);

$nombre_funcion=$_POST["nombre_funcion"];

switch ($nombre_funcion) {
    case "agregar_temas":
		$id_res= agregar_temas($tabla09_nombre,$tabla09_descripcion,$tabla09_subtema,$link_mysql);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
        break;
    case "borrar_temas":		
		$id_res=borrar_temas($id_tabla09,$link_mysql);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
		break;
	case "modificar_temas":
		$id_res=modificar_temas($id_tabla09,$tabla09_nombre,$tabla09_descripcion,$tabla09_subtema,$link_mysql);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
		break;	


}
$datos="";
$datos.="id_tabla09<@n:> $id_tabla09<@n>";
$datos.="tabla09_nombre<@n:> $tabla09_nombre<@n>";
$datos.="tabla09_nombre<@n:> $tabla09_nombre<@n>";
$datos.="tabla09_subtema<@n:> $tabla09_subtema<@n>";

//agregar_log("ABM",$nombre_funcion,$vexplode[1],$datos,$modulo_actual,$link_mysql);

?>