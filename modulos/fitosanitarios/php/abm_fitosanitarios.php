<?php

function agregar_fitosanitarios($Fitosanitario_Nombre,$Rela_tabla21,$Rela_tabla33,$Fitosanitario_Fabricante,$Cantidad_Agua,
$Fitosanitario_Fecha_caducidad,$Rela_tabla19,$Rela_tabla20,$pdo)
{
	
	$sql="INSERT INTO tabla_18_cab_fitosanitario  
		(
			Fitosanitario_Nombre,
			Fitosanitario_Fabricante,
			Cantidad_Agua,
			Fitosanitario_Fecha_caducidad,
			Rela_tabla19,
			Rela_tabla20,
			Rela_tabla21,
			Rela_tabla33
		) 
		VALUES 
		(
			'$Fitosanitario_Nombre',
			'$Fitosanitario_Fabricante',
			 $Cantidad_Agua,
			 $Fitosanitario_Fecha_caducidad,
			 $Rela_tabla19,
			 $Rela_tabla20,
			 $Rela_tabla21,
			 $Rela_tabla33
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


function modificar_fitosanitarios($id_tabla18,$Fitosanitario_Nombre,$Rela_tabla21,$Rela_tabla33,$Fitosanitario_Fabricante,$Cantidad_Agua,
$Fitosanitario_Fecha_caducidad,$Rela_tabla19,$Rela_tabla20,$pdo)
{
	if ($Fitosanitario_Nombre=="")
	{
		return "0-Error: Complete campo obligatorio";	
	}
	

	$sql="UPDATE tabla_18_cab_fitosanitario  SET 
			Fitosanitario_Nombre='$Fitosanitario_Nombre',
			Rela_tabla21=$Rela_tabla21,
			Rela_tabla33=$Rela_tabla33,
			Fitosanitario_Fabricante='$Fitosanitario_Fabricante',
			Cantidad_Agua=$Cantidad_Agua,
			Fitosanitario_Fecha_caducidad=$Fitosanitario_Fecha_caducidad,
			Rela_tabla19=$Rela_tabla19,
			Rela_tabla20=$Rela_tabla20
			where id_tabla18=$id_tabla18";
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


function borrar_fitosanitarios($id_tabla18,$pdo)
{
				$sql2="DELETE FROM tabla_18_cab_fitosanitario WHERE
				id_tabla18=$id_tabla18";
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