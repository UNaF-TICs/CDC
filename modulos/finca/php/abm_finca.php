<?php

function agregar_finca($rela_tabla70_finca,$rela_tabla70_titular,$rela_tabla67,$tabla63_tiporepresentante,$tabla63_entidadcertificadora,$tabla63_areatotal,$pdo)
{

	$sql="INSERT INTO tabla_63_tbl_finca
		(
			rela_tabla67,
			rela_tabla70_finca,
			rela_tabla70_titular,
			tabla63_tiporepresentante,
			tabla63_entidadcertificadora,
			tabla63_areatotal
		)
		VALUES
		(
			$rela_tabla67,
			$rela_tabla70_finca,
			$rela_tabla70_titular,
			'$tabla63_tiporepresentante',
			'$tabla63_entidadcertificadora',
			$tabla63_areatotal
		)";

	phpAlert($sql);
	try {
		$pdo->beginTransaction();
		$pdo->exec($sql);
		$new_id_tabla02 = $pdo->lastInsertId();
		$pdo->commit();
		return "1-Registro agregado correctamente.";
	} catch (Exception $e) { //PDOException $e
		$pdo->rollBack();
		return "0-Error: Se ha producido un error. " . $e->getMessage();
	}
}


function modificar_finca($id_tabla63,$rela_tabla70_finca,$rela_tabla70_titular,$rela_tabla67,$tabla63_tiporepresentante,$tabla63_entidadcertificadora,$tabla63_areatotal,$pdo)
{
	// if ($tabla10_titulo=="")
	// {
	// 	return "0-Error: Complete campo obligatorio";
	// }

	$sql="UPDATE tabla_63_tbl_finca  SET
			rela_tabla70_finca=$rela_tabla70_finca,
			rela_tabla70_titular=$rela_tabla70_titular,
			rela_tabla67=$rela_tabla67,
			tabla63_tiporepresentante='$tabla63_tiporepresentante',
			tabla63_entidadcertificadora='$tabla63_entidadcertificadora',
			tabla63_areatotal=$tabla63_areatotal
			where id_tabla63=$id_tabla63";
   	try {
		$pdo->beginTransaction();
		$pdo->exec($sql);
		$new_id_tabla02 = $pdo->lastInsertId();
		$pdo->commit();
		return "1-Registro Modificado correctamente.";
	} catch (Exception $e) { //PDOException $e
		$pdo->rollBack();
		return "0-Error: Se ha producido un error. " . $e->getMessage();
	}
}

function borrar_finca($id_tabla63,$pdo)
{
	$sql2="DELETE FROM tabla_63_tbl_finca WHERE
	id_tabla63=$id_tabla63";
	try {
		$pdo->beginTransaction();
		$pdo->exec($sql2);
		$new_id_tabla02 = $pdo->lastInsertId();
		$pdo->commit();
		return "1-Registro Eliminado correctamente.";
	} catch (Exception $e) { //PDOException $e
		$pdo->rollBack();
		return "0-Error: Se ha producido un error. " . $e->getMessage();
	}
}

?>
