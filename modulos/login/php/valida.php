<?php
session_start();
include "../../../lib/link_mysql.php";
include_once "../../control/php/abm_control.php";
//include "../../../lib/dbconect.inc";
//include "privilegios.php";

ini_set("session.cache_expire",30);
ini_set("session.gc_maxlifetime",9000);

/*if (isset($_SESSION['sesion_sysform03'])) {
    echo 'Error Logueo';
	exit(); 
}*/
//$_SESSION['sesion_id_usuario'];  //id usuario
//$_SESSION['sesion_tipo_usuario']; //accesos a los modulos
 

$usu=$_POST["usu"]; /*perfil del usuario*/
$cla=$_POST["cla"]; /*perfil del usuario*/
//echo $usu." ".$cla;
$sql="SELECT * FROM tabla_01_usuarios WHERE tabla01_usuario='$usu' AND tabla01_contrasena='$cla' and tabla01_activo=1";
$rs = $pdo->query($sql);//
$row = $rs->fetch();
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
		if (strcmp($cla,$row["tabla01_contrasena"])==0 && strcmp($usu,$row["tabla01_usuario"])==0)
		{
			$_SESSION['id_tabla01'] = $row["id_tabla01"];
			agregar_control("ABM","Logueo","Logueado correctamente","$usu",$pdo);
			echo "ok";	
			////////////////////
			/*$_SESSION['where_accesos_ofertas'] = "";
			$_SESSION['id_sysform03'] = $row["id_sysform03"];
			$query="SELECT * FROM educacion.sys_edu_24_det_usuarios_ofertas 
							WHERE rela_sysform03=".$row["id_sysform03"];
			$result_ofertas = pg_query($link_pg,$query);
			$num_rows = pg_num_rows($result_ofertas);
			if ($num_rows>0)
			{
				$in_accesos_usuario="";
				while ($row_ofertas = pg_fetch_assoc($result_ofertas))
				{
					 $rela_syswser01=$row_ofertas["rela_syswser01"];
					 $in_accesos_usuario.="$rela_syswser01,";
				}
				$in_accesos_usuario=rtrim($in_accesos_usuario,",");*/
				//$_SESSION['where_accesos_ofertas'] = $in_accesos_usuario;
			////////////////////////		
		}
		else
		{
			agregar_control("ABM","Logueo","Error Logueo","usuario: $usu ($cla)",$pdo);
			echo "Error Logueo";
		}


}else{
	agregar_control("ABM","Logueo","Error Logueo","usuario: $usu ($cla)",$pdo);
	echo "Error Logueo";
}

?>
