<?php
function agregar_modulo($rela_padre,$tabla02_nombre,$tabla02_path_home,$tabla02_imagen,$tabla02_orden,$tabla02_ayuda,$tabla02_tipo,$pdo)
{
	if ($tabla02_nombre=="")
	{
		return "0-Error: Debe completar los campos obligatorios.";	
	}

	if ($rela_padre!="")
	{
			$sql="INSERT INTO tabla_02_modulos 
			(
				tabla02_nombre,
				tabla02_path_home,
				rela_padre,
				tabla02_imagen,
				tabla02_orden,
				tabla02_tipo,
				tabla02_ayuda
				
			) 
			VALUES 
			(
				'$tabla02_nombre',
				'$tabla02_path_home',
				$rela_padre,
				'$tabla02_imagen',
				$tabla02_orden,
				$tabla02_tipo,
				'$tabla02_ayuda'
			)";
	}
	else
	{
		$sql="INSERT INTO tabla_02_modulos  
			(
				tabla02_nombre,
				tabla02_orden,
				tabla02_path_home,
				rela_padre,
				tabla02_imagen,
				tabla02_tipo,
				tabla02_ayuda
			) 
			VALUES 
			(
				'$tabla02_nombre',
				$tabla02_orden,
				'$tabla02_path_home',
				NULL,
				'$tabla02_imagen',
				$tabla02_tipo,
				'$tabla02_ayuda'
			)";
	  	try { 
			$pdo->beginTransaction();
			$pdo->exec($sql);
			$new_id_tabla02 = $pdo->lastInsertId();
			$pdo->commit();
				return "1-M&oacute;dulo agregado correctamente correctamente";
			} catch (Exception $e) { //PDOException $e
			  $pdo->rollBack();
				return "0-Error: Se ha producido un error. ";
			}
}


function modificar_modulo($id_tabla02,$rela_padre,$tabla02_nombre,$tabla02_path_home,$tabla02_imagen,$tabla02_orden,$tabla02_ayuda,$tabla02_tipo,$pdo)
{

	if ($tabla02_nombre=="")
	{
		return "0-Error: Debe completar los campos obligatorios.";	
	}
	if ($rela_padre=="")
	{
		$rela_padre="NULL";
	}
	
	if ($tabla02_imagen!="")
	{
		$sql="UPDATE tabla_02_modulos  SET 
						rela_padre=$rela_padre, 
						tabla02_nombre='$tabla02_nombre',
						tabla02_orden=$tabla02_orden,
						tabla02_path_home='$tabla02_path_home',
						tabla02_ayuda='$tabla02_ayuda',
						tabla02_tipo=$tabla02_tipo,
						tabla02_imagen='$tabla02_imagen'
				where id_tabla02=$id_tabla02";
	}
	else
	{
		$sql="UPDATE tabla_02_modulos  SET 
						rela_padre=$rela_padre, 
						tabla02_nombre='$tabla02_nombre',
						tabla02_orden=$tabla02_orden,
						tabla02_path_home='$tabla02_path_home',
						tabla02_tipo=$tabla02_tipo,
						tabla02_ayuda='$tabla02_ayuda'
				where id_tabla02=$id_tabla02";
	}			
	try { 
		$pdo->beginTransaction();
		$pdo->exec($sql);
		$new_id_tabla02 = $pdo->lastInsertId();
		$pdo->commit();
			return "1-M&oacute;dulo Modificado correctamente correctamente";
		} catch (Exception $e) { //PDOException $e
		  $pdo->rollBack();
			return "0-Error: Se ha producido un error. ";
		}
}


function borrar_modulo($id_tabla02,$pdo)
{
		$sql="DELETE FROM tabla_02_modulos  WHERE id_tabla02=$id_tabla02";		
	  	try { 
		$pdo->beginTransaction();
		$pdo->exec($sql);
		$new_id_tabla02 = $pdo->lastInsertId();
		$pdo->commit();
			return "1-M&oacute;dulo eliminado correctamente correctamente";
		} catch (Exception $e) { //PDOException $e
		  $pdo->rollBack();
			return "0-Error: Se ha producido un error. ";
		}
}

?>