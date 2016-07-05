<?php

function agregar_maquinaria($tabla22_nombre,$tabla22_descripcion,$tabla22_marca,$tabla22_modelo,$tabla22_fecha_compra,$tabla22_costo_compra,$tabla22_matricula,$tabla22_empresa_seguro,$tabla22_rto,$tabla22_funcion,$pdo)
{

	$sql="INSERT INTO tabla_22_tbl_maquinaria
		(
			tabla22_nombre,
			tabla22_descripcion,
			tabla22_marca,
			tabla22_modelo,
			tabla22_fecha_compra,
			tabla22_costo_compra,
			tabla22_matricula,
            tabla22_empresa_seguro,
            tabla22_rto,
            tabla22_funcion
		)
		VALUES
		(
			'$tabla22_nombre',
			'$tabla22_descripcion',
			'$tabla22_marca',
			'$tabla22_modelo',
			STR_TO_DATE('$tabla22_fecha_compra','%d-%m-%Y'),
			$tabla22_costo_compra,
			'$tabla22_matricula',
            '$tabla22_empresa_seguro',
            '$tabla22_rto',
            '$tabla22_funcion'
		)";
		try {
		$pdo->beginTransaction();
		$pdo->exec($sql);
		$new_id_tabla02 = $pdo->lastInsertId();
		$pdo->commit();
			return "1-Registro agregado correctamente.";
		} catch (PDOException $e) { //PDOException $e
		  $pdo->rollBack();
			return "0-Error: Se ha producido un error. ".$e->getMessage();
        }
}


function modificar_maquinaria($id_tabla22,$tabla22_nombre,$tabla22_descripcion,$tabla22_marca,$tabla22_modelo,$tabla22_fecha_compra,$tabla22_costo_compra,$tabla22_matricula,$tabla22_empresa_seguro,$tabla22_rto,$tabla22_funcion,$pdo)
{
	if ($tabla22_nombre=="")
	{
		return "0-Error: Complete campo obligatorio.";
	}


	$sql="UPDATE tabla_22_tbl_maquinaria  SET
			tabla22_nombre='$tabla22_nombre',
			tabla22_descripcion='$tabla22_descripcion',
			tabla22_marca='$tabla22_marca',
			tabla22_modelo='$tabla22_modelo',
			tabla22_fecha_compra=STR_TO_DATE('$tabla22_fecha_compra','%d-%m-%Y'),
			tabla22_costo_compra='$tabla22_costo_compra',
			tabla22_matricula='$tabla22_matricula',
            tabla22_empresa_seguro='$tabla22_empresa_seguro',
            tabla22_rto='$tabla22_rto',
            tabla22_funcion='$tabla22_funcion'
            where id_tabla22=$id_tabla22";
	   	try {
			$pdo->beginTransaction();
			$pdo->exec($sql);
			$new_id_tabla02 = $pdo->lastInsertId();
			$pdo->commit();
				return "1-Registro Modificado correctamente.";
			} catch (Exception $e) { //PDOException $e
			  $pdo->rollBack();
				return "0-Error: Se ha producido un error. ".$e->getMessage();
        }
}


function borrar_maquinaria($id_tabla22,$pdo)
{
				$sql2="DELETE FROM tabla_22_tbl_maquinaria WHERE
				id_tabla22=$id_tabla22";
				try {
				$pdo->beginTransaction();
				$pdo->exec($sql2);
				$new_id_tabla02 = $pdo->lastInsertId();
				$pdo->commit();
					return "1-Registro Eliminado correctamente.";
				} catch (Exception $e) { //PDOException $e
				  $pdo->rollBack();
					return "0-Error: Se ha producido un error. ".$e->getMessage();
				}
}

?>
