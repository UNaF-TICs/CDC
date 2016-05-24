<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"main"		=> "ver_modulos.html",
	"un"		=> "un_modulo.html",
	"no"		=> "no_modulos.html",

	));
//Configuración Inicial
$titulo="Listado de M&oacute;dulos";
$t->set_var("titulo",$titulo);
$id_tablamodulo=$_POST["id_tablamodulo"];
//
if (isset($_POST['offset'])) {
$offset=$_POST["offset"];
} else {
$offset = "";
}
$habilitado = array('0' => 'NO','1' => 'SI'); 
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




//echo $sql;
$rs = $pdo->query("select * from tabla_02_modulos 
		order by tabla02_orden ASC  
		Limit $totalporpag OFFSET $ini ");//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla02=$row["id_tabla02"];
		$rela_padre=$row["rela_padre"];
		
		if ($rela_padre!="")
		{
			$rs2 = $pdo->query("select * from tabla_02_modulos 
					where id_tabla02=$rela_padre");//
			$num_rows2 = $rs2->rowCount();
			if ($num_rows2>0)
			{
				$row_padre = $rs2 ->fetch();
				$tabla02_nombre_padre=htmlentities($row_padre["tabla02_nombre"],ENT_QUOTES);
				$t->set_var("tabla02_nombre_padre",$tabla02_nombre_padre);
			}
			else
			{
				$t->set_var("tabla02_nombre_padre");
			}		
		}
		else
		{
			$t->set_var("tabla02_nombre_padre", "<strong>No Posee Contenedor</strong>");
		
		}
		
		$t->set_var("tabla02_nombre",htmlentities($row["tabla02_nombre"],ENT_QUOTES));
		$t->set_var("tabla02_path_home",$row["tabla02_path_home"]);
		$tabla02_imagen=$row["tabla02_imagen"];
		if ($tabla02_imagen!="")
		{
			$t->set_var("tabla02_imagen","media/iconos/".$row["tabla02_imagen"]);
		}
		else
		{
			$t->set_var("tabla02_imagen","media/iconos/modulo.png");
		}

		$url="'modulos/modulos/php/ver_modulos_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'id_tablamodulo=$id_tablamodulo&id_tabla02=$id_tabla02'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	

		$url="'modulos/modulos/php/abm_modulos_interfaz.php'";
		$vars="'nombre_funcion=borrar_modulo&";
		$vars.="id_tabla02=$id_tabla02'";
		$url_exito="'modulos/modulos/php/ver_modulos.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
		$msg="'Esta seguro que quiere eliminar el m&oacute;dulo?'";
		$t->set_var("funcion_borrar","eliminar_mostrar($url,$vars,$url_exito,$id,$vars_exito,$msg);");

		$t->parse("LISTADO","un",true);
	}

	// New Paginador
	$rs = $pdo->query("select * from tabla_02_modulos");//
	$totalregistros = $rs->rowCount();
	$t->set_var("cantidad",$totalregistros);
	$totalpaginas=$totalregistros/$totalporpag;
	$test=split("\.",$totalpaginas);
	if($test[1])
	{
		$totalpaginas=$test[0]+1;
	}
	// << Anterior
	$pag='';
	if($offset>1)
	{
		$pag.="<td><a href=\"javascript:cargar_post('modulos/modulos/php/ver_modulos.php','tabs-$id_tablamodulo','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/modulos/php/ver_modulos.php','tabs-$id_tablamodulo','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/modulos/php/ver_modulos.php','tabs-$id_tablamodulo','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
	
	$url="'modulos/modulos/php/ver_modulos_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'id_tablamodulo=$id_tablamodulo'";
	
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars)");
	$t->set_var("icono_agregar","icon-plus.gif");	
	
	
	$t->pparse("OUT", "main");
}
else
{
	$url="'modulos/modulos/php/ver_modulos_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'id_tablamodulo=$id_tablamodulo'";
	
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars)");
	$t->set_var("icono_agregar","icon-plus.gif");	

	$t->pparse("OUT", "no");

}
?>


