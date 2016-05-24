<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include "../../../lib/link_mysql.php";
include_once "abm_perfiles_modulos.php";
include_once "../../control/php/abm_control.php";
$estado = array('false' => '0','true' => '1','' => '0'); 

$id_tabla04=$_POST["id_tabla04"];
$rela_tabla02=$_POST["rela_tabla02"];
$rela_tabla03=$_POST["rela_tabla03"];
$tabla04_alta=$estado[$_POST["tabla04_alta"]];
$tabla04_baja=$estado[$_POST["tabla04_baja"]];
$tabla04_modificacion=$estado[$_POST["tabla04_modificacion"]];
$tabla04_reporte=$estado[$_POST["tabla04_reporte"]];

$nombre_funcion=$_POST["nombre_funcion"];

switch ($nombre_funcion) {
    case "agregar_perfil_modulo":

		$id_res=agregar_perfil_modulo($rela_tabla02,$rela_tabla03,$tabla04_alta,
				$tabla04_baja,$tabla04_modificacion,$tabla04_reporte,$link_mysql);
		$vsplit=split("<@>",$id_res);
		echo $vsplit[1];
        break;
    case "modificar_perfil_modulo":
		$id_res=modificar_perfil_modulo($id_tabla04,$rela_tabla02,$rela_tabla03,$tabla04_alta,
			$tabla04_baja,$tabla04_modificacion,$tabla04_reporte,$link_mysql);
		$vsplit=split("<@>",$id_res);
		echo $vsplit[1];
		break;
    case "borrar_perfil_modulo":		
		$id_res=borrar_perfil_modulo($id_tabla04,$link_mysql);
		$vsplit=split("<@>",$id_res);
		echo $vsplit[1];
		break;
	default:
		echo "Error en nombre de función " . $nombre_funcion;

}

$datos="";
$datos.="id_tabla04<@n:> $id_tabla04<@n>";
$datos.="rela_tabla02<@n:> $rela_tabla02<@n>";
$datos.="rela_tabla03<@n:> $rela_tabla03<@n>";
$datos.="tabla04_alta<@n:> $tabla04_alta<@n>";
$datos.="tabla04_baja<@n:> $tabla04_baja<@n>";
$datos.="tabla04_modificacion<@n:> $tabla04_modificacion<@n>";
$datos.="tabla04_reporte<@n:> $tabla04_reporte<@n>";

agregar_control("ABM",$nombre_funcion,$vsplit[1],$datos,$link_mysql);
?>



