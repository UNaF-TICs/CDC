<?php
/*
Maquinaria: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_maquinaria.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="maquinaria"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla22=isset($_POST['id_tabla22']) ? intval($_POST['id_tabla22']) : NULL;
$tabla22_imagen=isset($_POST['tabla22_imagen']) ? intval($_POST['tabla22_imagen']) : NULL;
$tabla22_nombre=isset($_POST['tabla22_nombre']) ? intval($_POST['tabla22_nombre']) : NULL; 
$tabla22_descripcion=isset($_POST['tabla22_descripcion']) ? strval($_POST['tabla22_descripcion']) : '';
$tabla22_marca=isset($_POST['tabla22_marca']) ? strval($_POST['tabla22_marca']) : '';
$tabla22_modelo=isset($_POST['tabla22_modelo']) ? strval($_POST['tabla22_modelo']) : '';
$tabla22_fecha_compra=isset($_POST['tabla22_fecha_compra']) ? strval($_POST['tabla22_fecha_compra']) : '';
$tabla22_costo_compra=isset($_POST['tabla22_costo_compra']) ? strval($_POST['tabla22_costo_compra']) : '';
$tabla22_matricula=isset($_POST['tabla22_matricula']) ? strval($_POST['tabla22_matricula']) : '';
$tabla22_empresa_seguro=isset($_POST['tabla22_empresa_seguro']) ? strval($_POST['tabla22_empresa_seguro']) : '';
$tabla22_rto=isset($_POST['tabla22_rto']) ? strval($_POST['tabla22_rto']) : '';
$tabla22_funcion=isset($_POST['tabla22_funcion']) ? strval($_POST['tabla22_funcion']) : '';
$tabla22_descripcion=utf8_decode($tabla22_descripcion);
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';

switch ($nombre_funcion) {
    case "agregar_maquinaria":
		$id_res=agregar_maquinaria($tabla22_descripcion,$tabla22_imagen,$tabla22_nombre,$tabla22_marca,$tabla22_modelo,
$tabla22_fecha_compra,$tabla22_costo_compra,$tabla22_matricula,$tabla22_empresa_seguro,$tabla22_rto,$tabla22_funcion,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
        break;
    case "borrar_maquinaria":		
		$id_res=borrar_maquinaria($id_tabla22,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_maquinaria":
		$id_res=modificar_maquinaria($id_tabla22,$tabla22_descripcion,$tabla22_imagen,$tabla22_nombre,$tabla22_marca,$tabla22_modelo,
$tabla22_fecha_compra,$tabla22_costo_compra,$tabla22_matricula,$tabla22_empresa_seguro,$tabla22_rto,$tabla22_funcion,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;	


}
$datos="";
$datos.="id_tabla22<@n:> $id_tabla22<@n>";
$datos.="tabla22_imagen<@n:> $tabla22_imagen<@n>";
$datos.="tabla22_nombre<@n:> $tabla22_nombre<@n>";
$datos.="tabla22_descripcion<@n:> $tabla22_descripcion<@n>";
$datos.="tabla22_marca<@n:> $tabla22_marca<@n>";
$datos.="tabla22_modelo<@n:> $tabla22_modelo<@n>";
$datos.="tabla22_fecha_compra<@n:> $tabla22_fecha_compra<@n>";
$datos.="tabla22_costo_compra<@n:> $tabla22_costo_compra<@n>";
$datos.="tabla22_matricula<@n:> $tabla22_matricula<@n>";
$datos.="tabla22_empresa_seguro<@n:> $tabla22_empresa_seguro<@n>";
$datos.="tabla22_rto<@n:> $tabla22_rto<@n>";
$datos.="tabla22_funcion<@n:> $tabla22_funcion<@n>";
//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>