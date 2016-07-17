<?php
/*
Librería: Funciones ABM y de recuperación de datos de parcelas.
*/
require_once "../../../php/check.php";
require_once "../../../php/funciones_comunes.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_parcela.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="parcela"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla65=isset($_POST['id_tabla65']) ? intval($_POST['id_tabla65']) : NULL;
$rela_tabla09=isset($_POST['rela_tabla09']) ? intval($_POST['rela_tabla09']) : NULL;
$rela_tabla64=isset($_POST['rela_tabla64']) ? intval($_POST['rela_tabla64']) : NULL;
$rela_tabla66=isset($_POST['rela_tabla66']) ? intval($_POST['rela_tabla66']) : NULL;
$tabla65_numero=isset($_POST['tabla65_numero']) ? strval($_POST['tabla65_numero']) : '';
$tabla65_limites=isset($_POST['tabla65_limites']) ? strval($_POST['tabla65_limites']) : '';
$tabla65_tieneregadio=isset($_POST['tabla65_tieneregadio']) ? strval($_POST['tabla65_tieneregadio']) : '';
$tabla65_areatotal=isset($_POST['tabla65_areatotal']) ? strval($_POST['tabla65_areatotal']) : '';
$tabla65_numero=utf8_decode($tabla65_numero);

$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';

switch ($nombre_funcion) {
	case "agregar_parcela":
		$id_res=agregar_parcela($tabla65_numero,$rela_tabla09,$rela_tabla64,$tabla65_limites,$tabla65_areatotal,$rela_tabla66,$tabla65_tieneregadio,$pdo);
		$vexplode=explode("-",$id_res);
		$mensaje=$vexplode[1];
		echo $mensaje ;
		break;
	case "borrar_parcela":
		$id_res=borrar_parcela($id_tabla65,$pdo);
		$vexplode=explode("-",$id_res);
		$mensaje=$vexplode[1];
		echo $mensaje ;
		break;
	case "modificar_parcela":
		$id_res=modificar_parcela($id_tabla65,$tabla65_numero,$rela_tabla09,$rela_tabla64,$tabla65_limites,$tabla65_areatotal,$rela_tabla66,$tabla65_tieneregadio,$pdo);
		$vexplode=explode("-",$id_res);
		$mensaje=$vexplode[1];
		echo $mensaje ;
		//phpConsoleLog($mensaje);
		break;
	default:
		phpConsoleLog("No encuentra ".$nombre_funcion);
}
$datos="";
$datos.="id_tabla65<@n:> $id_tabla65<@n>";
$datos.="tabla65_numero<@n:> $tabla65_numero<@n>";
$datos.="rela_tabla09<@n:> $rela_tabla09<@n>";
$datos.="rela_tabla64<@n:> $rela_tabla64<@n>";
$datos.="rela_tabla66<@n:> $rela_tabla66<@n>";
$datos.="tabla65_limites<@n:> $tabla65_limites<@n>";
$datos.="tabla65_tieneregadio<@n:> $tabla65_tieneregadio<@n>";
$datos.="tabla65_areatotal<@n:> $tabla65_areatotal<@n>";
//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>
