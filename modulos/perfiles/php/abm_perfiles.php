<?php
function agregar_perfil($tabla03_nombre,$link_mysql)
{
	if ($tabla03_nombre=="" )
	{
		return "0-Error: Debe completar los campos obligatorios.";	
	}

	
		$sql="INSERT INTO tabla_03_perfiles (tabla03_nombre) VALUES ('$tabla03_nombre')"; 

		$result = mysql_query($sql,$link_mysql);
	    if (!$result>0) 
	   {
		   return "0-Error: Se ha producido un error. $sql ".mysql_error();
	   }
	   else
	   {
			return mysql_insert_id()."- Perfil agregado correctamente";
	   }
}


function modificar_perfil($id_tabla03,$tabla03_nombre,$link_mysql)
{

	if ($tabla03_nombre=="" )
	{
		return "0-Error: Debe completar los campos obligatorios.";	
	}
	
	$sql="UPDATE tabla_03_perfiles SET 
                    tabla03_nombre='$tabla03_nombre' 
			where id_tabla03=$id_tabla03";
		$result = mysql_query($sql,$link_mysql);

	   if (!$result>0) 
	   {
			return "0-Error: Se ha producido un error. ".mysql_error();
	   }
	   else
	   {
			return "$id_tabla03- Perfil modificado correctamente";
			
	   }

}
function borrar_perfil($id_tabla03,$link_mysql)
{
		$sql_val="Select rela_tabla03 FROM tabla_06_det_usuarios_perfiles
		 WHERE rela_tabla03=$id_tabla03";
		$result = mysql_query($sql_val,$link_mysql);
		$num_rows = mysql_num_rows($result);
		if ($num_rows>0)
		{
			$msg="0-Error: No puede eliminar el Perfil. Algun usuario lo tiene asignado";
	    }

		$sql_val="Select rela_tabla03  FROM tabla_04_det_perfiles WHERE rela_tabla03=$id_tabla03";
		$result = mysql_query($sql_val,$link_mysql);
		$num_rows = mysql_num_rows($result);
		if ($num_rows>0)
		{
			$msg="0-Error: No puede eliminar el Perfil. Posee algún Modulo asignado";
	    }

		if($msg=="")
		{
			$sql="DELETE FROM tabla_03_perfiles WHERE id_tabla03=$id_tabla03";
				$result = mysql_query($sql,$link_mysql);
		
			   if (!$result>0) 
			   {
					return "0-Error: Se ha producido un error. ".mysql_error();
			   }
			   else
			   {
					return "$id_tabla03- Perfil modificado correctamente";
					
			   }
		}else{
				return $msg;
		}
}	
		
?>