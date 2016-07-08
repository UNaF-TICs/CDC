<?php

function agregar_sisriego($tabla66_descrip,$pdo)
{
	if ($tabla66_descrip=="") {
		return "0-Error: Debe completar los campos obligatorios.";
	}

	$sql="INSERT INTO tabla_66_tbl_sisriego
		(
			tabla66_descrip
		)
		VALUES
		(
			'$tabla66_descrip'
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


function modificar_sisriego($id_tabla66,$tabla66_descrip,$pdo)
{
	if ($tabla66_descrip=="") {
		return "0-Error: Debe completar los campos obligatorios.";
	}

	$sql="UPDATE tabla_66_tbl_sisriego  SET
			tabla66_descrip='$tabla66_descrip'
			where id_tabla66=$id_tabla66";
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


function borrar_sisriego($id_tabla66,$pdo)
{
	$sql2="DELETE FROM tabla_66_tbl_sisriego WHERE
	id_tabla66=$id_tabla66";
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
