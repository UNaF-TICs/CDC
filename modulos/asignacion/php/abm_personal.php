<?php

function agregar_personal($rela_tabla72,$rela_tabla70,$rela_tabla63,$pdo)
{
	
	$sql="INSERT INTO tabla_71_cab_personal  
		(
			rela_tabla72,
			rela_tabla70,
			rela_tabla63
		) 
		VALUES 
		(
			 $rela_tabla72,
			 $rela_tabla70,
			 $rela_tabla63
		)";	


		try { 
		$pdo->beginTransaction();
		$pdo->exec($sql);
		$new_id_tabla02 = $pdo->lastInsertId();
		echo $new_id_tabla02;
		$pdo->commit();
			return "1-Registro agregado correctamente correctamente";
		} catch (Exception $e) { //PDOException $e
		  $pdo->rollBack();
			return "0-Error: Se ha producido un error. ";
		}
}


function modificar_personal($id_tabla71,$rela_tabla72,$rela_tabla70,$rela_tabla63,$pdo)
{
	if ($rela_tabla70=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_71_cab_personal  SET 
			rela_tabla72=$rela_tabla72,
			rela_tabla70=$rela_tabla70,
			rela_tabla63=$rela_tabla63
			
			where id_tabla71=$id_tabla71";
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


function borrar_personal($id_tabla71,$pdo)
{
				$sql2="DELETE FROM tabla_71_cab_personal WHERE
				id_tabla71=$id_tabla71";
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