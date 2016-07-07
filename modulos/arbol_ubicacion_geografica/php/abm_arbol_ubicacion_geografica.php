<?php

function agregar_arbol_ubicacion_geografica($rela_padre,$rela_tabla10,$tabla09_descripcion,$tabla09_codigo,$pdo)
{
	
	$sql="INSERT INTO tabla_09_arb_ubicacion_geografica  
		(
			rela_padre,
			rela_tabla10,
			tabla09_descripcion,
			tabla09_codigo
		) 
		VALUES 
		(
			'$rela_padre',
			'$rela_tabla10',
			'$tabla09_descripcion',
			'$tabla09_codigo'
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


function modificar_arbol_ubicacion_geografica($id_tabla09,$rela_padre,$rela_tabla10,$tabla09_descripcion,$tabla09_codigo,$pdo)
{
	if ($tabla10_titulo=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_09_arb_ubicacion_geografica  SET 
			rela_padre='$rela_padre',
			rela_tabla10=$rela_tabla10,
			tabla09_descripcion=$tabla09_descripcion,
			tabla09_codigo='$tabla09_codigo'
			where id_tabla09=$id_tabla09";
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


function borrar_arbol_ubicacion_geografica($id_tabla09,$pdo)
{
				$sql2="DELETE FROM tabla_09_arb_ubicacion_geografica WHERE
				id_tabla09=$id_tabla09";
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