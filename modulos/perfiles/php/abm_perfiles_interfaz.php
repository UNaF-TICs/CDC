<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_perfiles.php";
include_once "../../control/php/abm_control.php";
							
$id_tabla03=$_POST["id_tabla03"];
$tabla03_nombre=$_POST["tabla03_nombre"];

$tabla03_nombre=utf8_decode($tabla03_nombre);
//falto esto  $nombre_funcion=$_POST["nombre_funcion"];
$nombre_funcion=$_POST["nombre_funcion"];

switch ($nombre_funcion) {
    case "agregar_perfil":

		$id_res=agregar_perfil($tabla03_nombre,$link_mysql);
		$vsplit=split("-",$id_res);
		$mensaje=$vsplit[1];
		echo $mensaje ;
		break;
    case "modificar_perfil":
		$id_res=modificar_perfil($id_tabla03,$tabla03_nombre,$link_mysql);
		$vsplit=split("-",$id_res);
		$mensaje=$vsplit[1];
		echo $mensaje ;
		break;
    case "borrar_perfil":		
		$id_res=borrar_perfil($id_tabla03,$link_mysql);
		$vsplit=split("-",$id_res);
		$mensaje=$vsplit[1];
		echo $mensaje ;
		break;
	default:
		echo "Error en nombre de función " . $nombre_funcion;

}
$datos="";
$datos.="id_tabla03<@n:> $id_tabla03<@n>";
$datos.="tabla03_nombre<@n:> $tabla03_nombre<@n>";

agregar_control("ABM",$nombre_funcion,$vsplit[1],$datos,$link_mysql);
?>



