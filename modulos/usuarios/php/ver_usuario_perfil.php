<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_usuarios_perfil.html",
	"un"		=> "un_usuario_perfil.html",

	));

$id_tabla01=$_POST["id_tabla01"]; 

$offset=$_POST["offset"];
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

$sql="select * from tabla_01_usuarios where id_tabla01=$id_tabla01";

$result = mysql_query($sql,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{
	$row = mysql_fetch_assoc($result);
	$t->set_var("tabla01_usuario",$row["tabla01_usuario"]);
	$t->set_var("tabla01_nombre",$row["tabla01_nombre"]);
}
else
{
	$t->set_var("tabla01_usuario","");
	$t->set_var("tabla01_nombre","");
}


$sql="select * from tabla_03_perfiles
	  inner join tabla_06_det_usuarios_perfiles on id_tabla03=rela_tabla03 
		where rela_tabla01=$id_tabla01 
		order by tabla03_nombre ASC
		Limit $totalporpag OFFSET $ini  ";
$result = mysql_query($sql,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{

	while ($row = mysql_fetch_assoc($result))
	{
		$id_tabla06=$row["id_tabla06"];
		$t->set_var("tabla03_nombre",$row["tabla03_nombre"]);


		$url="'modulos/usuarios/php/ver_usuario_perfil_abm.php'";
		$id="'popup'";
		$vars="'id_tabla06=$id_tabla06&rela_tabla01=$id_tabla01'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	

		$url="'modulos/usuarios/php/abm_usuarios_perfiles_interfaz.php'";
		$vars="'nombre_funcion=borrar_usuario_perfil&";
		$vars.="id_tabla06=$id_tabla06'";
		$url_exito="'modulos/usuarios/php/ver_usuario_perfil.php'";
		$id="'popup'";
		$vars_exito="'offset=$offset&id_tabla01=$id_tabla01'";
		$msg="'Esta seguro que quiere eliminar el perfil?'";
		$t->set_var("funcion_borrar","eliminar_mostrar($url,$vars,$url_exito,$id,$vars_exito,$msg);");

		$t->parse("LISTADO","un",true);
	}
}else{
	$t->set_var("LISTADO","<tr align='center'><td colspan='2'>No se encuentran Perfiles. </td></tr>");
}
	// New Paginador
	$qrT="select * from tabla_03_perfiles
	  inner join tabla_06_det_usuarios_perfiles on id_tabla03=rela_tabla03 
		where rela_tabla01=$id_tabla01  " ;
	$result = mysql_query($sql,$link_mysql);
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
		$pag.="<td><a href=\"javascript:cargar_post('modulos/usuarios/php/ver_usuario_perfil.php','popup','offset=$off');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/usuarios/php/ver_usuario_perfil.php','popup','offset=$i');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/usuarios/php/ver_usuario_perfil.php','popup','offset=$ofs');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
	
	$url="'modulos/usuarios/php/ver_usuario_perfil_abm.php'";
	$id="'popup'";
	$vars="'rela_tabla01=$id_tabla01'";
	
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars)");
	$t->set_var("icono_agregar","icon-plus.gif");	
	
	
	$t->pparse("OUT", "ver");


?>