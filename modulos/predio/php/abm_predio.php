<?php

function agregar_predio($tabla64_nombrepredio,$rela_tabla09,$rela_tabla63,$tabla64_limites,$tabla64_areatotal,$pdo)
{

	if ($tabla64_nombrepredio=="" || $rela_tabla09=="" || $rela_tabla63=="") {
		return "0-Error: Debe completar los campos obligatorios.";
	}

	$sql="INSERT INTO tabla_64_tbl_predio
		(
			rela_tabla09,
			rela_tabla63,
			tabla64_nombrepredio,
			tabla64_limites,
			tabla64_areatotal
		)
		VALUES
		(
			$rela_tabla09,
			$rela_tabla63,
			'$tabla64_nombrepredio',
			'$tabla64_limites',
			$tabla64_areatotal
		)";

	try {
		$pdo->beginTransaction();
		$pdo->exec($sql);
		$new_id_tabla64 = $pdo->lastInsertId();
		$pdo->commit();
		return "1-Registro agregado correctamente";
	} catch (Exception $e) { //PDOException $e
		$pdo->rollBack();
		return "0-Error: Se ha producido un error. ". $e->getMessage()
	}
}

function modificar_predio($id_tabla64,$tabla64_nombrepredio,$rela_tabla09,$rela_tabla63,$tabla64_limites,$tabla64_areatotal,$pdo)
{
	if ($tabla64_nombrepredio=="") {
		return "0-Error: Complete campo obligatorio";
	}

	$sql="UPDATE tabla_64_tbl_predio  SET
			tabla64_nombrepredio='$tabla64_nombrepredio',
			rela_tabla09=$rela_tabla09,
			rela_tabla63=$rela_tabla63,
			tabla64_limites='$tabla64_limites',
			tabla64_areatotal=$tabla64_areatotal
			where id_tabla64=$id_tabla64";

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

function borrar_predio($id_tabla64,$pdo)
{
	$sql2="DELETE FROM tabla_64_tbl_predio WHERE
	id_tabla64=$id_tabla64";

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
