<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_mantenimiento.php";
include_once "../../control/php/abm_control.php";
require_once "../../../php/funciones_comunes.php";


//Campo Obligatorio
$modulo_actual="mantenimiento"; // Poner Nombre del Modulo Actual
//Para el Control


$id_tabla23=isset($_POST['id_tabla23']) ? intval($_POST['id_tabla23']) : NULL;
$rela_tabla22=isset($_POST['rela_tabla22']) ? intval($_POST['rela_tabla22']) : NULL;
$tabla23_descripcion=isset($_POST['tabla23_descripcion']) ? strval($_POST['tabla23_descripcion']) : NULL;

$tabla23_fecha_mantenimiento=isset($_POST['tabla23_fecha_mantenimiento']) ? strval($_POST['tabla23_fecha_mantenimiento']) : NULL; 

$tabla23_estado=isset($_POST['tabla23_estado']) ? intval($_POST['tabla23_estado']) : '';
$tabla23_fecha_trabajo=isset($_POST['tabla23_fecha_trabajo']) ? strval($_POST['tabla23_fecha_trabajo']) : '';

$tabla23_observacion=isset($_POST['tabla23_observacion']) ? strval($_POST['tabla23_observacion']) : '';
$tabla23_descripcion=utf8_decode($tabla23_descripcion);
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';
$tabla23_fecha_mantenimiento= formatear_fecha($tabla23_fecha_mantenimiento);
$tabla23_fecha_trabajo= formatear_fecha($tabla23_fecha_trabajo);


switch ($nombre_funcion) {
    case "agregar_mantenimiento":
    	$id_res=agregar_mantenimiento($rela_tabla22,$tabla23_descripcion,$tabla23_fecha_mantenimiento,$tabla23_estado,$tabla23_fecha_trabajo,$tabla23_observacion,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
        break;
    case "borrar_mantenimiento":		
		$id_res=borrar_mantenimiento($id_tabla23,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_mantenimiento":

		$id_res=modificar_mantenimiento($id_tabla23,$rela_tabla22,$tabla23_descripcion,$tabla23_fecha_mantenimiento,$tabla23_estado,$tabla23_fecha_trabajo,
$tabla23_observacion,$pdo);
	
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;	


}
$datos="";
$datos.="id_tabla23<@n:> $id_tabla23<@n>";
$datos.="rela_tabla22<@n:> $rela_tabla22<@n>";
$datos.="tabla23_descripcion<@n:> $tabla23_descripcion<@n>";
$datos.="tabla23_fecha_mantenimiento<@n:> $tabla23_fecha_mantenimiento<@n>";
$datos.="tabla23_estado<@n:> $tabla23_estado<@n>";
$datos.="tabla23_fecha_trabajo<@n:> $tabla23_fecha_trabajo<@n>";
$datos.="tabla23_observacion<@n:> $tabla23_observacion<@n>";
//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>