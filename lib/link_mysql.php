<?php 
header("Content-type: text/html; charset=utf-8");
        //session_start(); 


$scon = "mysql:dbname=sistema_cuaderno_campo;host=127.0.0.1";
$suser ='root';
$spass = '';
$msg='';
 
/*
Los posibles valores que se le podr�a asignar a ATTR_ERRMODE son:

PDO::ERRMODE_SILENT es el valor por defecto y como he mencionado antes no lanza ning�n tipo de error ni excepci�n, 
	es tarea del programador comprobar si ha ocurrido alg�n error despu�s de cada operaci�n con la base de datos.
PDO::ERRMODE_WARNING genera un error E_WARNING de PHP si ocurre alg�n error. Este error es el mismo que se muestra 
	usando la API de mysql mostrando por pantalla una descripci�n del error que ha ocurrido.
PDO::ERRMODE_EXCEPTION es el que acabamos de explicar que genera y lanza una excepci�n si ocurre alg�n tipo de error.
*/

try {
	$pdo = new PDO("mysql:dbname=sistema_cuaderno_campo;host=127.0.0.1",$suser,$spass,array(PDO::ATTR_PERSISTENT => true,
														PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$msg='conexion_ok';  
} catch (PDOException $e) {
	$msg='conexion_cancel: '.$e->getMessage();
	//echo "Error al conectar a la base de datos. ".$e->getMessage();	
}

?>

