<?php

function agregar_variedad($tabla15_descripcion,$tabla15_nombre,$tabla15_temperatura_maxima,$tabla15_temperatura_minima,$tabla15_temperatura_optima,$pdo)
{
	
	$sql="INSERT INTO tabla_15_tbl_variedad  
		(
			tabla15_descripcion,
			tabla15_nombre,
			tabla15_temperatura_maxima,
			tabla15_temperatura_minima,
			tabla15_temperatura_optima
		) 
		VALUES 
		(
			'$tabla15_descripcion',
			'$tabla15_nombre',
			'$tabla15_temperatura_maxima',
			'$tabla15_temperatura_minima',
			'$tabla15_temperatura_optima'
		)";	//los campos numericos van sin comillas
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


function modificar_variedad($id_tabla15,$tabla15_descripcion,$tabla15_nombre,$tabla15_temperatura_maxima,$tabla15_temperatura_minima,$tabla15_temperatura_optima,$pdo)
{
	if ($tabla15_nombre=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_15_tbl_variedad  SET 
			tabla15_nombre='$tabla15_nombre',
			tabla15_descripcion='$tabla15_descripcion',
			tabla15_temperatura_maxima='$tabla15_temperatura_maxima',
			tabla15_temperatura_minima='$tabla15_temperatura_minima',
			tabla15_temperatura_optima='$tabla15_temperatura_optima'
			where id_tabla15=$id_tabla15";
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


function borrar_variedad($id_tabla15,$pdo)
{
				$sql2="DELETE FROM tabla_15_tbl_variedad WHERE
				id_tabla15=$id_tabla15";
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