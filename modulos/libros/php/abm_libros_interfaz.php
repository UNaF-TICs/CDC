<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_libros.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="libros"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla10=isset($_POST['id_tabla10']) ? intval($_POST['id_tabla10']) : NULL;
$rela_tabla09=isset($_POST['rela_tabla09']) ? intval($_POST['rela_tabla09']) : NULL;
$rela_tabla11=isset($_POST['rela_tabla11']) ? intval($_POST['rela_tabla11']) : NULL; 
$tabla10_titulo=isset($_POST['tabla10_titulo']) ? strval($_POST['tabla10_titulo']) : '';
$tabla10_subtitulo=isset($_POST['tabla10_subtitulo']) ? strval($_POST['tabla10_subtitulo']) : '';
$tabla10_descripcion=isset($_POST['tabla10_descripcion']) ? strval($_POST['tabla10_descripcion']) : '';
$tabla10_fecha_entrada=isset($_POST['tabla10_fecha_entrada']) ? strval($_POST['tabla10_fecha_entrada']) : '';
$tabla10_tomo=isset($_POST['tabla10_tomo']) ? strval($_POST['tabla10_tomo']) : '';
$tabla10_cantidad=isset($_POST['tabla10_cantidad']) ? strval($_POST['tabla10_cantidad']) : '';
$tabla10_titulo=utf8_decode($tabla10_titulo);
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';

switch ($nombre_funcion) {
    case "agregar_libros":
		$id_res=agregar_libros($tabla10_titulo,$rela_tabla09,$rela_tabla11,$tabla10_subtitulo,$tabla10_descripcion,
$tabla10_fecha_entrada,$tabla10_tomo,$tabla10_cantidad,$pdo);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
        break;
    case "borrar_libros":		
		$id_res=borrar_libros($id_tabla10,$pdo);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
		break;
	case "modificar_libros":
		$id_res=modificar_libros($id_tabla10,$tabla10_titulo,$rela_tabla09,$rela_tabla11,$tabla10_subtitulo,$tabla10_descripcion,
$tabla10_fecha_entrada,$tabla10_tomo,$tabla10_cantidad,$pdo);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
		break;	


}
$datos="";
$datos.="id_tabla10<@n:> $id_tabla10<@n>";
$datos.="rela_tabla09<@n:> $rela_tabla09<@n>";
$datos.="rela_tabla09<@n:> $rela_tabla09<@n>";
$datos.="rela_tabla11<@n:> $rela_tabla11<@n>";
$datos.="tabla10_subtitulo<@n:> $tabla10_subtitulo<@n>";
$datos.="tabla10_descripcion<@n:> $tabla10_descripcion<@n>";
$datos.="tabla10_fecha_entrada<@n:> $tabla10_fecha_entrada<@n>";
$datos.="tabla10_tomo<@n:> $tabla10_tomo<@n>";
$datos.="tabla10_cantidad<@n:> $tabla10_cantidad<@n>";
//agregar_log("ABM",$nombre_funcion,$vexplode[1],$datos,$modulo_actual,$link_mysql);

?>