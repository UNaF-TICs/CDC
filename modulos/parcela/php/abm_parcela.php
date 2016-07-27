<?php

function agregar_parcela($tabla65_numero,$rela_tabla09,$rela_tabla64,$tabla65_limites,$tabla65_areatotal,$rela_tabla66,$tabla65_tieneregadio,$pdo)
{

	if ($tabla65_numero=="" || $rela_tabla09=="" || $rela_tabla64=="") {
		return "0-Error: Debe completar los campos obligatorios.";
	}

	$sql="INSERT INTO tabla_65_tbl_parcela
		(
			rela_tabla09,
			rela_tabla64,
			rela_tabla66,
			tabla65_numero,
			tabla65_limites,
			tabla65_tieneregadio,
			tabla65_areatotal
		)
		VALUES
		(
			$rela_tabla09,
			$rela_tabla64,
			$rela_tabla66,
			'$tabla65_numero',
			'$tabla65_limites',
			'$tabla65_tieneregadio',
			$tabla65_areatotal
		)";

	try {
		$pdo->beginTransaction();
		$pdo->exec($sql);
		$new_id_tabla65 = $pdo->lastInsertId();
		$pdo->commit();
		return "1-Registro agregado correctamente";
	} catch (Exception $e) { //PDOException $e
		$pdo->rollBack();
		return "0-Error: Se ha producido un error. ". $e->getMessage();
	}
}

function modificar_parcela($id_tabla65,$tabla65_numero,$rela_tabla09,$rela_tabla64,$tabla65_limites,$tabla65_areatotal,$rela_tabla66,$tabla65_tieneregadio,$pdo)
{
	if ($tabla65_numero=="") {
		return "0-Error: Complete campo obligatorio";
	}

	$sql="UPDATE tabla_65_tbl_parcela  SET
			tabla65_numero='$tabla65_numero',
			rela_tabla09=$rela_tabla09,
			rela_tabla64=$rela_tabla64,
			rela_tabla66=$rela_tabla66,
			tabla65_limites='$tabla65_limites',
			tabla65_tieneregadio='$tabla65_tieneregadio',
			tabla65_areatotal=$tabla65_areatotal
			where id_tabla65=$id_tabla65";

   	try {
		$pdo->beginTransaction();
		$pdo->exec($sql);
		$pdo->commit();
		return "1-Registro Modificado correctamente";
	} catch (Exception $e) { //PDOException $e
	  $pdo->rollBack();
		return "0-Error: Se ha producido un error. ". $e->getMessage();
	}
}

function borrar_parcela($id_tabla65,$pdo)
{
	$sql2="DELETE FROM tabla_65_tbl_parcela WHERE
	id_tabla65=$id_tabla65";

	try {
		$pdo->beginTransaction();
		$pdo->exec($sql2);
		$pdo->commit();
		return "1-Registro eliminado correctamente";
	} catch (Exception $e) { //PDOException $e
		$pdo->rollBack();
		return "0-Error: Se ha producido un error. ". $e->getMessage();
	}
}

?>
