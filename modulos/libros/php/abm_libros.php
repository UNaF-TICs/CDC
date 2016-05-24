<?php

function agregar_libros($tabla10_titulo,$rela_tabla09,$rela_tabla11,$tabla10_subtitulo,$tabla10_descripcion,
$tabla10_fecha_entrada,$tabla10_tomo,$tabla10_cantidad,$pdo)
{
	
	$sql="INSERT INTO tabla_10_libros  
		(
			rela_tabla09,
			rela_tabla11,
			tabla10_titulo,
			tabla10_subtitulo,
			tabla10_descripcion,
			tabla10_fecha_entrada,
			tabla10_tomo,
			tabla10_cantidad
		) 
		VALUES 
		(
			$rela_tabla09,
			$rela_tabla11,
			'$tabla10_titulo',
			'$tabla10_subtitulo',
			'$tabla10_descripcion',
			'$tabla10_fecha_entrada',
			'$tabla10_tomo',
			$tabla10_cantidad
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


function modificar_libros($id_tabla10,$tabla10_titulo,$rela_tabla09,$rela_tabla11,$tabla10_subtitulo,$tabla10_descripcion,
$tabla10_fecha_entrada,$tabla10_tomo,$tabla10_cantidad,$pdo)
{
	if ($tabla10_titulo=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_10_libros  SET 
			tabla10_titulo='$tabla10_titulo',
			rela_tabla09=$rela_tabla09,
			rela_tabla11=$rela_tabla11,
			tabla10_subtitulo='$tabla10_subtitulo',
			tabla10_descripcion='$tabla10_descripcion',
			tabla10_fecha_entrada='$tabla10_fecha_entrada',
			tabla10_tomo='$tabla10_tomo',
			tabla10_cantidad=$tabla10_cantidad
			where id_tabla10=$id_tabla10";
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


function borrar_libros($id_tabla10,$pdo)
{
				$sql2="DELETE FROM tabla_10_libros WHERE
				id_tabla10=$id_tabla10";
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