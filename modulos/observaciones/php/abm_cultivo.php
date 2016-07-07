<?php

function agregar_cultivo($tabla16_fecha_cosecha,$rela_tabla15,$rela_tabla65,$tabla16_fecha_siembra,$pdo)
{
	
	$sql="INSERT INTO tabla_16_cab_cultivo  
		(
			rela_tabla15,
			rela_tabla65,
			tabla16_fecha_cosecha,
			tabla16_fecha_siembra
		) 
		VALUES 
		(
			$rela_tabla15,
			$rela_tabla65,
			'$tabla16_fecha_cosecha',
			'$tabla16_fecha_siembra'
		)";	
		try { 
		$pdo->beginTransaction();
		$pdo->exec($sql);
		$new_id_tabla02 = $pdo->lastInsertId();
		$pdo->commit();
			return "1-Registro agregado correctamente correctamente";
		} catch (Exception $e) { //PDOException $e
		  $pdo->rollBack();
			return "0-Error: Se ha producido un error. ". $e->getMessage();
		}
}


function modificar_cultivo($id_tabla16,$tabla16_fecha_cosecha,$rela_tabla15,$rela_tabla65,$tabla16_fecha_siembra,$pdo)
{
	if ($id_tabla16=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_16_cab_cultivo  SET 
			tabla16_fecha_cosecha='$tabla16_fecha_cosecha',
			rela_tabla15=$rela_tabla15,
			rela_tabla65=$rela_tabla65,
			tabla16_fecha_siembra='$tabla16_fecha_siembra'
			where id_tabla16=$id_tabla16";
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


function borrar_cultivo($id_tabla16,$pdo)
{
				$sql2="DELETE FROM tabla_16_cab_cultivo WHERE
				id_tabla16=$id_tabla16";
				try { 
				$pdo->beginTransaction();
				$pdo->exec($sql2);
				$new_id_tabla02 = $pdo->lastInsertId();
				$pdo->commit();
					return "1-Registro Eliminado correctamente correctamente";
				} catch (Exception $e) { //PDOException $e
				  $pdo->rollBack();
					return "0-Error: Se ha producido un error. ". $e->getMessage();
				}
}

?>