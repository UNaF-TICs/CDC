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

$id_tabla71=isset($_POST['id_tabla71']) ? intval($_POST['id_tabla71']) : NULL;
$rela_tabla72=isset($_POST['rela_tabla72']) ? intval($_POST['rela_tabla72']) : NULL;
$rela_tabla70=isset($_POST['rela_tabla70']) ? intval($_POST['rela_tabla70']) : NULL;
$rela_tabla63=isset($_POST['rela_tabla63']) ? intval($_POST['rela_tabla63']) : NULL;

$id_tabla71=utf8_decode($id_tabla71);
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';

switch ($nombre_funcion) {
    case "agregar_personal":
		$id_res=agregar_personal($rela_tabla72,$rela_tabla70,$rela_tabla63,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
        break;
    case "borrar_personal":		
		$id_res=borrar_personal($id_tabla71,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_personal":
		$id_res=modificar_personal($id_tabla71,$rela_tabla72,$rela_tabla70,$rela_tabla63,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;	


}
$datos="";
$datos.="id_tabla71<@n:> $id_tabla71<@n>";
$datos.="rela_tabla72<@n:> $rela_tabla72<@n>";
$datos.="rela_tabla70<@n:> $rela_tabla70<@n>";
$datos.="rela_tabla63<@n:> $rela_tabla63<@n>";

//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>