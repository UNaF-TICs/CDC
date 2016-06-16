<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_perfiles.html",
	"un"		=> "un_perfil.html",

	));
$titulo="Listado de Perfiles";
$t->set_var("titulo",$titulo);
$id_tablamodulo=$_POST["id_tablamodulo"];

$offset=isset($_POST['offset']) ? intval($_POST['offset']) : NULL;

$habilitado = array('0' => 'No','1' => 'Si'); 
// New Paginador
$totalporpag=5;
if(!$offset){ 
	$off=0;$offset=1;
}
else{
    $off=($offset-1);
}
$ini=$off*$totalporpag;
// End New	


$sql="select * from tabla_03_perfiles 
		order by tabla03_nombre ASC
		Limit $totalporpag OFFSET $ini  ";
//echo $sql;
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla03=$row["id_tabla03"];
		$t->set_var("tabla03_nombre",$row["tabla03_nombre"]);

		$url="'modulos/perfiles/php/ver_perfil_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'id_tablamodulo=$id_tablamodulo&id_tabla03=$id_tabla03&offset=$offset'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	

		$url="'modulos/perfiles/php/abm_perfiles_interfaz.php'";
		$vars="'nombre_funcion=borrar_perfil&";
		$vars.="id_tabla03=$id_tabla03'";
		$url_exito="'modulos/perfiles/php/ver_perfiles.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars_exito="'id_tablamodulo=$id_tablamodulo&offset=$offset'";
		$msg="'Esta seguro que quiere eliminar el perfil?'";
		$t->set_var("funcion_borrar","eliminar_mostrar($url,$vars,$url_exito,$id,$vars_exito,$msg);");


		$url_hc="'modulos/perfiles/php/ver_perfil_modulo.php'";
		$id_hc="'popup'";
		$vars_hc="'id_tabla03=$id_tabla03'";
		$t->set_var("ver_modulos","cargar_post($url_hc,$id_hc,$vars_hc)");

		$t->parse("LISTADO","un",true);
	}
}else{
	$t->set_var("LISTADO","<tr align='center' class='alt'><td colspan='7'>No se encuentran Perfiles. </td></tr>");	

}
	// New Paginador
	$qrT="select * from tabla_03_perfiles 
		order by tabla03_nombre ASC" ;
	$rs = $pdo->query($qrT);//
	$totalregistros = $rs->rowCount();
	$t->set_var("cantidad",$totalregistros);
	$totalpaginas=$totalregistros/$totalporpag;
	$test=split("\.",$totalpaginas);
	if($test[1])
	{
		$totalpaginas=$test[0]+1;
	}
	$pag='';
	// << Anterior
	if($offset>1)
	{
		$pag.="<td><a href=\"javascript:cargar_post('modulos/perfiles/php/ver_perfiles.php','tabs-$id_tablamodulo','id_tablamodulo=$id_tablamodulo&offset=$off');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/perfiles/php/ver_perfiles.php','tabs-$id_tablamodulo','id_tablamodulo=$id_tablamodulo&offset=$i');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/perfiles/php/ver_perfiles.php','tabs-$id_tablamodulo','id_tablamodulo=$id_tablamodulo&offset=$ofs');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
	
	$url="'modulos/perfiles/php/ver_perfil_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'id_tablamodulo=$id_tablamodulo'";
	
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars)");
	$t->set_var("icono_agregar","icon-plus.gif");	
	$t->set_var("funcion_cerrar","cargar_get('modulos/login/php/cargar_modulos.php','tabs-$id_tablamodulo');");	
	
	
	$t->pparse("OUT", "ver");


?>