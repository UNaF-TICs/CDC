<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
require "../../../php/funciones_comunes.php";
header("Content-Type: text/html; charset=iso-8859-1");
//Configuración Inicial
$nombreyapellido = trim($_POST["term"]);
$rela_tabla08= trim($_POST["rela_tabla08"]); 
if (!$nombreyapellido) return;
if (!$rela_tabla08) return;
$items = array();
$return_arr = array();

$sql="select *
from tabla_07_personas
inner join  tabla_09_pers_disciplinas  on rela_tabla07=id_tabla07
where (tabla07_apellido LIKE '%$nombreyapellido%' or tabla07_nombre LIKE '%$nombreyapellido%') and $rela_tabla08=rela_tabla08";
$result_qr = mysql_query($sql,$link_mysql);
$num_rows = mysql_num_rows($result_qr);
if ($num_rows>0)
{
	while ($row = mysql_fetch_assoc($result_qr))
	{
		$row_array['value'] = trim($row['tabla07_dni']);
		$row_array['label'] = trim($row['tabla07_apellido'])." ".trim($row['tabla07_nombre']);
		$row_array['rela_tabla07'] = $row['rela_tabla07'];
		array_push($return_arr,$row_array);

	}
}
//header('Content-type: text/plain');
echo json_encode($return_arr);

?>