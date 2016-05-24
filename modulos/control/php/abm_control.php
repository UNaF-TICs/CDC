<?php
//session_start(); 

function agregar_control($tabla05_accion,
							$tabla05_operacion,$tabla05_mensaje,$tabla05_descripcion,$pdo)
{

	$sysform15_ip_visitante=getIp();
	$rela_tabla02=0;
	if ($_SESSION['id_tabla02']=="")
		$rela_tabla02=0;
	else
		$rela_tabla02=$_SESSION['id_tabla02'];
	
	if ($_SESSION['id_tabla01']=="")
		$rela_tabla01=0;
	else
		$rela_tabla01=$_SESSION['id_tabla01'];
		
	$tabla05_fecha = date("Y-m-d"); 
	$tabla05_hora = date("H:i:s"); 

	$sql="INSERT INTO tabla_05_log
		(
			rela_tabla02,
			rela_tabla01,
			tabla05_fecha,
			tabla05_hora,
			tabla05_accion,
			tabla05_operacion,
			tabla05_mensaje,
			tabla05_descripcion
		) 
		VALUES 
		(
			$rela_tabla02,
			$rela_tabla01,
			'$tabla05_fecha',
			'$tabla05_hora',
			'$tabla05_accion',
			'$tabla05_operacion',
			'$tabla05_mensaje',
			'$tabla05_descripcion'
		)";
		
		$result = mysql_query($sql,$link_mysql);
   		//echo $sql;
	  try { 
		$pdo->beginTransaction();
		$pdo->exec($sql);
		$new_id_tabla02 = $pdo->lastInsertId();
		$pdo->commit();
			return "-Log Control agregado correctamente";
		} catch (Exception $e) { //PDOException $e
		  $pdo->rollBack();
			return "0-Error: Se ha producido un error. ";
		}
}

function getIp(){

      if( isset( $_SERVER ['HTTP_X_FORWARDED_FOR'] ) ){

      $ip = $_SERVER ['HTTP_X_FORWARDED_FOR'];

      }elseif( isset( $_SERVER ['HTTP_VIA'] ) ){

      $ip = $_SERVER ['HTTP_VIA'];

      }elseif( isset( $_SERVER ['REMOTE_ADDR'] ) ){

      $ip = $_SERVER ['REMOTE_ADDR'];

      }else{

      $ip = "Anonima" ;

      }

      return $ip;

}


?>


