<?php

function agregar_usuario($tabla01_nombre,$tabla01_usuario,$tabla01_contrasena,$tabla01_mail,$tabla01_activo,$rela_tabla16,$tabla01_espreventista,$link_mysql)
{

	if ($tabla01_usuario==""  || $tabla01_contrasena=="" || $tabla01_nombre=="" )
	{
		return "0-Error: Debe completar los campos obligatorios. (*)";	
	}

$sql="select * from tabla_01_usuarios where tabla01_usuario='$tabla01_usuario' ";
$result = mysql_query($sql,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows!='0')
{
	return "0-Error: Debes elegír otro nombre de usuario.";	
}

	$sql="INSERT INTO tabla_01_usuarios 
		(
			tabla01_usuario,
			tabla01_contrasena,
			tabla01_nombre,
			tabla01_mail,
			tabla01_activo
		) 
		VALUES 
		(
			'$tabla01_usuario',
			'$tabla01_contrasena',
			'$tabla01_nombre',
			'$tabla01_mail',
			'$tabla01_activo'
		)";	

		$result = mysql_query($sql,$link_mysql);
	    if (!$result>0) 
	   {
		   return "0-Error: Se ha producido un error. $sql ".mysql_error();
	   }
	   else
	   {
			return mysql_insert_id()."- Usuario agregado correctamente";
	   }
}


function modificar_usuario($id_tabla01,$tabla01_nombre,$tabla01_usuario,$tabla01_contrasena,$tabla01_mail,$tabla01_activo,$rela_tabla16,$tabla01_espreventista,$link_mysql)
{

	if ($tabla01_usuario==""   || $tabla01_contrasena=="" || $tabla01_nombre=="" )
	{
		return "0-Error: Debe completar los campos obligatorios. (*)";	
	}

	$sql="UPDATE tabla_01_usuarios SET 
			tabla01_usuario='$tabla01_usuario',
			tabla01_contrasena='$tabla01_contrasena',
			tabla01_nombre='$tabla01_nombre',
			tabla01_mail='$tabla01_mail',
			tabla01_activo='$tabla01_activo'
			where id_tabla01=$id_tabla01";

		$result = mysql_query($sql,$link_mysql);

	   if (!$result>0) 
	   {
			return "0-Error: Se ha producido un error. ".mysql_error();
	   }
	   else
	   {
			return "$id_tabla01- Usuario modificado correctamente";
			
	   }

}


function borrar_usuario($id_tabla01,$link_mysql)
{
		$sql="DELETE FROM tabla_01_usuarios WHERE id_tabla01=$id_tabla01";
		$result = mysql_query($sql,$link_mysql);
		
	   if (!$result>0) 
	   {
			return "0-Error: Se ha producido un error. ".mysql_error();
	   }
	   else
	   {
			return "$id_tabla01- Usuario eliminado correctamente";
			
	   }

}

?>


