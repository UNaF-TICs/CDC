<?php
include "../lib/link_mysql.php";
include "../php/funciones_comunes.php";
	exit;
	$sql="Select * from tabla_15_prestamos
	inner join tabla_14_det_montos on id_tabla14=rela_tabla14";
 	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		while ($row = mysql_fetch_assoc($result))
		{
			$id_tabla15=$row["id_tabla15"];
			$tabla14_interespunitorio=$row["tabla14_interespunitorio"];
				$sql2="UPDATE tabla_15_prestamos SET 
				tabla15_interespunitorios=$tabla14_interespunitorio		
				where id_tabla15=$id_tabla15";
	
			$result2 = mysql_query($sql2,$link_mysql);
		   if (!$result2>0) 
		   {
				return "0-Error: Se ha producido un error.  $sql ".mysql_error();
		   }
		   else
		   {
				 $cantidad++;
				echo  "$id_tabla15- Interes Punitorio agregado correctamente";
				
		   }
	   }
	}
echo "Registros importados: $cantidad";
?>