<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
session_start();
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_perfil_modulo.html",
	"un"		=> "un_perfil_modulo.html",

	));
$titulo="Listado de Módulos";
$id_tabla03=$_POST["id_tabla03"]; 
$offset=$_POST["offset"];
$estado = array('0' => 'NO','1' => 'SI','' => 'NO'); 
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


$sql="select * from tabla_04_det_perfiles inner join tabla_02_modulos on rela_tabla02=id_tabla02 
		where rela_tabla03=$id_tabla03 
		order by tabla02_nombre ASC
		Limit $totalporpag OFFSET $ini  ";
$result = mysql_query($sql,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{

	while ($row = mysql_fetch_assoc($result))
	{
		$rela_tabla03=$row["rela_tabla03"];
		$id_tabla04=$row["id_tabla04"];
		$t->set_var("tabla02_nombre",htmlentities($row["tabla02_nombre"], ENT_QUOTES));
		$t->set_var("tabla04_alta",$estado[$row["tabla04_alta"]]);
		$t->set_var("tabla04_baja",$estado[$row["tabla04_baja"]]);
		$t->set_var("tabla04_modificacion",$estado[$row["tabla04_modificacion"]]);
		$t->set_var("tabla04_reporte",$estado[$row["tabla04_reporte"]]);


		$url="'modulos/perfiles/php/ver_perfil_modulo_abm.php'";
		$id="'popup'";
		$vars="'id_tabla04=$id_tabla04&rela_tabla03=$id_tabla03'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	

		$url="'modulos/perfiles/php/abm_perfiles_modulos_interfaz.php'";
		$vars="'nombre_funcion=borrar_perfil_modulo&";
		$vars.="id_tabla04=$id_tabla04'";
		$url_exito="'modulos/perfiles/php/ver_perfil_modulo.php'";
		$id="'popup'";
		$vars_exito="'offset=$offset&id_tabla03=$id_tabla03'";
		$msg="'Esta seguro que quiere eliminar el m&oacute;dulo del perfil?'";
		$t->set_var("funcion_borrar","eliminar_mostrar($url,$vars,$url_exito,$id,$vars_exito,$msg);");

		$t->parse("LISTADO","un",true);
	}
}else{
	$t->set_var("LISTADO","<tr align='center' class='alt'><td colspan='7'>No se encuentran M&oacute;dulos. </td></tr>");	

}
	// New Paginador
	$qrT="select * from tabla_04_det_perfiles inner join tabla_02_modulos on rela_tabla03=id_tabla02 
		where rela_tabla03=$id_tabla03 ";
	//$qrT="Select * from $tbl_noticias $where";
	$result = mysql_query($qrT,$link_mysql);
	$totalregistros = mysql_num_rows($result);
	$t->set_var("cantidad",$totalregistros);
	$totalpaginas=$totalregistros/$totalporpag;
	$test=split("\.",$totalpaginas);
	if($test[1])
	{
		$totalpaginas=$test[0]+1;
	}
	// << Anterior
	if($offset>1)
	{
		$pag.="<td><a href=\"javascript:cargar_post('modulos/perfiles/php/ver_perfil_modulo.php','detalle_modulo','offset=$off&id_tabla03=$id_tabla03');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/perfiles/php/ver_perfil_modulo.php','popup','offset=$i&id_tabla03=$id_tabla03');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/perfiles/php/ver_perfil_modulo.php','popup','offset=$ofs&id_tabla03=$id_tabla03');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
	
	$url="'modulos/perfiles/php/ver_perfil_modulo_abm.php'";
	$id="'popup'";
	$vars="'rela_tabla03=$id_tabla03'";
	
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars)");
	$t->set_var("icono_agregar","icon-plus.gif");	
	$t->set_var("funcion_cerrar","cargar_get('modulos/login/php/cargar_modulos.php','popup');");	
	
	
	$t->pparse("OUT", "ver");

?>