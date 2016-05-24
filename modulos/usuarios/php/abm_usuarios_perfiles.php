<?php
function agregar_usuario_perfil($rela_tabla03,$rela_tabla01,$link_mysql)
{

	if ($rela_tabla03=="" || $rela_tabla01=="" )
	{
		return "0-Error: Debe completar los campos obligatorios.";	
	}
	
	$sql_val="Select * FROM tabla_06_det_usuarios_perfiles 
	 WHERE rela_tabla03=$rela_tabla03 and rela_tabla01=$rela_tabla01";
	$result = mysql_query($sql_val,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		return "0-Error: Ya tiene asignado ese Perfil. Seleccione otro.";
		exit;
	}
	
	$sql="INSERT INTO tabla_06_det_usuarios_perfiles 
		(
			rela_tabla03,
			rela_tabla01
		) 
		VALUES 
		(
			$rela_tabla03,
			$rela_tabla01
		)";		
		$result = mysql_query($sql,$link_mysql);
	    if (!$result>0) 
	   {
		   return "0-Error: Se ha producido un error. $sql ".mysql_error();
	   }
	   else
	   {
			return mysql_insert_id()."- Perfil de Usuario agregado correctamente";
	   }
}


function modificar_usuario_perfil($id_tabla06,$rela_tabla03,$rela_tabla01,$link_mysql)
{

	if ($rela_tabla03=="" || $rela_tabla01=="" )
	{
		return "0-Error: Debe completar los campos obligatorios.";	
	}
	$sql_val="Select * FROM tabla_06_det_usuarios_perfiles 
	 WHERE rela_tabla03=$rela_tabla03 and rela_tabla01=$rela_tabla01";
	$result = mysql_query($sql_val,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		return "0-Error: Ya tiene asignado ese Perfil. Seleccione otro.";
		exit;
	}
	$sql="UPDATE tabla_06_det_usuarios_perfiles SET 
					rela_tabla03=$rela_tabla03,
					rela_tabla01=$rela_tabla01 
			where id_tabla06=$id_tabla06";
		$result = mysql_query($sql,$link_mysql);

	   if (!$result>0) 
	   {
			return "0-Error: Se ha producido un error. ".mysql_error();
	   }
	   else
	   {
			return "$id_tabla06- Perfil de Usuario modificado correctamente";
			
	   }

}


function borrar_usuario_perfil($id_tabla06,$link_mysql)
{
		$sql="DELETE FROM tabla_06_det_usuarios_perfiles WHERE id_tabla06=$id_tabla06";
		$result = mysql_query($sql,$link_mysql);
	   if (!$result>0) 
	   {
			return "0-Error: Se ha producido un error. ".mysql_error();
	   }
	   else
	   {
			return "$id_tabla06- Perfil de Usuario borrado correctamente";
			
	   }

}

?>

