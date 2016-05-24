<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_prestamos_no.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="prestamos"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla12=$_POST["id_tabla12"];
$tabla10_titulo=$_POST["tabla10_titulo"];
$rela_tabla10=$_POST["rela_tabla10"];
$rela_tabla07=$_POST["rela_tabla07"];
$tabla12_fecha_prestamo=$_POST["tabla12_fecha_prestamo"];
$tabla12_fecha_a_devolver=$_POST["tabla12_fecha_a_devolver"];
$tabla12_fecha_devolucion=$_POST["tabla12_fecha_devolucion"];


$tabla10_titulo=utf8_decode($tabla10_titulo);

$nombre_funcion=$_POST["nombre_funcion"];

switch ($nombre_funcion) {
    case "agregar_prestamos":
		$id_res=agregar_prestamos($rela_tabla10,$rela_tabla07,$tabla12_fecha_prestamo,$tabla12_fecha_a_devolver,
$tabla12_fecha_devolucion,$link_mysql);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
        break;
    case "borrar_prestamos":		
		$id_res=borrar_prestamos($id_tabla12,$link_mysql);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_prestamos":
		$id_res=modificar_prestamos($id_tabla12,$rela_tabla10,$rela_tabla07,$tabla12_fecha_prestamo,$tabla12_fecha_a_devolver,
$tabla12_fecha_devolucion,$link_mysql);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;	


}
$datos="";
$datos.="id_tabla12<@n:> $id_tabla12<@n>";
$datos.="rela_tabla10<@n:> $rela_tabla10<@n>";
$datos.="rela_tabla07<@n:> $rela_tabla07<@n>";
$datos.="tabla12_fecha_prestamo<@n:> $tabla12_fecha_prestamo<@n>";
$datos.="tabla12_fecha_a_devolver<@n:> $tabla12_fecha_a_devolver<@n>";
$datos.="tabla12_fecha_devolucion<@n:> $tabla12_fecha_devolucion<@n>";

//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>