<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_usuarios_perfiles.php";

include_once "../../control/php/abm_control.php";
$id_tabla06=$_POST["id_tabla06"];
$rela_tabla03=$_POST["rela_tabla03"];
$rela_tabla01=$_POST["rela_tabla01"];

//falto esto  $nombre_funcion=$_POST["nombre_funcion"];
$nombre_funcion=$_POST["nombre_funcion"];

switch ($nombre_funcion) {
    case "agregar_usuario_perfil":
		$id_res=agregar_usuario_perfil($rela_tabla03,$rela_tabla01,$link_mysql);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
        break;
    case "modificar_usuario_perfil":
		$id_res=modificar_usuario_perfil($id_tabla06,$rela_tabla03,$rela_tabla01,$link_mysql);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
		break;
    case "borrar_usuario_perfil":		
		$id_res=borrar_usuario_perfil($id_tabla06,$link_mysql);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
		break;
	default:
		echo "Error en nombre de función " . $nombre_funcion;

}
$datos="";
$datos.="id_tabla06<@n:> $id_tabla06<@n>";
$datos.="rela_tabla03<@n:> $rela_tabla03<@n>";
$datos.="rela_tabla01<@n:> $rela_tabla01<@n>";

agregar_control("ABM",$nombre_funcion,$vexplode[1],$datos,$link_mysql);
?>




