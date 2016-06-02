<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
session_start();
require_once "../../../php/check.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_modulos.php";
include_once "../../control/php/abm_control.php";

							
$id_tabla02=isset($_POST['id_tabla02']) ? intval($_POST['id_tabla02']) : NULL;
$rela_padre=isset($_POST['rela_padre']) ? intval($_POST['rela_padre']) : NULL;
$tabla02_nombre=isset($_POST['tabla02_nombre']) ? strval($_POST['tabla02_nombre']) : '';
$tabla02_path_home=isset($_POST['tabla02_path_home']) ? strval($_POST['tabla02_path_home']) : '';
$tabla02_ayuda=isset($_POST['tabla02_ayuda']) ? strval($_POST['tabla02_ayuda']) : '';
$tabla02_orden=isset($_POST['rela_padre']) ? intval($_POST['tabla02_orden']) : NULL;
$tabla02_tipo=isset($_POST['tabla02_tipo']) ? intval($_POST['tabla02_tipo']) : NULL;
$icono=isset($_SESSION["session_tabla02_imagen"]) ? strval($_SESSION['session_tabla02_imagen']) : '';
$tabla02_nombre=utf8_decode($tabla02_nombre);
$tabla02_orden=utf8_decode($tabla02_orden);
$tabla02_imagen="";
$nombre_funcion=$_POST["nombre_funcion"];
switch ($nombre_funcion) {
    case "agregar_modulo":
			$rs = $pdo->query("Select max(id_tabla02) as pid from tabla_02_modulos ");//
			$num_rows = $rs->rowCount();
			if ($num_rows>0)
			{
				$row = $rs->fetch();
				$id_tabla02=$row["pid"]+1;
			}else{
				$id_tabla02=1;
			}

			if($icono)
			{
				$nm=split("\.",$icono);
				$tabla02_imagen="icono_$id_tabla02.".$nm[1];
				$destino=strtolower("../../../media/iconos/$tabla02_imagen");
				if(!@copy($icono, $destino))
				{
					$mensaje= "Error al copiar el archivo $icono $destino";
					echo $mensaje;
					//agregar_log($_SESSION['sesion_sysform03'],"abm",$nombre_funcion,$mensaje,"",$dbConn);

					$_SESSION['session_tabla02_imagen']="";
					exit;
				}else{
				$_SESSION['session_tabla02_imagen']="";
				}
			}
			$id_res=agregar_modulo($rela_padre,$tabla02_nombre,$tabla02_path_home,$tabla02_imagen,$tabla02_orden,$tabla02_ayuda,$tabla02_tipo,$pdo);
			$vsplit=explode("-",$id_res);
			$mensaje=$vsplit[1];
			echo $mensaje ;
			break;

    case "modificar_modulo":
			if($icono)
			{
				$nm=split("\.",$icono);
				$tabla02_imagen="icono_$id_tabla02.".$nm[1];
				$destino=strtolower("../../../media/iconos/$tabla02_imagen");
				if(!@copy($icono, $destino))
				{
					$mensaje= "Error al copiar el archivo $icono $destino";
					echo $mensaje;
					//agregar_log($_SESSION['sesion_sysform03'],"abm",$nombre_funcion,$mensaje,"",$dbConn);

					$_SESSION['session_tabla02_imagen']="";
					exit;
				}

				$_SESSION['session_tabla02_imagen']="";
			}
			
			$id_res= modificar_modulo($id_tabla02,$rela_padre,$tabla02_nombre,$tabla02_path_home,$tabla02_imagen,$tabla02_orden,$tabla02_ayuda,$tabla02_tipo,$pdo);
			$vsplit=split("-",$id_res);
			$mensaje=$vsplit[1];
			echo $mensaje ;
			break;
			
    case "borrar_modulo":		

		$res=borrar_modulo($id_tabla02,$pdo);
		$vsplit=split("-",$res);
		if ($vsplit[0] <= 0)
		{
			echo $vsplit[1];
		}
		else
		{
			echo $vsplit[1] ;
		}
		break;
	default:
		echo "Error en nombre de función " . $nombre_funcion;
}

$datos="";
$datos.="id_tabla02<@n:> $id_tabla02<@n>";
$datos.="rela_padre<@n:> $rela_padre<@n>";
$datos.="tabla02_nombre<@n:> $tabla02_nombre<@n>";
$datos.="tabla02_orden<@n:> $tabla02_orden<@n>";
$datos.="tabla02_path_home<@n:> $tabla02_path_home<@n>";
$datos.="tabla02_ayuda<@n:> $tabla02_ayuda<@n>";

//agregar_control("ABM",$nombre_funcion,$vsplit[1],$datos);
?>


