
<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_variedad.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="variedad"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla15=isset($_POST['id_tabla15']) ? intval($_POST['id_tabla15']) : NULL;
$tabla15_descripcion=isset($_POST['tabla15_descripcion']) ? strval($_POST['tabla15_descripcion']) : '';
$tabla15_nombre=isset($_POST['tabla15_nombre']) ? strval($_POST['tabla15_nombre']) : '';
$tabla15_temperatura_maxima=isset($_POST['tabla15_temperatura_maxima']) ? strval($_POST['tabla15_temperatura_maxima']) : '';
$tabla15_temperatura_minima=isset($_POST['tabla15_temperatura_minima']) ? strval($_POST['tabla15_temperatura_minima']) : '';
$tabla15_temperatura_optima=isset($_POST['tabla15_temperatura_optima']) ? strval($_POST['tabla15_temperatura_optima']) : '';
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';

switch ($nombre_funcion) {
    case "agregar_variedad":
		$id_res=agregar_variedad($tabla15_descripcion,$tabla15_nombre,$tabla15_temperatura_maxima,$tabla15_temperatura_minima,$tabla15_temperatura_optima,$pdo);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
        break;
    case "borrar_variedad":		
		$id_res=borrar_variedad($id_tabla15,$pdo);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
		break;
	case "modificar_variedad":
		$id_res=modificar_variedad($id_tabla15,$tabla15_descripcion,$tabla15_nombre,$tabla15_temperatura_maxima,$tabla15_temperatura_minima,$tabla15_temperatura_optima,$pdo);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
		break;	


}
$datos="";
$datos.="id_tabla15<@n:> $id_tabla15<@n>";
$datos.="tabla15_descripcion<@n:> $tabla15_descripcion<@n>";
$datos.="tabla15_nombre<@n:> $tabla15_nombre<@n>";
$datos.="tabla15_temperatura_maxima<@n:> $tabla15_temperatura_maxima<@n>";
$datos.="tabla15_temperatura_minima<@n:> $tabla15_temperatura_minima<@n>";
$datos.="tabla15_temperatura_optima<@n:> $tabla15_temperatura_optima<@n>";
//agregar_log("ABM",$nombre_funcion,$vexplode[1],$datos,$modulo_actual,$link_mysql);

?>