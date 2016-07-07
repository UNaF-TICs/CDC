<?php

function agregar_tipotrabajo($tabla14_Descripcion,$pdo)
{
	
	$sql="INSERT INTO tabla_14_det_tipo_trabajo  
		(
			tabla14_Descripcion
		) 
		VALUES 
		(
			'$tabla14_Descripcion'
		)";	
		try { 
		$pdo->beginTransaction();
		$pdo->exec($sql);
		$new_id_tabla02 = $pdo->lastInsertId();
		$pdo->commit();
			return "1-Registro agregado correctamente correctamente";
		} catch (Exception $e) { //PDOException $e
		  $pdo->rollBack();
			return "0-Error: Se ha producido un error. ";
		}
}


function modificar_tipotrabajo($id_Tabla14,$tabla14_Descripcion,$pdo)
{
	if ($tabla14_Descripcion=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_14_det_tipo_trabajo  SET 
			tabla14_Descripcion='$tabla14_Descripcion'
			where id_Tabla14=$id_Tabla14";
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


function borrar_tipotrabajo($id_Tabla14,$pdo)
{
				$sql2="DELETE FROM tabla_14_det_tipo_trabajo WHERE
				id_Tabla14=$id_Tabla14";
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