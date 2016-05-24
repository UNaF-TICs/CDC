<?php
session_start();
include "../../../lib/template.inc";
include "../../../lib/link_mysql.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver_modulos"	=> "ver_modulos.html",
	"un_contenedor"	=> "un_contenedor.html",
	"un_modulo"	=> "un_submenu.html",
));

$id_tabla01=$_SESSION['id_tabla01'];
//$sesion_tipo_usuario=$_SESSION['sesion_tipo_usuario'];


//echo "hoii".$_SESSION['id_tabla01'];
if ($_SESSION['id_tabla01']=="")
{
echo "Error al acceder al sistema. Corrobore su usuario y contrase&ntilde;a.";
exit;
}


$qr="select * from tabla_01_usuarios 
		where id_tabla01=".$_SESSION['id_tabla01'];
$result = mysql_query($qr,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{
	$row = mysql_fetch_assoc($result);
	$t->set_var("tabla01_usuario",$row["tabla01_usuario"]);
	$t->set_var("id_tabla01",$row["id_tabla01"]);
	$t->set_var("tabla01_nombre",$row["tabla01_nombre"]);
}

//busco todos los modulos a los cuales puede acceder el usuario
if ($_SESSION['id_tabla01']=="1")
{
	$qr="SELECT * FROM tabla_02_modulos 
				where rela_padre IS NOT NULL ";


}
else
{
	$qr="SELECT * FROM (tabla_02_modulos 
				inner join tabla_04_det_perfiles on id_tabla02=rela_tabla02) 
				inner join tabla_06_det_usuarios_perfiles on tabla_06_det_usuarios_perfiles.rela_tabla03=tabla_04_det_perfiles.rela_tabla03
				where rela_padre IS NOT NULL AND rela_tabla01=".$_SESSION['id_tabla01'];
				echo $qr;
}
$result = mysql_query($qr,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{

	while ($row = mysql_fetch_assoc($result))
	{
		//voy a hacer un PHP que haga reload_session
		
		
		$tabla02_path_home="modulos/".$row["tabla02_path_home"];
		$id_tabla02=$row["id_tabla02"];
		//$sysform01_js=$row["sysform01_js"];
		$icono=$row["tabla02_imagen"];
		if ($icono=="")
		{
			$icono="modulos.png";
		}
		$t->set_var("id_tabla02",$row["id_tabla02"]);
		$t->set_var("tabla02_nombre",htmlentities($row["tabla02_nombre"],ENT_QUOTES));
		$t->set_var("tabla02_path_home",$row["tabla02_path_home"]);
		$t->set_var("tabla02_imagen","media/iconos/".$icono);
		$callback="function() {cargar_get('$tabla02_path_home','content');}";
		$t->set_var("funcion_cargar_modulo","reload_session($id_tabla02,$callback)");
		$t->parse("MODULOS","un_modulo",true);

	}
}else{
	$t->set_var("MODULOS","No posee M&oacute;dulos asignados");
}




$t->pparse("OUT", "ver_modulos");		
?>