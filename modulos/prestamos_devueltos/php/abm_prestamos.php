<?php
include "../../../lib/link_mysql.php";
function agregar_prestamos($rela_tabla10,$rela_tabla07,$tabla12_fecha_prestamo,$tabla12_fecha_a_devolver,
$tabla12_fecha_devolucion,$link_mysql)
{
	
	
	
	    $sql_1="select * from tabla_10_libros  
		where id_tabla10=$rela_tabla10";
		$result_1 = mysql_query($sql_1,$link_mysql);
		$num_rows = mysql_num_rows($result_1);
		if ($num_rows>0)
		{
				//echo $sql_1;
				$row = mysql_fetch_assoc($result_1);
				$tabla10_cantidad=$row["tabla10_cantidad"] - 1;
				if($tabla10_cantidad < 0)
				{
					return "0-Error: NO hay stock Disponible. ";
					exit;
				}
				$sql_2="UPDATE tabla_10_libros  SET 
				tabla10_cantidad=$tabla10_cantidad
				where id_tabla10=$rela_tabla10";
			   $result_2 = mysql_query($sql_2,$link_mysql);
			   if (!$result_2>0) 
			   {
					return "0-Error: Se ha producido un error. ".mysql_error();
			   }
			   else
			   {
					echo "$rela_tabla10- Stock actualizado correctamente";
			   }
		}	
	//echo $tabla12_fecha_prestamo;
	$sql="INSERT INTO tabla_12_prestamos  
		(
			rela_tabla10,
			rela_tabla07,
			tabla12_fecha_prestamo,
			tabla12_fecha_a_devolver,
			tabla12_fecha_devolucion
		) 
		VALUES 
		(
			$rela_tabla10,
			$rela_tabla07,
			'$tabla12_fecha_prestamo',
			'$tabla12_fecha_a_devolver',
			NULL
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


function modificar_prestamos($id_tabla12,$rela_tabla10,$rela_tabla07,$tabla12_fecha_prestamo,$tabla12_fecha_a_devolver,
$tabla12_fecha_devolucion,$link_mysql)
{

	$sql_1="select * from tabla_10_libros  
		where id_tabla10=$rela_tabla10";
		$result_1 = mysql_query($sql_1,$link_mysql);
		$num_rows = mysql_num_rows($result_1);
		if ($num_rows>0)
		{
				//echo $sql_1;
				$row = mysql_fetch_assoc($result_1);
				$tabla10_cantidad=$row["tabla10_cantidad"] + 1;
				
				$sql_2="UPDATE tabla_10_libros  SET 
				tabla10_cantidad=$tabla10_cantidad
				where id_tabla10=$rela_tabla10";
			   $result_2 = mysql_query($sql_2,$link_mysql);
			   if (!$result_2>0) 
			   {
					return "0-Error: Se ha producido un error. ".mysql_error();
			   }
			   else
			   {
					echo "$rela_tabla10- Stock actualizado correctamente";
			   }
		}	

	$sql="UPDATE tabla_12_prestamos  SET 
			rela_tabla10=$rela_tabla10,
			rela_tabla07=$rela_tabla07,
			tabla12_fecha_prestamo='$tabla12_fecha_prestamo',
			tabla12_fecha_a_devolver='$tabla12_fecha_a_devolver',
			tabla12_fecha_devolucion='$tabla12_fecha_devolucion'
			where id_tabla12=$id_tabla12";
	   $result = mysql_query($sql,$link_mysql);
	   if (!$result>0) 
	   {
			return "0-Error: Se ha producido un error. ".mysql_error();
	   }
	   else
	   {
			return "$id_tabla12- Registro modificado correctamente";
	   }
}


function borrar_prestamos($id_tabla12,$link_mysql)
{

			
				$sql2="DELETE FROM tabla_12_prestamos WHERE
				id_tabla12=$id_tabla12";
				$result2 = mysql_query($sql2,$link_mysql);
				   if (!$result2>0) 
				   {
						return "0-Error: Se ha producido un error. ".mysql_error();
				   }
				   else
				   {
						return "$id_tabla12- Registro $msj correctamente";
				   }

}

?>