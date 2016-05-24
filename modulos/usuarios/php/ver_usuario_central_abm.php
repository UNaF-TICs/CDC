<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"main"		=> "ver_usuario_central_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));

$home=$_POST["home"];
$id_tabla01=$_POST["id_tabla01"]; 
$offset=$_POST["offset"]; 
$habilitado = array('0' => 'No','1' => 'Si'); 
$espreventistas = array('0' => 'No','1' => 'Si'); 
$id_tabla01=$_SESSION['id_tabla01'];

if ($id_tabla01!="")
{
	$sql="select * from tabla_01_usuarios 
			where id_tabla01=$id_tabla01";

	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		$row = mysql_fetch_assoc($result);
		$id_tabla01=$row["id_tabla01"];
		$rela_tabla16=$row["rela_tabla16"];
		$tabla01_activo=$row["tabla01_activo"];
		$t->set_var("tabla01_nombre",$row["tabla01_nombre"]);
		$t->set_var("tabla01_usuario",$row["tabla01_usuario"]);
		$t->set_var("tabla01_contrasena",$row["tabla01_contrasena"]);
		$t->set_var("tabla01_mail",$row["tabla01_mail"]);

	}
	
	
	$url="'modulos/usuarios/php/abm_usuarios_interfaz.php'";
	$vars="'nombre_funcion=modificar_usuario&";
	$vars.="id_tabla01=$id_tabla01&";
	$vars.="tabla01_nombre='+abm_usuarios.tabla01_nombre.value+'&";
	$vars.="tabla01_usuario='+abm_usuarios.tabla01_usuario.value+'&";
	$vars.="tabla01_contrasena='+abm_usuarios.tabla01_contrasena.value+'&";
	$vars.="tabla01_activo='+abm_usuarios.tabla01_activo.value+'&";
	$vars.="tabla01_mail='+abm_usuarios.tabla01_mail.value";

	$url_exito="'modulos/usuarios/php/ver_usuario_central_abm.php'";
	$id="'popup'";
	$vars_exito="''";		

	$t->set_var("tit","Modificar usuario");
}

while ($fruit_name = current($habilitado)) 
{
	$id_habilitado=key($habilitado);
    if ($id_habilitado == $tabla01_activo) 
	{
        //echo key($array).'<br />';
		$t->set_var("id","\"$id_habilitado\" SELECTED");
		$t->set_var("descripcion",htmlentities($fruit_name, ENT_QUOTES));	
		$t->parse("ESTADO","una_opcion",true);
    }
	else
	{
		$t->set_var("id",$id_habilitado);
		$t->set_var("descripcion",htmlentities($fruit_name, ENT_QUOTES));	
		$t->parse("ESTADO","una_opcion",true);	
	}
    next($habilitado);
}
	


$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		



$t->set_var("funcion_cerrar","$('#popup').dialogr('close');");	

//echo $estructura_hc;
$t->pparse("OUT", "main");

?>




