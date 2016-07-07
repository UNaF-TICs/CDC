<?php

function agregar_personal($tabla70_razon_social,$tabla70_cuit,$tabla70_nombre_apellido,$tabla70_dni,$tabla70_foto,
$tabla70_email,$tabla70_telefono,$tabla70_direccion,$pdo)
{
	
	$sql="INSERT INTO tabla_70_tbl_persona  
		(
			tabla70_razon_social,
			tabla70_cuit,
			tabla70_nombre_apellido,
			tabla70_dni,
			tabla70_foto,
			tabla70_email,
			tabla70_telefono,
			tabla70_direccion
			
		) 
		VALUES 
		(
			'$tabla70_razon_social',
			 $tabla70_cuit,
			'$tabla70_nombre_apellido',
			 $tabla70_dni,
			'$tabla70_foto',
			'$tabla70_email',
			 $tabla70_telefono,
			'$tabla70_direccion'
			
		)";	


		try { 
		$pdo->beginTransaction();
		$pdo->exec($sql);
		$new_id_tabla02 = $pdo->lastInsertId();
		echo $new_id_tabla02;
		$pdo->commit();
			return "1-Registro agregado correctamente correctamente";
		} catch (Exception $e) { //PDOException $e
		  $pdo->rollBack();
			return "0-Error: Se ha producido un error. ";
		}
}


function modificar_personal($id_tabla70,$tabla70_razon_social,$tabla70_cuit,$tabla70_nombre_apellido,$tabla70_dni,$tabla70_foto,$tabla70_email,$tabla70_telefono,$tabla70_direccion,$pdo)
{
	if ($tabla70_nombre_apellido=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_70_tbl_persona  SET 
			tabla70_nombre_apellido='$tabla70_nombre_apellido',
			tabla70_razon_social='$tabla70_razon_social',
			tabla70_cuit=$tabla70_cuit,
			tabla70_dni=$tabla70_dni,
			tabla70_foto='$tabla70_foto',
			tabla70_email='$tabla70_email',
			tabla70_telefono=$tabla70_telefono,
			tabla70_direccion='$tabla70_direccion'
			where id_tabla70=$id_tabla70";
	   	try { 
			$pdo->beginTransaction();
			$pdo->exec($sql);
			$new_id_tabla02 = $pdo->lastInsertId();
			$pdo->commit();
				return "1-Registro Modificado correctamente correctamente";
			} catch (Exception $e) { //PDOException $e
			  $pdo->rollBack();
				return "0-Error: Se ha producido un error. ";
			}
}


function borrar_personal($id_tabla70,$pdo)
{
				$sql2="DELETE FROM tabla_70_tbl_persona WHERE
				id_tabla70=$id_tabla70";
				try { 
				$pdo->beginTransaction();
				$pdo->exec($sql2);
				$new_id_tabla02 = $pdo->lastInsertId();
				$pdo->commit();
					return "1-Registro Eliminado correctamente correctamente";
				} catch (Exception $e) { //PDOException $e
				  $pdo->rollBack();
					return "0-Error: Se ha producido un error. ";
				}
}

?>