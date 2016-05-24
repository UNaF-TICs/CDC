<?php
session_start();
include "../../../lib/template.inc";
include "../../../lib/link_mysql.php";
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"				=> "ver_modulos.html",
	"un_contenedor"		=> "un_contenedor.html",
	"un_submenu"		=> "un_submenu.html",
	
	));
	
if ($_SESSION['id_tabla01']=="1")
{
	
	$sql="select * from tabla_02_modulos 
	where tabla02_tipo=1
	order by tabla02_orden ASC";
	$no_root=1;
}
else
{
	/*$sql="SELECT * FROM (tabla_02_modulos 
				inner join tabla_04_det_perfiles on id_tabla02=rela_tabla02) 
				inner join tabla_06_det_usuarios_perfiles on tabla_06_det_usuarios_perfiles.rela_tabla03=tabla_04_det_perfiles.rela_tabla03
				where tabla02_tipo=1 and rela_padre IS NOT NULL AND rela_tabla01=".$_SESSION['id_tabla01'];*/
	$sql="SELECT *
		FROM tabla_02_modulos
		WHERE id_tabla02
		IN (
		
		SELECT DISTINCT (
		rela_padre
		)
		FROM (
		tabla_02_modulos
		INNER JOIN tabla_04_det_perfiles ON id_tabla02 = rela_tabla02
		)
		INNER JOIN tabla_06_det_usuarios_perfiles ON tabla_06_det_usuarios_perfiles.rela_tabla03 = tabla_04_det_perfiles.rela_tabla03
		WHERE rela_padre IS NOT NULL
		AND rela_tabla01 =".$_SESSION['id_tabla01']."
		) order by tabla02_orden ASC";
		$no_root=0;
}

$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla02_contenedor=$row["id_tabla02"];
		$tabla02_nombre_contenedor=htmlentities($row["tabla02_nombre"],ENT_QUOTES);
		$t->set_var("tabla02_nombre_contenedor",$tabla02_nombre_contenedor);
		$t->set_var("SUB_MENUS","");
		if ($no_root==1)
		{
		$sql2="select * from tabla_02_modulos 
			where rela_padre=$id_tabla02_contenedor
			order by tabla02_orden ASC";
		}else{
		$sql2="SELECT * FROM (tabla_02_modulos 
				inner join tabla_04_det_perfiles on id_tabla02=rela_tabla02) 
				inner join tabla_06_det_usuarios_perfiles on tabla_06_det_usuarios_perfiles.rela_tabla03=tabla_04_det_perfiles.rela_tabla03
				where rela_padre=$id_tabla02_contenedor AND rela_tabla01=".$_SESSION['id_tabla01']."
				order by tabla02_orden ASC";
		
		}	
		$rs2 = $pdo->query($sql2);//
		$num_rows2 = $rs2->rowCount();
		if ($num_rows2>0)
		{
			while ($row2 = $rs2 ->fetch())
			{		
				$id_tabla02_contenedor=$row2["id_tabla02"];
				$tabla02_nombre_modulo=htmlentities($row2["tabla02_nombre"],ENT_QUOTES);
				$tabla02_path_home_modulo="modulos/".htmlentities($row2["tabla02_path_home"],ENT_QUOTES);
				$t->set_var("id_tabla02_contenedor",$id_tabla02_contenedor);
				$t->set_var("tabla02_nombre_modulo",$tabla02_nombre_modulo);
				$t->set_var("tabla02_path_home_modulo",$tabla02_path_home_modulo);
				if ($row2["tabla02_imagen"]=="")
				{
				$t->set_var("icono","modulo.png");
				}else{
				$t->set_var("icono",$row2["tabla02_imagen"]);
				}
				//
				$t->parse("SUB_MENUS","un_submenu",true);
			}
		}
		$t->parse("CONTENEDOR","un_contenedor",true);
	}
}else{
		$t->set_var("CONTENEDOR","<p>No hay M&oacute;dulos Cargados. Debe asignar un Perfil al Usuario.</p>");
}		
		
$t->pparse("OUT", "ver");
?>