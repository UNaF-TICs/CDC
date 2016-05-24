<?php
function agregar_personas( 	$tabla07_nropersona,
							$tabla07_nombre, 
							$tabla07_apellido,
							$tabla07_telfijo, 
							$tabla07_direccion, 
							$tabla07_celular,
							$tabla07_cumple,
							$tabla07_mail,
							$tabla07_sexo,
							$tabla07_dni,
							$tabla07_imagen,
							$link_mysql)
							{
							

		
		if ( $tabla07_nombre=="" || $tabla07_apellido==""|| $tabla07_sexo=="" || $tabla07_cumple=="--" || $tabla07_dni=="" )
		{
			return "0-Error:Complete el campo Obligatorios (*)";	
			exit;
		}

		if(strlen($tabla07_dni)<7)
		{
			return "0-Error: El DNI debe tener como m&iacute;nimo 7 caracteres";	
			exit;
		}
		$sql="select *
		from tabla_07_personas
		where tabla07_dni LIKE '%$tabla07_dni%'";
		$result_qr = mysql_query($sql,$link_mysql);
		$num_rows = mysql_num_rows($result_qr);
		if ($num_rows>0)
		{
			$row = mysql_fetch_assoc($result_qr);
			$nombre=htmlentities($row["tabla07_apellido"])." ".htmlentities($row["tabla07_nombre"]);
			return "0-Error: Ya existe una Persona con ese DNI. Persona: $nombre";	
			exit;

		}

			
			if ($_SESSION['id_tabla01']==""){
		    $rela_tabla01=0;
	       }else{
		   $rela_tabla01=$_SESSION['id_tabla01'];
			}
			
		   
			$sql="INSERT INTO tabla_07_personas (
 						rela_tabla01,
						tabla07_nropersona,
						tabla07_nombre, 
						tabla07_apellido, 
						tabla07_telfijo, 
						tabla07_direccion, 
						tabla07_celular,
						tabla07_cumple,
						tabla07_mail,
						tabla07_sexo,
						tabla07_dni,
						tabla07_imagen
						
			) VALUES (
						$rela_tabla01,
						$tabla07_nropersona,
						'$tabla07_nombre', 
						'$tabla07_apellido', 
						'$tabla07_telfijo',
						'$tabla07_direccion', 
						'$tabla07_celular',
						'$tabla07_cumple',		
						'$tabla07_mail',
						$tabla07_sexo,
						'$tabla07_dni',
						'$tabla07_imagen'
			)"; 
			//echo $sql;
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


      function modificar_personas($id_tabla07,
								$tabla07_nropersona,
								$tabla07_nombre, 
								$tabla07_apellido, 
								$tabla07_telfijo, 
								$tabla07_celular,
								$tabla07_direccion, 
								$tabla07_cumple,
								$tabla07_mail,
							    $tabla07_sexo,
								$tabla07_dni,
								$link_mysql)
							{
							
	
		if ( $tabla07_nombre=="" || $tabla07_apellido==""|| $tabla07_sexo=="" || $tabla07_cumple=="--" || $tabla07_dni=="" )
		{
			return "0-Error:Complete el campo Obligatorios (*)";	
			exit;
		}

		if(strlen($tabla07_dni)<7)
		{
			return "0-Error: El DNI debe tener como m&iacute;nimo 7 caracteres";	
			exit;
		}
		$sql="select *
		from tabla_07_personas
		where tabla07_dni LIKE '%$tabla07_dni%' and id_tabla07<>$id_tabla07";
		//echo $sql;
		$result_qr = mysql_query($sql,$link_mysql);
		$num_rows = mysql_num_rows($result_qr);
		if ($num_rows>0)
		{
			$row = mysql_fetch_assoc($result_qr);
			$nombre=htmlentities($row["tabla07_apellido"])." ".htmlentities($row["tabla07_nombre"]);
			return "0-Error: Ya existe una Persona con ese DNI.Persona: $nombre";	
			exit;

		}

		
			$sql="UPDATE tabla_07_personas SET 
						tabla07_nropersona=$tabla07_nropersona, 
						tabla07_nombre='$tabla07_nombre', 
						tabla07_apellido='$tabla07_apellido', 
						tabla07_telfijo='$tabla07_telfijo', 
						tabla07_direccion='$tabla07_direccion', 
						tabla07_celular='$tabla07_celular',
						tabla07_cumple='$tabla07_cumple',
						tabla07_mail='$tabla07_mail',
						tabla07_sexo=$tabla07_sexo,
						tabla07_dni=$tabla07_dni
						where id_tabla07=$id_tabla07";
			$result = mysql_query($sql,$link_mysql);
			//echo $sql;
			if (!$result>0) 
			{
				return "0-Error: Se ha producido un error. ".mysql_error();
			}
			else
			{
				return "$id_tabla07- Registro modificado correctamente";
				
			}

}
function borrar_personas($id_tabla07,$link_mysql)
{

		$sql="DELETE FROM tabla_07_personas WHERE id_tabla07=$id_tabla07";	
			$result = mysql_query($sql,$link_mysql);
	
		   if (!$result>0) 
		   {
				return "0-Error: Se ha producido un error. ".mysql_error();
		   }
		   else
		   {
				return "$id_tabla07- Registro borrado correctamente";
				
		   }

}	
		
?>