<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"main"		=> "ver_usuarios.html",
	"un"		=> "un_usuario.html",
	"no"	=> "no_usuarios.html",

	));
//Configuración Inicial
$titulo="Listado de Usuarios";
$t->set_var("titulo",$titulo);
$id_tablamodulo=$_POST["id_tablamodulo"];
//


$offset=$_POST["offset"];
$habilitado = array('0' => '<img src="media/iconos/no-habilitado.png" alt="No Habilitado" width="12">',
					'1' => '<img src="media/iconos/habilitado.png" alt="Habilitado" width="12">',
					'' => '<img src="media/iconos/no-habilitado.png" alt="No Habilitado" width="12">'); 
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


$sql="select * from tabla_01_usuarios  
		order by tabla01_usuario ASC  
		Limit $totalporpag OFFSET $ini  ";

//echo $sql;
$result = mysql_query($sql,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{
	while ($row = mysql_fetch_assoc($result))
	{
		$id_tabla01=$row["id_tabla01"];

		$t->set_var("tabla01_usuario",$row["tabla01_usuario"]);
		$t->set_var("tabla01_mail",$row["tabla01_mail"]);
		$t->set_var("tabla01_nombre",$row["tabla01_nombre"]);
		$t->set_var("tabla01_activo",$habilitado[$row["tabla01_activo"]]);

		$t->set_var("tabla01_espreventista",$habilitado[$row["tabla01_espreventista"]]);
		if ($row["tabla16_razon_social"]!="")
		{
		$t->set_var("tabla16_razon_social",htmlentities($row["tabla16_razon_social"], ENT_QUOTES));
		}else{
		$t->set_var("tabla16_razon_social","<strong>Sin Sucursal</strong>");
		}
		$url="'modulos/usuarios/php/ver_usuario_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'id_tablamodulo=$id_tablamodulo&id_tabla01=$id_tabla01'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	

		$url="'modulos/usuarios/php/abm_usuarios_interfaz.php'";
		$vars="'nombre_funcion=borrar_usuario&";
		$vars.="id_tabla01=$id_tabla01'";
		$url_exito="'modulos/usuarios/php/ver_usuarios.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
		$msg="'Esta seguro que quiere eliminar el usuario?'";
		$t->set_var("funcion_borrar","eliminar_mostrar($url,$vars,$url_exito,$id,$vars_exito,$msg);");


		//Perfiles
		$url_w="'modulos/usuarios/php/ver_usuario_perfil.php'";
		$id_w="'popup'";
		$vars_w="'id_tabla01=$id_tabla01'";
		$t->set_var("ver_perfiles","cargar_post($url_w,$id_w,$vars_w)");

		$t->parse("LISTADO","un",true);
	}
}else{
	$t->set_var("LISTADO","<tr align='center' class='alt'><td colspan='7'>No se encuentran Usuarios. </td></tr>");	

}
	// New Paginador
	$qrT="select * from tabla_01_usuarios " ;
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
		$pag.="<td><a href=\"javascript:cargar_post('modulos/usuarios/php/ver_usuarios.php','tab-$id_tablamodulo','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/usuarios/php/ver_usuarios.php','tabs-$id_tablamodulo','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/usuarios/php/ver_usuarios.php','tabs-$id_tablamodulo','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
	
	$url="'modulos/usuarios/php/ver_usuario_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'id_tablamodulo=$id_tablamodulo'";
	
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	
	
	$t->pparse("OUT", "main");

?>


