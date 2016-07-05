<?php

function agregar_personal($tabla12_nombre_empresa,$rela_tabla09,$tabla12_dni_nif,$tabla12_num_carne,
$tabla12_email,$tabla12_telefono,$tabla12_direccion,$tabla12_comentario,$pdo)
{
	
	$sql="INSERT INTO tabla_12_personal  
		(
			rela_tabla09,
			tabla12_nombre_empresa,
			tabla12_dni_nif,
			tabla12_num_carne,
			tabla12_email,
			tabla12_telefono,
			tabla12_direccion,
			tabla12_comentario
		) 
		VALUES 
		(
			 $rela_tabla09,
			'$tabla12_nombre_empresa',
			 $tabla12_dni_nif,
			 $tabla12_num_carne,
			'$tabla12_email',
			 $tabla12_telefono,
			'$tabla12_direccion',
			'$tabla12_comentario'
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


function modificar_personal($id_tabla12,$rela_tabla09,$tabla12_nombre_empresa,$tabla12_dni_nif,$tabla12_num_carne,
$tabla12_email,$tabla12_telefono,$tabla12_direccion,$tabla12_comentario,$pdo)
{
	if ($tabla12_nombre_empresa=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_12_personal  SET 
			tabla12_nombre_empresa='$tabla12_nombre_empresa',
			rela_tabla09=$rela_tabla09,
			tabla12_dni_nif=$tabla12_dni_nif,
			tabla12_num_carne=$tabla12_num_carne,
			tabla12_email='$tabla12_email',
			tabla12_telefono=$tabla12_telefono,
			tabla12_direccion='$tabla12_direccion',
			tabla12_comentario='$tabla12_comentario'
			where id_tabla12=$id_tabla12";
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


function borrar_personal($id_tabla12,$pdo)
{
				$sql2="DELETE FROM tabla_12_personal WHERE
				id_tabla12=$id_tabla12";
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