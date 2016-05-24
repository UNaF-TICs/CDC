<?php
include "../lib/link_mysql.php";
include "../php/funciones_comunes.php";
exit;
	$sql="Select * from tabla_15_prestamos
	inner join tabla_14_det_montos on id_tabla14=rela_tabla14
	inner join tabla_16_cab_montos  on id_tabla16=rela_tabla16";
 	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		while ($row = mysql_fetch_assoc($result))
		{
			$id_tabla15=$row["id_tabla15"];
			$tabla15_montocuotas=floatval($row["tabla15_montocuotas"]);
			$tabla15_montototal=floatval($row["tabla15_montototal"]);
			$tabla15_interes=floatval($row["tabla15_interes"]);
			$tabla15_gastos=floatval($row["tabla15_gastos"]);
			$tabla15_iva=floatval($row["tabla15_iva"]);
			$capital=floatval($row["tabla16_monto"]);
			$cantidad_cuotas=$row["tabla14_cuota"];
			
					$tabla15_montointereses=($capital*$cantidad_cuotas*$tabla15_interes)/100;
					$tabla15_montogastos=($capital*$cantidad_cuotas*$tabla15_gastos)/100;
					$tabla15_montoiva=($tabla15_montointereses + $tabla15_montogastos)*($tabla15_iva / 100);
					$tabla15_montogastos=$tabla15_montototal-($capital+$tabla15_montointereses+$tabla15_montoiva);
					$tabla15_capital_xcuota=$capital/$cantidad_cuotas;
					$tabla15_interes_xcuota=$tabla15_montointereses/$cantidad_cuotas;
					$tabla15_iva_xcuota=$tabla15_montoiva/$cantidad_cuotas;
					$tabla15_gasto_xcuota=$tabla15_montocuotas-($tabla15_capital_xcuota+$tabla15_interes_xcuota+$tabla15_iva_xcuota);
				
					$sql2="UPDATE tabla_15_prestamos SET 
					tabla15_montointereses=$tabla15_montointereses,
					tabla15_montogastos=$tabla15_montogastos,
					tabla15_montoiva=$tabla15_montoiva,
					tabla15_capital_xcuota=$tabla15_capital_xcuota,
					tabla15_interes_xcuota=$tabla15_interes_xcuota,
					tabla15_gasto_xcuota=$tabla15_gasto_xcuota,
					tabla15_iva_xcuota=$tabla15_iva_xcuota
					where id_tabla15=$id_tabla15";
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
echo "Registros importados: $cantidad<br>";
?>