<?php

function agregar_editoriales($tabla11_nombre,$tabla11_descripcion,$link_mysql)
{
	
	$sql="INSERT INTO tabla_11_editoriales  
		(
			tabla11_nombre,
			tabla11_descripcion
		) 
		VALUES 
		(
			'$tabla11_nombre',
			'$tabla11_descripcion'
		)";	

		$result = mysql_query($sql,$link_mysql);
	    if (!$result>0) 
	   {
		   return "0-Error: Se ha producido un error. $sql ".mysql_error();
	   }
	   else
	   {
			return mysql_insert_id()."- Registro agregado correctamente";
	   }
}


function modificar_temas($id_tabla11,$tabla11_nombre,$tabla11_descripcion,$link_mysql)
{
	if ($tabla11_nombre=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_11_editoriales  SET 
			tabla11_nombre='$tabla11_nombre',
			tabla11_descripcion='$tabla11_descripcion'
			where id_tabla11=$id_tabla11";
	   $result = mysql_query($sql,$link_mysql);
	   if (!$result>0) 
	   {
			return "0-Error: Se ha producido un error. ".mysql_error();
	   }
	   else
	   {
			return "$id_tabla11- Registro modificado correctamente";
	   }
}


function borrar_temas($id_tabla11,$link_mysql)
{

			
				$sql2="DELETE FROM tabla_11_editoriales WHERE
				id_tabla11=$id_tabla11";
				$result2 = mysql_query($sql2,$link_mysql);
				   if (!$result2>0) 
				   {
						return "0-Error: Se ha producido un error. ".mysql_error();
				   }
				   else
				   {
						return "$id_tabla11- Registro $msj correctamente";
				   }

}

?>