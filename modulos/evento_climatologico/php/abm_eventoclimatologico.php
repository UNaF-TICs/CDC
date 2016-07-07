<?php

function agregar_eventoclimatico($tabla99_observacion,$tabla99_fecha_inicio,$tabla99_fecha_fin,$rela_tabla16,$rela_tabla01,$rela_tabla74,$rela_tabla71,$tabla99_cantidad,$rela_tabla98,$pdo)
{
	$tabla99_fecha_inicio=date('Y-m-d H:i:s', strtotime($tabla99_fecha_inicio)); 

	$tabla99_fecha_fin=date('Y-m-d H:i:s', strtotime($tabla99_fecha_fin)); 

	$sql="INSERT INTO tabla_99_cab_eventoclimatologico  
		(	
			tabla99_observacion,
			tabla99_fecha_inicio,
			tabla99_fecha_fin,
			rela_tabla16,
			rela_tabla01,
			rela_tabla74,
			rela_tabla71,
			tabla99_cantidad,
			rela_tabla98
		) 
		VALUES 
		(
			'$tabla99_observacion',
			'$tabla99_fecha_inicio',
			'$tabla99_fecha_fin',
			 $rela_tabla16,
			 $rela_tabla01,
			 $rela_tabla74,
			 $rela_tabla71,
			'$tabla99_cantidad',
			 $rela_tabla98
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


function modificar_eventoclimatico($id_tabla99,$tabla99_observacion,$tabla99_fecha_inicio,$tabla99_fecha_fin,$rela_tabla16,$rela_tabla01,$rela_tabla74,$rela_tabla71,$tabla99_cantidad,$rela_tabla98,$pdo)
{
	
	$tabla99_fecha_inicio=date('Y-m-d H:i:s', strtotime($tabla99_fecha_inicio)); 

	$tabla99_fecha_fin=date('Y-m-d H:i:s', strtotime($tabla99_fecha_fin)); 
	if ($tabla99_observacion=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_99_cab_eventoclimatologico  SET 
			tabla99_observacion='$tabla99_observacion',
			tabla99_fecha_inicio='$tabla99_fecha_inicio',
			tabla99_fecha_fin='$tabla99_fecha_fin',
			rela_tabla16=$rela_tabla16,
			rela_tabla01=$rela_tabla01,
			rela_tabla74=$rela_tabla74,
			rela_tabla71=$rela_tabla71,
			tabla99_cantidad='$tabla99_cantidad'
			where id_tabla99=$id_tabla99";
	   	try { 
			$pdo->beginTransaction();
			$pdo->exec($sql);
			$new_id_tabla02 = $pdo->lastInsertId();
			$pdo->commit();
				return "1-Registro Modificado correctamente";
			} catch (Exception $e) { //PDOException $e
			  $pdo->rollBack();
				return "0-Error: Se ha producido un error. ";
			}
}


function borrar_eventoclimatico($id_tabla99,$pdo)
{
				$sql2="DELETE FROM tabla_99_cab_eventoclimatologico WHERE
				id_tabla99=$id_tabla99";
				try { 
				$pdo->beginTransaction();
				$pdo->exec($sql2);
				$new_id_tabla02 = $pdo->lastInsertId();
				$pdo->commit();
					return "1-Registro Eliminado correctamente";
				} catch (Exception $e) { //PDOException $e
				  $pdo->rollBack();
					return "0-Error: Se ha producido un error. ";
				}
}

?>
