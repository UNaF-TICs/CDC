<?php 
header("Content-type: text/html; charset=utf-8");
        //session_start(); 


$scon = "mysql:dbname=sistema_cuderno_campo;host=127.0.0.1";
$suser ='root';
$spass = '';
$msg='';
 
/*
Los posibles valores que se le podría asignar a ATTR_ERRMODE son:

PDO::ERRMODE_SILENT es el valor por defecto y como he mencionado antes no lanza ningún tipo de error ni excepción, 
	es tarea del programador comprobar si ha ocurrido algún error después de cada operación con la base de datos.
PDO::ERRMODE_WARNING genera un error E_WARNING de PHP si ocurre algún error. Este error es el mismo que se muestra 
	usando la API de mysql mostrando por pantalla una descripción del error que ha ocurrido.
PDO::ERRMODE_EXCEPTION es el que acabamos de explicar que genera y lanza una excepción si ocurre algún tipo de error.
*/

try {
	$pdo = new PDO("mysql:dbname=sistema_cuderno_campo;host=127.0.0.1",$suser,$spass,array(PDO::ATTR_PERSISTENT => true,
														PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$msg='conexion_ok';  
} catch (PDOException $e) {
	$msg='conexion_cancel: '.$e->getMessage();
	//echo "Error al conectar a la base de datos. ".$e->getMessage();	
}

?>

