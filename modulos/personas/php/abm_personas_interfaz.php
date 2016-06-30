<?php
/*
Librería: Funciones ABM y de recuperación de datos de noticias.
*/
session_start();
require_once "../../../php/check.php";
require_once "../../../php/funciones_comunes.php";
include_once "../../../lib/link_mysql.php";
include_once "abm_personas.php";
include_once "../../control/php/abm_control.php";

$modulo_actual="Personas"; // Poner Nombre del Modulo Actual
							
$id_tabla07=$_POST["id_tabla07"]; 
$rela_tabla11=$_POST["rela_tabla11"]; 
$tabla07_nombre=trim($_POST["tabla07_nombre"]); 
$tabla07_nombre=strtoupper($_POST["tabla07_nombre"]);
$tabla07_apellido=trim($_POST["tabla07_apellido"]);
$tabla07_apellido=strtoupper($_POST["tabla07_apellido"]);
$tabla07_direccion=strtoupper($_POST["tabla07_direccion"]);
$tabla07_telfijo=$_POST["tabla07_telfijo"];
$tabla07_celular=$_POST["tabla07_celular"];	
$tabla07_cumple=formatear_fecha($_POST["tabla07_cumple"]);	
$tabla07_mail=$_POST["tabla07_mail"];	
$tabla07_nropersona=$_POST["tabla07_nropersona"];
$tabla07_sexo=$_POST["tabla07_sexo"];	
$tabla07_dni=$_POST["tabla07_dni"];	
$icono=$_SESSION["session_tabla07_imagen"];

$tabla07_nropersona=utf8_decode($tabla07_nropersona);
$tabla07_nombre=utf8_decode($tabla07_nombre);
$tabla07_apellido=utf8_decode($tabla07_apellido);
$tabla07_direccion=utf8_decode($tabla07_direccion);
$tabla07_telfijo=utf8_decode($tabla07_telfijo);
$tabla07_celular=utf8_decode($tabla07_celular);
$tabla07_mail=utf8_decode($tabla07_mail);
$tabla07_cumple=utf8_decode($tabla07_cumple);

$nombre_funcion=$_POST["nombre_funcion"];



switch ($nombre_funcion) {
    case "agregar_personas":
	$result =mysql_query("Select max(id_tabla07) as pid from tabla_07_personas ",$link_mysql);
			$num_rows = mysql_num_rows($result);							
			if ($num_rows>0)
			{
				$row = mysql_fetch_assoc($result);
				$id_tabla07=$row["pid"]+1;
			}else{
				$id_tabla07=1;
			}

			if($icono)
			{
				$nm=explode("\.",$icono);
				$tabla07_imagen="icono_$id_tabla07.".$nm[1];
				$destino=strtolower("../../../media/fotos/$tabla07_imagen");
				if(!@copy($icono, $destino))
				{
					$mensaje= "Error al copiar el archivo $icono $destino";
					echo $mensaje;
					//agregar_log($_SESSION['sesion_sysform03'],"abm",$nombre_funcion,$mensaje,"",$dbConn);

					$_SESSION['session_tabla07_imagen']="";
					exit;
				}else{
				$_SESSION['session_tabla07_imagen']="";
				}
			}
		$id_res=agregar_personas($tabla07_nropersona,
							$tabla07_nombre, 
							$tabla07_apellido,
							$tabla07_telfijo, 
							$tabla07_direccion, 
							$tabla07_celular,
							$tabla07_cumple,
							$tabla07_mail,
							$tabla07_sexo,
							$tabla07_dni,
							$tabla07_imagen,
							$link_mysql);
		$vexplode=explode("-",$id_res);
		$mensaje=$vexplode[1];
		echo $mensaje ;
		break;
    case "borrar_personas":		
		$id_res=borrar_personas($id_tabla07,$link_mysql);
		$vexplode=explode("-",$id_res);
		$mensaje=$vexplode[1];
		echo $mensaje ;
		break;
    case "modificar_personas":
	if($icono)
			{
				$nm=explode("\.",$icono);
				$tabla07_imagen="icono_$id_tabla07.".$nm[1];
				$destino=strtolower("../../../media/fotos/$tabla07_imagen");
				if(!@copy($icono, $destino))
				{
					$mensaje= "Error al copiar el archivo $icono $destino";
					echo $mensaje;
					//agregar_log($_SESSION['sesion_sysform03'],"abm",$nombre_funcion,$mensaje,"",$dbConn);

					$_SESSION['session_tabla07_imagen']="";
					exit;
				}

				$_SESSION['session_tabla07_imagen']="";
			}
		$id_res=modificar_personas($id_tabla07,
								$tabla07_nropersona,
								$tabla07_nombre, 
								$tabla07_apellido, 
								$tabla07_telfijo, 
								$tabla07_celular,
								$tabla07_direccion, 
								$tabla07_cumple,
								$tabla07_mail,
							    $tabla07_sexo,
								$tabla07_dni,
								$link_mysql);
		$vexplode=explode("-",$id_res);
		$mensaje=$vexplode[1];
		echo $mensaje ;
		break;
}
$datos="";
$datos.="id_tabla07<@n:>".$vexplode[0]."<@n>";
$datos.="tabla07_nropersona<@n:> $tabla07_nropersona<@n>";
$datos.="tabla07_nombre<@n:> $tabla07_nombre<@n>";
$datos.="tabla07_apellido<@n:> $tabla07_apellido<@n>";
$datos.="tabla07_telfijo<@n:> $tabla07_telfijo<@n>";
$datos.="tabla07_direccion<@n:> $tabla07_direccion<@n>";
$datos.="tabla07_celular<@n:> $tabla07_celular<@n>";
$datos.="tabla07_cumple<@n:> $tabla07_cumple<@n>";
$datos.="tabla07_mail<@n:> $tabla07_mail<@n>";
$datos.="tabla07_sexo<@n:> $tabla07_sexo<@n>";
$datos.="tabla07_dni<@n:> $tabla07_dni<@n>";


//agregar_log("ABM",$nombre_funcion,$vexplode[1],$datos,$modulo_actual,$link_mysql);
?>