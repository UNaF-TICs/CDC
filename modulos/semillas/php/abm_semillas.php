<?php

function agregar_semilla($tabla25_nombre,$rela_tabla26,$rela_tabla27,$rela_tabla15,$tabla25_dosis,
$rela_tabla28,$rela_tabla74,$rela_tabla76,$pdo)
{
	
	$sql="INSERT INTO tabla_25_cab_semilla  
		(
			rela_tabla26,
			rela_tabla27,
			tabla25_nombre,
			rela_tabla15,
			tabla25_dosis,
			rela_tabla28,
			rela_tabla74,
			rela_tabla76
		) 
		VALUES 
		(
			$rela_tabla26,
			$rela_tabla27,
		   '$tabla25_nombre',
			$rela_tabla15,
		   '$tabla25_dosis',
			$rela_tabla28,
			$rela_tabla74,
			$rela_tabla76
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


function modificar_semilla($id_tabla25,$tabla25_nombre,$rela_tabla26,$rela_tabla27,$rela_tabla15,$tabla25_dosis,
$rela_tabla28,$rela_tabla74,$rela_tabla76,$pdo)
{
	if ($tabla25_nombre=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_25_cab_semilla  SET 
			tabla25_nombre='$tabla25_nombre',
			rela_tabla26=$rela_tabla26,
			rela_tabla27=$rela_tabla27,
			rela_tabla15='$rela_tabla15',
			tabla25_dosis='$tabla25_dosis',
			rela_tabla28='$rela_tabla28',
			rela_tabla74='$rela_tabla74',
			rela_tabla76=$rela_tabla76
			where id_tabla25=$id_tabla25";
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


function borrar_semilla($id_tabla25,$pdo)
{
				$sql2="DELETE FROM tabla_25_cab_semilla WHERE
				id_tabla25=$id_tabla25";
				try { 
				$pdo->beginTransaction();
				$pdo->exec($sql2);
				$new_id_tabla02 = $pdo->lastInsertId();
				$pdo->commit();
					return "1-Registro Eliminado correctamente ";
				} catch (Exception $e) { //PDOException $e
				  $pdo->rollBack();
					return "0-Error: Se ha producido un error. ";
				}
}

?>