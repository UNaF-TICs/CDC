<?php

function agregar_mantenimiento($rela_tabla22,$tabla23_descripcion,$tabla23_fecha_mantenimiento,$tabla23_estado,$tabla23_fecha_trabajo,
$tabla23_observacion,$pdo)

{
	
	$sql="INSERT INTO tabla_23_tbl_mantenimiento  
		(
			rela_tabla22,
			tabla23_descripcion,
			tabla23_fecha_mantenimiento,
			tabla23_estado,
			tabla23_fecha_trabajo,
			tabla23_observacion

		) 
		VALUES 
		(
			$rela_tabla22,
			'$tabla23_descripcion',
			'$tabla23_fecha_mantenimiento',
			$tabla23_estado,
			'$tabla23_fecha_trabajo',
			'$tabla23_observacion'
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


function modificar_mantenimiento($id_tabla23,$rela_tabla22,$tabla23_descripcion,$tabla23_fecha_mantenimiento,$tabla23_estado,$tabla23_fecha_trabajo,
$tabla23_observacion,$pdo)

{
	if ($tabla23_fecha_mantenimiento=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}

	$sql="UPDATE tabla_23_tbl_mantenimiento  SET 
			tabla23_descripcion='$tabla23_descripcion',
			rela_tabla22=$rela_tabla22,
			tabla23_fecha_mantenimiento='$tabla23_fecha_mantenimiento',
			tabla23_estado=$tabla23_estado,
			tabla23_fecha_trabajo='$tabla23_fecha_trabajo',
			tabla23_observacion='$tabla23_observacion'
			where id_tabla23=$id_tabla23";
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


function borrar_mantenimiento($id_tabla23,$pdo)
{
				$sql2="DELETE FROM tabla_23_tbl_mantenimiento WHERE
				id_tabla23=$id_tabla23";
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