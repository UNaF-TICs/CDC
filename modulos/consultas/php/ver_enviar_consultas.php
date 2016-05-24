<?php
include "../../../lib/template.inc";
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"main"		=> "ver_enviar_consultas.html",
	));

$tit="Enviar Consulta al Administrador del Sistema";
$t->set_var("tit",$tit);
$email=$_POST["email"];
$asunto=$_POST["asunto"];
$mensaje=$_POST["mensaje"];
if ($email!="")
{
 	$message = "Consulta Enviada del Sistema de Trazabilidad en Proyectos de Software\n";
	$message .= "URL: http://trazabilidad.nixiweb.com\n";
    $message .= "Email: " . $email . "\n";
	$message .= "Asunto: " . $asunto . "\n";
    $message .= "Mensaje: " . $mensaje . "\n"; 
	$emailTitle = 'Tiene un Mensaje del Sistema de Trazabilidad en Proyectos de Software';
	mail('mafferraro@hotmail.com', $emailTitle, $message, 'From: ' . $nombre . ' <' . $email . '>');
	mail('afv0185@hotmail.com', $emailTitle, $message, 'From: ' . $nombre . ' <' . $email . '>');
}
$t->pparse("OUT", "main");
?>