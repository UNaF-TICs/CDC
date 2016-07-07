<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_fitosanitarios.php";
include_once "../../control/php/abm_control.php";

//Campo Obligatorio
$modulo_actual="fitosanitarios"; // Poner Nombre del Modulo Actual
//Para el Control

$id_tabla18=isset($_POST['id_tabla18']) ? intval($_POST['id_tabla18']) : NULL;
$Rela_tabla21=isset($_POST['Rela_tabla21']) ? intval($_POST['Rela_tabla21']) : NULL;
$Rela_tabla33=isset($_POST['Rela_tabla33']) ? intval($_POST['Rela_tabla33']) : NULL; 
$Fitosanitario_Nombre=isset($_POST['Fitosanitario_Nombre']) ? strval($_POST['Fitosanitario_Nombre']) : '';
$Fitosanitario_Fabricante=isset($_POST['Fitosanitario_Fabricante']) ? strval($_POST['Fitosanitario_Fabricante']) : '';
$Cantidad_Agua=isset($_POST['Cantidad_Agua']) ? strval($_POST['Cantidad_Agua']) : '';
$Fitosanitario_Fecha_caducidad=isset($_POST['Fitosanitario_Fecha_caducidad']) ? strval($_POST['Fitosanitario_Fecha_caducidad']) : '';
$Rela_tabla19=isset($_POST['Rela_tabla19']) ? strval($_POST['Rela_tabla19']) : '';
$Rela_tabla20=isset($_POST['Rela_tabla20']) ? strval($_POST['Rela_tabla20']) : '';
$Fitosanitario_Nombre=utf8_decode($Fitosanitario_Nombre);
$nombre_funcion=isset($_POST['nombre_funcion']) ? strval($_POST['nombre_funcion']) : '';

switch ($nombre_funcion) {
    case "agregar_fitosanitarios":
		$id_res=agregar_fitosanitarios($Fitosanitario_Nombre,$Rela_tabla21,$Rela_tabla33,$Fitosanitario_Fabricante,$Cantidad_Agua,
$Fitosanitario_Fecha_caducidad,$Rela_tabla19,$Rela_tabla20,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
        break;
    case "borrar_fitosanitarios":		
		$id_res=borrar_fitosanitarios($id_tabla18,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;
	case "modificar_fitosanitarios":
		$id_res=modificar_fitosanitarios($id_tabla18,$Fitosanitario_Nombre,$Rela_tabla21,$Rela_tabla33,$Fitosanitario_Fabricante,$Cantidad_Agua,
$Fitosanitario_Fecha_caducidad,$Rela_tabla19,$Rela_tabla20,$pdo);
		$vsplit=split("-",$id_res);
		echo $vsplit[1];
		break;	


}
$datos="";
$datos.="id_tabla18<@n:> $id_tabla18<@n>";
$datos.="Rela_tabla21<@n:> $Rela_tabla21<@n>";
$datos.="Rela_tabla21<@n:> $Rela_tabla21<@n>";
$datos.="Rela_tabla33<@n:> $Rela_tabla33<@n>";
$datos.="Fitosanitario_Fabricante<@n:> $Fitosanitario_Fabricante<@n>";
$datos.="Cantidad_Agua<@n:> $Cantidad_Agua<@n>";
$datos.="Fitosanitario_Fecha_caducidad<@n:> $Fitosanitario_Fecha_caducidad<@n>";
$datos.="Rela_tabla19<@n:> $Rela_tabla19<@n>";
$datos.="Rela_tabla20<@n:> $Rela_tabla20<@n>";
//agregar_log("ABM",$nombre_funcion,$vsplit[1],$datos,$modulo_actual,$link_mysql);

?>