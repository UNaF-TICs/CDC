<?php
include "../lib/link_mysql.php";
echo "Inicio <br>";
exit;
set_time_limit(0);
ob_implicit_flush();

$archivo_import='articulos.csv';
$lineas = file($archivo_import);
$cantidad=0;
foreach ($lineas as $linea_num => $linea) 
{
	//echo  $linea."<br><br><br>";
	$datos=explode(";",$linea);
	$tabla07_nombre=trim($datos[0]); 	
			
	$sql="INSERT INTO tabla_07_categorias (
				tabla07_nombre,
				tabla07_visible
	) VALUES (
				'$tabla07_nombre',
				1			
	)";

	$result = mysql_query($sql,$link_mysql);
	if (!$result>0) 
	{
		//echo "0-Error: Se ha producido un error. $sql ".mysql_error();
	}
	else
	{
		$cantidad++;
		echo "Categoria agregada correctamente: ".$tabla07_nombre."<br>";
	}
	
}
echo "Registros importados: $cantidad";
?>