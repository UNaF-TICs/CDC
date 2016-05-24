<?php
session_start();
include "lib/template.inc";
include "lib/link_mysql.php";
header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

ini_set("session.cache_expire",30);
ini_set("session.gc_maxlifetime",9000);



$t = new Template('./');
//Archivos comunes
$t->set_file(array(
	"ver_home"	=> "home.html",
));
//echo "Hola MUndo";


$JS="";
//Plugin
$JS.='<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>';
$JS.='<script type="text/javascript" src="js/jquery-ui-1.8.5.custom.min.js"></script>';
$JS.='<script type="text/javascript" src="js/jquery.scrollabletab.js"></script>'; 
$JS.='<script type="text/javascript" src="js/jquery.layout.js"></script>';
$JS.='<script type="text/javascript" src="js/ajax.js"></script>';
$JS.='<script src="js/jquery.validate.js" type="text/javascript"></script>';

$JS.='<script type="text/javascript" src="js/funciones.js"></script>';

$JS.='<script type="text/javascript" src="js/config.js"></script>';
$JS.='<script type="text/javascript" src="js/ui.dialogr.js"></script>'; 
$JS.='<script type="text/javascript" src="js/jquery.blockUI.js"></script>'; 
$JS.='<script type="text/javascript" src="js/jquery.alphanumeric.pack.js"></script>'; 
/*/$JS.='<script type="text/javascript" src="js/jquery.treeTable.js"></script>';*/ 
//Sistemas
$JS.='<script type="text/javascript" src="modulos/consultas/scripts/consultas.js"></script>'; 


$t->set_var("JS",$JS);

$CSS="";
/*$CSS.='<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" >';*/
$CSS.='<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" >';
$CSS.='<link rel="stylesheet" type="text/css" href="css/jquery.ui.core.css"/>';
$CSS.='<link rel="stylesheet" type="text/css" href="css/jquery.ui.datepicker.css"/>';
$CSS.='<link rel="stylesheet" type="text/css" href="css/jquery.dialogr.css"/>';
$CSS.='<link rel="stylesheet" type="text/css" href="css/style.css" >';
/*CSS.='<link rel="stylesheet" type="text/css" href="css/jquery.treeTable.css" >';*/

$t->set_var("CSS",$CSS);

$t->set_var("titulo","Cuaderno de Campo - Sistema Administrador");
if (isset($_SESSION['id_tabla01']))
{
$rs = $pdo->query("select * from tabla_01_usuarios 
			where id_tabla01=".$_SESSION['id_tabla01']);//
	$row = $rs->fetch();
	$num_rows = $rs->rowCount();
	if ($num_rows>0) 
	{
		$t->set_var("tabla01_nombre",$row["tabla01_nombre"]);
		//echo $row["tabla01_nombre"];
	}
	$t->set_var("inicio","menu");
	$t->set_var("estilo_body","");
}else{
	$t->set_var("inicio","login");
	$t->set_var("estilo_body","none"); 
}

$t->pparse("OUT", "ver_home");		

?>