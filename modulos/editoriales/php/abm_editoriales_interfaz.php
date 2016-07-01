<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_editoriales.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="Temas"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla11=$_POST["id_tabla11"];
$tabla11_nombre=$_POST["tabla11_nombre"];
$tabla11_descripcion=$_POST["tabla11_descripcion"];

$tabla11_nombre=utf8_decode($tabla11_nombre);

$nombre_funcion=$_POST["nombre_funcion"];

switch ($nombre_funcion) {
    case "agregar_editoriales":
		$id_res= agregar_editoriales($tabla11_nombre,$tabla11_descripcion,$link_mysql);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
        break;
    case "borrar_temas":		
		$id_res=borrar_temas($id_tabla11,$link_mysql);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
		break;
	case "modificar_temas":
		$id_res=modificar_temas($id_tabla11,$tabla11_nombre,$tabla11_descripcion,$link_mysql);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
		break;	


}
$datos="";
$datos.="id_tabla11<@n:> $id_tabla11<@n>";
$datos.="tabla11_nombre<@n:> $tabla11_nombre<@n>";
$datos.="tabla11_nombre<@n:> $tabla11_nombre<@n>";

//agregar_log("ABM",$nombre_funcion,$vexplode[1],$datos,$modulo_actual,$link_mysql);

?>