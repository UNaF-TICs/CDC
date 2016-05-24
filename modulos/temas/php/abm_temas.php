<?php

function agregar_temas($tabla09_nombre,$tabla09_descripcion,$tabla09_subtema,$link_mysql)
{
	
	$sql="INSERT INTO tabla_09_temas  
		(
			tabla09_nombre,
			tabla09_descripcion,
			tabla09_subtema
		) 
		VALUES 
		(
			'$tabla09_nombre',
			'$tabla09_descripcion',
			'$tabla09_subtema'
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


function modificar_temas($id_tabla09,$tabla09_nombre,$tabla09_descripcion,$tabla09_subtema,$link_mysql)
{
	if ($tabla09_nombre=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_09_temas  SET 
			tabla09_nombre='$tabla09_nombre',
			tabla09_descripcion='$tabla09_descripcion',
			tabla09_subtema='$tabla09_subtema'
			where id_tabla09=$id_tabla09";
	   $result = mysql_query($sql,$link_mysql);
	   if (!$result>0) 
	   {
			return "0-Error: Se ha producido un error. ".mysql_error();
	   }
	   else
	   {
			return "$id_tabla09- Registro modificado correctamente";
	   }
}


function borrar_temas($id_tabla09,$link_mysql)
{

			
				$sql2="DELETE FROM tabla_09_temas WHERE
				id_tabla09=$id_tabla09";
				$result2 = mysql_query($sql2,$link_mysql);
				   if (!$result2>0) 
				   {
						return "0-Error: Se ha producido un error. ".mysql_error();
				   }
				   else
				   {
						return "$id_tabla09- Registro $msj correctamente";
				   }

}

?>