<?php

function agregar_tipo_personal($tabla72_descripcion,$pdo)
{

	$sql="INSERT INTO tabla_72_tbl_tipo_personal
		(
			tabla72_descripcion
		)
		VALUES
		(
			'$tabla72_descripcion'
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


function modificar_tipo_personal($id_tabla72,$tabla72_descripcion,$pdo)
{
	if ($tabla72_descripcion=="")
	{
		return "0-Error: Complete campo obligatorio";
	}


	$sql="UPDATE tabla_72_tbl_tipo_personal  SET
			tabla72_descripcion='$tabla72_descripcion'
			where id_tabla72=$id_tabla72";
	   	try {
			$pdo->beginTransaction();
			$pdo->exec($sql);
			$new_id_tabla02 = $pdo->lastInsertId();
			$pdo->commit();
				return "1-Registro Modificado correctamente correctamente";
			} catch (Exception $e) { //PDOException $e
			  $pdo->rollBack();
				return "0-Error: Se ha producido un error. ". $e->getMessage();
			}
}


function borrar_tipo_personal($id_tabla72,$pdo)
{
	$sql2="DELETE FROM tabla_72_tbl_tipo_personal WHERE
	id_tabla72=$id_tabla72";
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
