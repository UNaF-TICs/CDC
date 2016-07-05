<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		            => "ver_maquinaria_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla22=isset($_POST['id_tabla22']) ? intval($_POST['id_tabla22']) : NULL;
$offset=$_POST["offset"];
//$tabla22_imagen='';
//$tabla22_nombre='';

if ($id_tabla22!="")
{
	$sql="select * from tabla_22_maquinaria
	where id_tabla22=$id_tabla22";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla22=$row["id_tabla22"];
		//$tabla22_imagen=$row["tabla22_imagen"];
		//$tabla22_nombre=$row["tabla22_nombre"];
		//$t->set_var("tabla22_imagen",$row["tabla22_imagen"]);
		$t->set_var("tabla22_nombre",htmlentities($row["tabla22_nombre"],ENT_QUOTES));
		$t->set_var("tabla22_descripcion",$row["tabla22_descripcion"]);
		$t->set_var("tabla22_marca",htmlentities($row["tabla22_marca"],ENT_QUOTES));
		$t->set_var("tabla22_modelo",htmlentities($row["tabla22_modelo"],ENT_QUOTES));
		$t->set_var("tabla22_fecha_compra",ver_fecha($row["tabla22_fecha_compra"]));
		$t->set_var("tabla22_costo_compra",$row["tabla22_costo_compra"]);
		$t->set_var("tabla22_matricula",$row["tabla22_matricula"]);
        $t->set_var("tabla22_empresa_seguro",$row["tabla22_empresa_seguro"]);
        $t->set_var("tabla22_rto",$row["tabla22_rto"]);
        $t->set_var("tabla22_funcion",$row["tabla22_funcion"]);

	}


	$url="'modulos/maquinaria/php/abm_maquinaria_interfaz.php'";
	$vars="'nombre_funcion=modificar_maquinaria&";
	$vars.="id_tabla22=$id_tabla22&";
	//$vars.="tabla22_imagen='+abm_maquinaria.tabla22_imagen.value+'&";
	$vars.="tabla22_nombre='+abm_maquinaria.tabla22_nombre.value+'&";
    $vars.="tabla22_descripcion='+abm_maquinaria.tabla22_descripcion.value+'&";
	$vars.="tabla22_marca='+abm_maquinaria.tabla22_marca.value+'&";
    $vars.="tabla22_modelo='+abm_maquinaria.tabla22_modelo.value+'&";
	$vars.="tabla22_fecha_compra='+abm_maquinaria.tabla22_fecha_compra.value+'&";
	$vars.="tabla22_costo_compra='+abm_maquinaria.tabla22_costo_compra.value+'&";
	$vars.="tabla22_matricula='+abm_maquinaria.tabla22_matricula.value+'&";
	$vars.="tabla22_empresa_seguro='+abm_maquinaria.tabla22_empresa_seguro.value+'&";
    $vars.="tabla22_rto='+abm_maquinaria.tabla22_rto.value+'&";
    $vars.="tabla22_funcion='+abm_maquinaria.tabla22_funcion.value";

	$url_exito="'modulos/maquinaria/php/ver_maquinaria_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("tit","Modificar Maquinaria");
}
else
{
	//$t->set_var("tabla22_imagen","");
	$t->set_var("tabla22_nombre","");
    $t->set_var("tabla22_descripcion","");
	$t->set_var("tabla22_marca","");
	$t->set_var("tabla22_modelo","");
	$t->set_var("tabla22_fecha_compra","");
	$t->set_var("tabla22_costo_compra","");
	$t->set_var("tabla22_matricula","");
    $t->set_var("tabla22_empresa_seguro","");
	$t->set_var("tabla22_rto","");
    $t->set_var("tabla22_funcion","");

	$url="'modulos/maquinaria/php/abm_maquinaria_interfaz.php'";
	$vars="'nombre_funcion=agregar_maquinaria&";
    //$vars.="tabla22_imagen='+abm_maquinaria.tabla22_imagen.value+'&";
	$vars.="tabla22_nombre='+abm_maquinaria.tabla22_nombre.value+'&";
	$vars.="tabla22_descripcion='+abm_maquinaria.tabla22_descripcion.value+'&";
	$vars.="tabla22_marca='+abm_maquinaria.tabla22_marca.value+'&";
    $vars.="tabla22_modelo='+abm_maquinaria.tabla22_modelo.value+'&";
	$vars.="tabla22_fecha_compra='+abm_maquinaria.tabla22_fecha_compra.value+'&";
	$vars.="tabla22_costo_compra='+abm_maquinaria.tabla22_costo_compra.value+'&";
	$vars.="tabla22_matricula='+abm_maquinaria.tabla22_matricula.value+'&";
	$vars.="tabla22_empresa_seguro='+abm_maquinaria.tabla22_empresa_seguro.value+'&";
    $vars.="tabla22_rto='+abm_maquinaria.tabla22_rto.value+'&";
    $vars.="tabla22_funcion='+abm_maquinaria.tabla22_funcion.value";

	$url_exito="'modulos/maquinaria/php/ver_maquinaria_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("tit","Agregar Maquinaria");
}

	//TEMAS
	/*$sql="Select * from  tabla_09_temas  order by tabla09_nombre ASC";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		while ($row = $rs->fetch())
		{
				$id_tabla09=$row["id_tabla09"];
				if ($id_tabla09==$rela_tabla09)
				{
						$t->set_var("ID","\"$id_tabla09\" SELECTED ");
						$t->set_var("NOMBRE",utf8_encode($row["tabla09_nombre"]));

				}else{
						$t->set_var("ID",$row["id_tabla09"]);
						$t->set_var("NOMBRE",utf8_encode($row["tabla09_nombre"]));
				}
			$t->parse("TEMAS","una_opcion",true);
		}
	}*/

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");

$url="'modulos/maquinaria/php/ver_maquinaria_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
