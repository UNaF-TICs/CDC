<?php

function agregar_trabajo($Rela_Tabla14,$Tabla13_Descripcion,$pdo)
{
	
	$sql2="INSERT INTO tabla_13_cab_trabajo  
		(
			Rela_Tabla14,
			Tabla13_Descripcion
		) 
		VALUES 
		(
			$Rela_Tabla14,
			'$Tabla13_Descripcion'
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


function modificar_trabajo($id_tabla13,$Rela_Tabla14,$Tabla13_Descripcion,$pdo)
{
	if ($Tabla13_Descripcion=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_13_cab_trabajo  SET 
			Rela_Tabla14=$Rela_Tabla14,
			Tabla13_Descripcion='$Tabla13_Descripcion'
			where id_tabla13=$id_tabla13";
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


function borrar_trabajo($id_tabla13,$pdo)
{
				$sql2="DELETE FROM tabla_13_cab_trabajo WHERE
				id_tabla13=$id_tabla13";
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