<?php
include "../lib/link_mysql.php";
include "../php/funciones_comunes.php";

		//PARA LOS PADRES
		$qr="Select * from tabla_07_categorias 
			order by tabla07_nombre ASC";
		$result = mysql_query($qr,$link_mysql);
		$num_rows = mysql_num_rows($result);
		$i=1;
		while ($row = mysql_fetch_assoc($result))
		{
			$id_tabla07_hijo=$row["id_tabla07"];
			if ($i<10)
				$next_codigo="$i";	
			else
				$next_codigo=$i;	
					
			$tabla07_codigo_hijo=$next_codigo;
			$sql="UPDATE tabla_07_categorias SET 
					tabla07_codigo='$tabla07_codigo_hijo'		
					where id_tabla07=$id_tabla07_hijo";
		
			$result_update =mysql_query($sql,$link_mysql);
		   if (!$result_update>0) 
		   {
				return "0-Error: Se ha producido un error. ".mysql_error();
		   }else{
		  	 $cantidad++;
		   }
		   $i++;
	   }
		
	echo "Registros importados: $cantidad listo<br>";
?>