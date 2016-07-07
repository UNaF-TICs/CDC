<?php

function agregar_plaga($tabla33_descripcion,$pdo)
{
	
	$sql2="INSERT INTO tabla_33_tbl_plaga  
		(
			
			tabla33_descripcion
		) 
		VALUES 
		(
			
			'$tabla33_descripcion'
		)";	
		try { 
		$pdo->beginTransaction();
		$pdo->exec($sql2);
		$new_id_tabla02 = $pdo->lastInsertId();
		$pdo->commit();
			return "1-Registro agregado correctamente correctamente";
		} catch (Exception $e) { //PDOException $e
		  $pdo->rollBack();
			return "0-Error: Se ha producido un error. ";
		}
}


function modificar_trabajo($id_tabla33,$tabla33_descripcion,$pdo)
{
	if ($tabla33_descripcion=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_33_tbl_plaga  SET 
			tabla33_descripcion='$tabla33_descripcion'
			where id_tabla33=$id_tabla33";
	   	try { 
			$pdo->beginTransaction();
			$pdo->exec($sql);
			$new_id_tabla02 = $pdo->lastInsertId();
			$pdo->commit();
				return "1-Registro Modificado correctamente correctamente";
			} catch (Exception $e) { //PDOException $e
			  $pdo->rollBack();
				return  "0-Error: Se ha producido un error. ";
			}
}


function borrar_trabajo($id_tabla33,$pdo)
{
				$sql2="DELETE FROM tabla_33_tbl_plaga WHERE
				id_tabla33=$id_tabla33";
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