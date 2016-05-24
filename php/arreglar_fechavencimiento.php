<?php
include "../lib/link_mysql.php";
include "funciones_comunes.php";

	$sql="Select * from tabla_15_prestamos";
 	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		while ($row = mysql_fetch_assoc($result))
		{
			$id_tabla15=$row["id_tabla15"];
			$tabla15_fecha=$row["tabla15_fecha"];
			$tabla15_fechavec=$row["tabla15_fechavec"];
			//echo $tabla15_fechavec;
			if ($tabla15_fechavec=="0000-00-00")
			{
					$fecha_formateada=formatear_fecha($tabla15_fecha);
					list($dia,$mes,$anyo) = explode("-",$fecha_formateada); 
					if($dia<22)
					{
						$tabla15_fechavec= date('Y-m-d', strtotime("$tabla15_fecha + 1 month")) ;
						//$tabla15_fechavec=formatear_fecha($tabla15_fechavec);
					}else{
						$fecha_2mese= date('Y-m-d', strtotime("$tabla15_fecha + 2 month")) ;
						$fecha_formateada2=formatear_fecha($fecha_2mese);
						list($dia,$mes,$anyo) = explode("-",$fecha_formateada2);
						$tabla15_fechavec=$anyo."-".$mes."-10";
					}
					$sql2="UPDATE tabla_15_prestamos SET 
					tabla15_fechavec='$tabla15_fechavec'
					where id_tabla15=$id_tabla15";
					echo $sql2."<br>";
				   $result2 = mysql_query($sql2,$link_mysql);
				   if (!$result2>0) 
				   {
						return "0-Error: Se ha producido un error.  $sql ".mysql_error();
				   }
				   else
				   {
						 $cantidad++;
						echo  "$id_tabla15- Interes Punitorio agregado correctamente<br>";
				   }			
			}

	   }
	}
echo "Registros importados: $cantidad<br>";
?>