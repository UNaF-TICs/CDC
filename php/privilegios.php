<?php
//Recupera todos los perfiles del usario que estan relacionado con el modulo en cuestion

function recuperar_perfiles_con_modulo($id_tabla01,$id_tabla02,$link_mysql)	
{
	if ($id_tabla01=='1')
	{
		$accesos["alta"]=1;
		$accesos["baja"]=1;
		$accesos["modificacion"]=1;
		$accesos["reporte"]=1;

	}
	else
	{
		$accesos["alta"]=0;
		$accesos["baja"]=0;
		$accesos["modificacion"]=0;
		$accesos["reporte"]=0;
	}
	
	$sql="Select * from tabla_04_det_perfiles
	inner join tabla_06_det_usuarios_perfiles on tabla_06_det_usuarios_perfiles.rela_tabla03=tabla_04_det_perfiles.rela_tabla03 
	 where rela_tabla01=$id_tabla01 and rela_tabla02=$id_tabla02";

	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		//pongo el titulo del modulo
		while ($row = mysql_fetch_assoc($result))
		{
			$id_syscont01=$row["id_syscont01"];
			if ($accesos["alta"]<>1)
				$accesos["alta"]=$row["tabla04_alta"];
				
			if ($accesos["baja"]<>1)			
				$accesos["baja"]=$row["tabla04_baja"];
				
			if ($accesos["modificacion"]<>1)		
				$accesos["modificacion"]=$row["tabla04_modificacion"];

			if ($accesos["reporte"]<>1)		
				$accesos["reporte"]=$row["tabla04_reporte"];
		} 
	}	
	return $accesos;
}

?>