<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_usuarios.php";
include_once "../../control/php/abm_control.php";

$id_tabla01=$_POST["id_tabla01"];
$tabla01_nombre=$_POST["tabla01_nombre"];
$tabla01_usuario=$_POST["tabla01_usuario"];
$tabla01_contrasena=$_POST["tabla01_contrasena"];
$tabla01_mail=$_POST["tabla01_mail"];
$tabla01_activo=$_POST["tabla01_activo"];


$tabla01_usuario=utf8_decode($tabla01_usuario);
$tabla01_contrasena=utf8_decode($tabla01_contrasena);

$nombre_funcion=$_POST["nombre_funcion"];

switch ($nombre_funcion) {
    case "agregar_usuario":
		$id_res=agregar_usuario($tabla01_nombre,$tabla01_usuario,$tabla01_contrasena,$tabla01_mail,$tabla01_activo,$rela_tabla16,$tabla01_espreventista,$link_mysql);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
        break;
    case "borrar_usuario":		
		$id_res=borrar_usuario($id_tabla01,$link_mysql);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
		break;
	case "modificar_usuario":
		$id_res=modificar_usuario($id_tabla01,$tabla01_nombre,$tabla01_usuario,$tabla01_contrasena,
		$tabla01_mail,$tabla01_activo,$rela_tabla16,$tabla01_espreventista,$link_mysql);
		$vexplode=explode("-",$id_res);
		echo $vexplode[1];
		break;	


}
$datos="";
$datos.="id_tabla01<@n:> $id_tabla01<@n>";
$datos.="tabla01_nombre<@n:> $tabla01_nombre<@n>";
$datos.="tabla01_usuario<@n:> $tabla01_usuario<@n>";
$datos.="tabla01_contrasena<@n:> $tabla01_contrasena<@n>";
$datos.="tabla01_mail<@n:> $tabla01_mail<@n>";
$datos.="tabla01_activo<@n:> $tabla01_activo<@n>";

agregar_control("ABM",$nombre_funcion,$vexplode[1],$datos,$link_mysql);

?>