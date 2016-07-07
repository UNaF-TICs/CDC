<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
/*
require_once "../../../php/funcion_error.php";*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_eventoclimatologico.php";
include_once "../../control/php/abm_control.php";
include_once "../../../php/funciones_comunes.php";

//Campo Obligatorio
$modulo_actual="evento_climatologico"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla99=isset($_POST['id_tabla99']) ? intval($_POST['id_tabla99']) : NULL;
$tabla99_observacion=isset($_POST['tabla99_observacion']) ? strval($_POST['tabla99_observacion']): '';
$tabla99_fecha_inicio=isset($_POST['tabla99_fecha_inicio']) ? strval($_POST['tabla99_fecha_inicio']) : '';
$tabla99_fecha_fin=isset($_POST['tabla99_fecha_fin']) ? strval($_POST['tabla99_fecha_fin']) : '';
$rela_tabla16=isset($_POST['rela_tabla16']) ? intval($_POST['rela_tabla16']) : NULL;
$rela_tabla01=isset($_POST['rela_tabla01']) ? intval($_POST['rela_tabla01']) : NULL;
$rela_tabla74=isset($_POST['rela_tabla74']) ? intval($_POST['rela_tabla74']) : NULL;
$rela_tabla71=isset($_POST['rela_tabla71']) ? intval($_POST['rela_tabla71']) : NULL; 
$tabla99_cantidad=isset($_POST['tabla99_cantidad']) ? strval($_POST['tabla99_cantidad']) : '';
$rela_tabla98=isset($_POST['rela_tabla98']) ? intval($_POST['rela_tabla98']) : NULL; 
$tabla99_observacion=utf8_decode($tabla99_observacion);
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';

switch ($nombre_funcion) {
    case "agregar_eventoclimatico":
		$id_res=agregar_eventoclimatico($tabla99_observacion,$tabla99_fecha_inicio,$tabla99_fecha_fin,$rela_tabla16,$rela_tabla01,$rela_tabla74,$rela_tabla71,$tabla99_cantidad,$rela_tabla98,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
        break;
    case "borrar_eventoclimatico":		
		$id_res=borrar_eventoclimatico($id_tabla99,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_eventoclimatico":
		$id_res=modificar_eventoclimatico($id_tabla99,$tabla99_observacion,$tabla99_fecha_inicio,    $tabla99_fecha_fin,$rela_tabla16,$rela_tabla01,$rela_tabla74,$rela_tabla71,$tabla99_cantidad, $rela_tabla98,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;	


}
$datos="";
$datos.="id_tabla99<@n:> $id_tabla99<@n>";
$datos.="tabla99_observacion<@n:> $tabla99_observacion<@n>";
$datos.="tabla99_fecha_inicio<@n:> $tabla99_fecha_inicio<@n>";
$datos.="tabla99_fecha_fin<@n:> $tabla99_fecha_fin<@n>";
$datos.="rela_tabla16<@n:> $rela_tabla16<@n>";
$datos.="rela_tabla01<@n:> $rela_tabla01<@n>";
$datos.="rela_tabla74<@n:> $rela_tabla74<@n>";
$datos.="rela_tabla71<@n:> $rela_tabla71<@n>";
$datos.="tabla99_cantidad<@n:> $tabla99_cantidad<@n>";
$datos.="rela_tabla98<@n:> $rela_tabla98<@n>";
//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>