<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_Trabajo.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="Trabajo"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla13=isset($_POST['id_tabla13']) ? intval($_POST['id_tabla13']) : NULL;
$Rela_Tabla14=isset($_POST['Rela_Tabla14']) ? intval($_POST['Rela_Tabla14']) : NULL; 
$Tabla13_Descripcion=isset($_POST['Tabla13_Descripcion']) ? strval($_POST['Tabla13_Descripcion']) : '';
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';


switch ($nombre_funcion) {
    case "agregar_trabajo":

		$id_res=agregar_trabajo($Rela_Tabla14,$Tabla13_Descripcion,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
        break;
    case "borrar_trabajo":		
		$id_res=borrar_trabajo($id_tabla13,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_trabajo":
		$id_res=modificar_trabajo($id_tabla13,$Rela_Tabla14,$Tabla13_Descripcion,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;	


}
$datos="";
$datos.="id_tabla13<@n:> $id_tabla13<@n>";
$datos.="Rela_Tabla14<@n:> $Rela_Tabla14<@n>";
$datos.="Tabla13_Descripcion<@n:> $Tabla13_Descripcion<@n>";

//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>