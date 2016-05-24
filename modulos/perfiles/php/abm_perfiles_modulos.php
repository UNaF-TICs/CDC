<?php

function agregar_perfil_modulo($rela_tabla02,$rela_tabla03,$tabla04_alta,
	$tabla04_baja,$tabla04_modificacion,$tabla04_reporte,$link_mysql)
{

	if ($rela_tabla02=="" || $rela_tabla03=="" )
	{
		return "0-Error: Debe completar los campos obligatorios. $sql";	
	}

	$sql="INSERT INTO tabla_04_det_perfiles(
			rela_tabla02,
			rela_tabla03,
			tabla04_alta,
			tabla04_baja,
			tabla04_modificacion,
			tabla04_reporte
		) 
		VALUES 
		(
			$rela_tabla02,
			$rela_tabla03,
			'$tabla04_alta',
			'$tabla04_baja',
			'$tabla04_modificacion',
			'$tabla04_reporte'
		)";	
		$result = mysql_query($sql,$link_mysql);
	    if (!$result>0)  
	   {
		   return "0<@>Error: Se ha producido un error. $sql ".mysql_error();
	   }
	   else
	   {
			return mysql_insert_id()."<@>M&oacute;dulo de perfil agregado correctamente";
	   }
}


function modificar_perfil_modulo($id_tabla04,$rela_tabla02,$rela_tabla03,$tabla04_alta,
	$tabla04_baja,$tabla04_modificacion,$tabla04_reporte,$link_mysql)
{

	if ($rela_tabla02=="" || $rela_tabla03=="" )
	{
		return "0-Error: Debe completar los campos obligatorios.";	
	}
	
	$sql="UPDATE tabla_04_det_perfiles SET 
                    rela_tabla02=$rela_tabla02, 
                    rela_tabla03=$rela_tabla03, 
					tabla04_alta='$tabla04_alta',
                    tabla04_baja='$tabla04_baja',
                    tabla04_modificacion='$tabla04_modificacion',
                    tabla04_reporte='$tabla04_reporte' 
			where id_tabla04=$id_tabla04";
		$result = mysql_query($sql,$link_mysql);

	   if (!$result>0) 
	   {
			return "0<@>Error: Se ha producido un error. ".mysql_error();
	   }
	   else
	   {
			return "$id_tabla04<@>M&oacute;dulo de perfil modificado correctamente";
			
	   }

}


function borrar_perfil_modulo($id_tabla04,$link_mysql)
{

	$sql="DELETE FROM tabla_04_det_perfiles WHERE id_tabla04=$id_tabla04";
		$result = mysql_query($sql,$link_mysql);

	   if (!$result>0) 
	   {
			return "0<@>Error: Se ha producido un error. ".mysql_error();
	   }
	   else
	   {
			return "$id_tabla04<@>M&oacute;dulo de perfil eliminado correctamente";
			
	   }

}

?>


