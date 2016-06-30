<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_cultivo.php";
include_once "../../control/php/abm_control.php";
require_once "../../../php/funciones_comunes.php";

//Campo Obligatorio
$modulo_actual="cultivo"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla16=isset($_POST['id_tabla16']) ? intval($_POST['id_tabla16']) : NULL;
$rela_tabla15=isset($_POST['rela_tabla15']) ? intval($_POST['rela_tabla15']) : NULL;
$rela_tabla65=isset($_POST['rela_tabla65']) ? intval($_POST['rela_tabla65']) : NULL; 
$tabla16_fecha_cosecha=isset($_POST['tabla16_fecha_cosecha']) ? strval($_POST['tabla16_fecha_cosecha']) : '';
$tabla16_fecha_siembra=isset($_POST['tabla16_fecha_siembra']) ? strval($_POST['tabla16_fecha_siembra']) : '';
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';
$tabla16_fecha_cosecha= formatear_fecha($tabla16_fecha_cosecha);
$tabla16_fecha_siembra=formatear_fecha($tabla16_fecha_siembra);

switch ($nombre_funcion) {
    case "agregar_cultivo":
		$id_res=agregar_cultivo($tabla16_fecha_cosecha,$rela_tabla15,$rela_tabla65,$tabla16_fecha_siembra,$pdo);
		$vexplode=explode("-",$id_res);
		phpAlert($vexplode[1]);
        break;
    case "borrar_cultivo":		
		$id_res=borrar_cultivo($id_tabla16,$pdo);
		$vexplode=explode("-",$id_res);
		phpAlert($vexplode[1]);
		break;
	case "modificar_cultivo":
		$id_res=modificar_cultivo($id_tabla16,$tabla16_fecha_cosecha,$rela_tabla15,$rela_tabla65,$tabla16_fecha_siembra,$pdo);
		$vexplode=explode("-",$id_res);
		phpAlert($vexplode[1]);
		break;	


}
$datos="";
$datos.="id_tabla16<@n:> $id_tabla16<@n>";
$datos.="rela_tabla15<@n:> $rela_tabla15<@n>";
$datos.="rela_tabla65<@n:> $rela_tabla65<@n>";
$datos.="tabla16_fecha_cosecha<@n:> $tabla16_fecha_cosecha<@n>";
$datos.="tabla16_fecha_siembra<@n:> $tabla16_fecha_siembra<@n>";
//agregar_log("ABM",$nombre_funcion,$vexplode[1],$datos,$modulo_actual,$link_mysql);

?>