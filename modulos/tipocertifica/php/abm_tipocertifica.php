<?php

function agregar_tipocertifica($tabla67_descrip,$pdo)
{

	$sql="INSERT INTO tabla_67_tipocertifica
		(
			tabla67_descrip
		)
		VALUES
		(
			'$tabla67_descrip'
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


function modificar_tipocertifica($id_tabla67,$tabla67_descrip,$pdo)
{
	if ($tabla67_descrip=="")
	{
		return "0-Error: Complete campo obligatorio";
	}


	$sql="UPDATE tabla_67_tipocertifica  SET
			tabla67_descrip='$tabla67_descrip'
			where id_tabla67=$id_tabla67";
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


function borrar_tipocertifica($id_tabla67,$pdo)
{
	$sql2="DELETE FROM tabla_67_tipocertifica WHERE
	id_tabla67=$id_tabla67";
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
