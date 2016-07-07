<?php
require "../../../php/check.php";
require "../../../php/funciones_comunes.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"main"		=> "ver_control.html",
	"un"		=> "un_control.html",
	"no"		=> "no_control.html",

	));


$offset=$_POST["offset"];

$es_buscar=$_POST["es_buscar"];
$id_tabla01_buscar=$_POST["id_tabla01_buscar"];
$id_tabla02_buscar=$_POST["id_tabla02_buscar"];
$texto=$_POST["texto"];
$fecha_desde=$_POST["fecha_desde"];
$fecha_hasta=$_POST["fecha_hasta"];

// New Paginador
$totalporpag=10;
if(!$offset){ 
	$off=0;$offset=1;
}
else{
    $off=($offset-1);
}
$ini=$off*$totalporpag;
// End New	

if ($es_buscar!="")
{
	if ($id_tabla01_buscar!="")
	{
		$where=" rela_tabla01=$id_tabla01_buscar";
	}

	if ($id_tabla02_buscar!="")
	{
		if ($where=="")
		{
			$where.=" rela_tabla02=$id_tabla02_buscar ";
		}
		else
		{
			$where.=" AND rela_tabla02 =$id_tabla02_buscar ";
		}
	}

	if ($texto!="")
	{
		if ($where=="")
		{
			$where.=" tabla05_mensaje LIKE '%$texto%' or tabla05_operacion LIKE '%$texto%' or tabla05_descripcion LIKE '%$texto%' ";
		}
		else
		{
			$where.=" AND tabla05_mensaje LIKE '%$texto%' or tabla05_operacion LIKE '%$texto%' or tabla05_descripcion LIKE '%$texto%'";
		}
	}

	if ($fecha_desde!="")
	{
		if ($where=="")
		{
			$where.=" tabla05_fecha >= '$fecha_desde' ";
		}
		else
		{
			$where.=" AND tabla05_fecha >= '$fecha_desde'";
		}
	}

	if ($fecha_hasta!="")
	{
		if ($where=="")
		{
			$where.=" tabla05_fecha <= '$fecha_hasta' ";
		}
		else
		{
			$where.=" AND tabla05_fecha <= '$fecha_hasta' ";
		}
	}


	if ($where!="")
	{
		$where=" where $where ";
		
	}
	$_SESSION['where_control']=$where;

}
else
{
	$where=$_SESSION['where_control'];
	$_SESSION['where_control']="";
}



$sql="select * from tabla_05_log 
		left outer join tabla_01_usuarios on id_tabla01=rela_tabla01
		left outer join tabla_02_modulos on id_tabla02=rela_tabla02 
		$where
		order by tabla05_fecha DESC, tabla05_hora DESC
		Limit $totalporpag OFFSET $ini  ";
$result = mysql_query($sql,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{

	while ($row = mysql_fetch_assoc($result))
	{
		$id_tabla05=$row["id_tabla05"];
		$t->set_var("tabla05_fecha",ver_fecha($row["tabla05_fecha"]));
		$t->set_var("tabla05_hora",substr($row["tabla05_hora"],0,8));
		
		//tengo que poner el usuario y el modulo
		
		$t->set_var("tabla02_nombre",$row["tabla02_nombre"]);
		$t->set_var("tabla01_nombre",$row["tabla01_nombre"]);

		$t->set_var("tabla05_accion",$row["tabla05_accion"]);
		$t->set_var("tabla05_operacion",$row["tabla05_operacion"]);
		$t->set_var("tabla05_mensaje",$row["tabla05_mensaje"]);

		//perfiles
		
		$url="\"modulos/control/php/ver_reporte.php\"";
		$id="\"popup\"";
		$vars="\"id_tabla05=$id_tabla05\"";
		$t->set_var("funcion_reporte","cargar_post($url,$id,$vars)");	
		$t->set_var("icono_reporte","buscar.png");

		$t->parse("LISTADO","un",true);
	}

	// New Paginador
	$qrT="select * from tabla_05_log 
		left outer join tabla_01_usuarios on id_tabla01=rela_tabla01
		left outer join tabla_02_modulos on id_tabla02=rela_tabla02 
		$where  " ;
	$result = mysql_query($qrT,$link_mysql);
	$totalregistros = mysql_num_rows($result);
	$t->set_var("cantidad",$totalregistros);
	$totalpaginas=$totalregistros/$totalporpag;
	$test=explode("\.",$totalpaginas);
	if($test[1])
	{
		$totalpaginas=$test[0]+1;
	}
	// << Anterior
	if($offset>1)
	{
		$pag.="<td><a href=\"javascript:cargar_post('modulos/control/php/ver_control.php','listado','offset=$off');\"><< Anterior</a> | </td>";
	}
	else
	{
		$pag.="<td></td>";
	}
						 
	// Numeros
	if($totalpaginas>15)
	{
		$faltan=($totalpaginas-$off);
		if($faltan<15)
		{
			$ter=$totalpaginas;
			$com=$off -(15-($totalpaginas-$off));
		}
		elseif($off<8)
		{
			$ter=15;
			$com=1;
		}
		else
		{
			$ter=$off+7;
			$com=$off-7;
		}
	}
	else
	{
		$com=1;
		$ter=$totalpaginas;
	}
		  
	$pag.="<td align='center'>";
	for($i=$com;$i<=$ter;$i++)
	{
		if($i==$offset)
		{
			$pag.="<font color=#000000><b>$i</b></font>&nbsp;";
		}
		else
		{
			$pag.="<a href=\"javascript:cargar_post('modulos/control/php/ver_control.php','listado','offset=$i');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/control/php/ver_control.php','listado','offset=$ofs');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
	
	
	$t->pparse("OUT", "main");
}
else
{
	$t->set_var("funcion_cerrar","cargar_get('modulos/login/php/cargar_modulos.php','content');");	
	$t->pparse("OUT", "no");


}
?>




