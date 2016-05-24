<?php
/*busco la ultima imagen creada*/
session_start();
$tipo = substr($_FILES['tabla02_imagen']['type'], 0, 5);
$dir = 'tmp/';

if (isset($_FILES['tabla02_imagen']['tmp_name'])) 
{
	//if (!copy($_FILES['file']['tmp_name'], $dir.$_FILES['file']['name']))
	if (!copy($_FILES['tabla02_imagen']['tmp_name'], $dir.session_id().'_'.$_FILES['tabla02_imagen']['name']))
	{
		$_SESSION['session_tabla02_imagen'] = "";
		echo '<script> parent.resultado_carga_archivos_csv("Error");</script>';
	}
	else 
	{
		$_SESSION['session_tabla02_imagen'] = $dir.session_id().'_'.$_FILES['tabla02_imagen']['name'];
		echo '<script> parent.resultado_carga_archivos_csv("Ok");</script>';
	}			
}
else 
{
	$_SESSION['session_tabla02_imagen'] = "";
	echo '<script> parent.resultado_carga_archivos_csv("Error");</script>';
}
?>