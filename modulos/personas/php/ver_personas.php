<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";
session_start();
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"main"		=> "ver_personas.html",
	"un"		=> "una_personas.html",
	));

$activo = array('1' => '<img src="media/iconos/habilitado.png" alt="Es Beneficiario" width="12">',
					'0' => '<img src="media/iconos/no-habilitado.png" alt="NO es Beneficiario" width="12">',
					'' => '<img src="media/iconos/no-habilitado.png" alt="Inactivo" width="12">'); 


$id_tablamodulo=$_POST["id_tablamodulo"];
$es_buscar=$_POST["es_buscar"]; 
$tabla07_dni=$_POST["tabla07_dni"]; 
$apellido=strtoupper($_POST["apellido"]);
$nropersonas=$_POST["nropersonas"];
$nombre=strtoupper($_POST["nombre"]);
$apellido=utf8_decode($apellido);
$nombre=utf8_decode($nombre);
$edad=$_POST["edad"]; 
//echo $edad;

$offset=$_POST["offset"];

if ($es_buscar!="")
{
	$where="1=1";
	if ($nombre!="")
	{
			$where.= " AND tabla07_nombre  LIKE '%$nombre%'";
	}
	if ($edad!="")
	{
			$where.= " AND 	YEAR(CURDATE())-YEAR(tabla07_cumple)=$edad";
	}
	if ($nropersonas!="")
	{
			$where.= " AND tabla07_nropersona  LIKE '%$nropersonas%'";
	}
	if ($apellido!="")
	{
			$where.= " AND tabla07_apellido LIKE '%$apellido%'";
	}
	
	if ($tabla07_dni!="")
	{
			$where.= " AND tabla07_dni LIKE '%$tabla07_dni%'";
	}
	
		
	
	$_SESSION['where_personas']=$where;
	if ($where!="")
	{
		$where= " where $where ";
	}
	
}
else
{
	//es repaginar
	if ($_SESSION['where_personas']!="")
	{
		$where = " where " . $_SESSION['where_personas'];
	}
}
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
$sql="select * from tabla_07_personas 
		$where 
		order by tabla07_apellido ASC, tabla07_nombre ASC
		Limit $totalporpag OFFSET $ini  ";
$result = mysql_query($sql,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{

	while ($row = mysql_fetch_assoc($result))
	{
		$id_tabla07=$row["id_tabla07"];
		$t->set_var("nombre_y_apellido",htmlentities($row["tabla07_apellido"], ENT_QUOTES)." ".htmlentities($row["tabla07_nombre"], ENT_QUOTES));
		$t->set_var("tabla07_nropersona",htmlentities($row["tabla07_nropersona"], ENT_QUOTES));
		
		$edad=calculaedad($row["tabla07_cumple"]);
       	$t->set_var("tabla07_edad",$edad);
       	$t->set_var("id_tabla07",$id_tabla07);
		if ($row["tabla07_imagen"]=="")
		{
			$t->set_var("tabla07_imagen","<strong>Sin Datos</strong>");
		}else{
			$t->set_var("tabla07_imagen",htmlentities($row["tabla07_imagen"], ENT_QUOTES));
		}
		
		if ($row["tabla07_direccion"]=="")
		{
			$t->set_var("tabla07_direccion","<strong>Sin Datos</strong>");
		}else{
			$t->set_var("tabla07_direccion",htmlentities($row["tabla07_direccion"], ENT_QUOTES));
		}
		
		if ($row["tabla08_nombre"]=="")
		{
			$t->set_var("tabla08_nombre","<strong>Sin Datos</strong>");
		}else{
			$t->set_var("tabla08_nombre",htmlentities($row["tabla08_nombre"], ENT_QUOTES));
		}
		
		if ($row["tabla07_celular"]=="")
		{
			$t->set_var("tabla07_celular","<strong>Sin Datos</strong>");
		}else{
			$t->set_var("tabla07_celular",htmlentities($row["tabla07_celular"], ENT_QUOTES));
		}
		if ($row["tabla07_telfijo"]=="")
		{
			$t->set_var("tabla07_telfijo","<strong>Sin Datos</strong>");
		}else{
			$t->set_var("tabla07_telfijo",htmlentities($row["tabla07_telfijo"], ENT_QUOTES));
		}
		$t->set_var("tabla07_dni",htmlentities($row["tabla07_dni"]));
		
		$url="'modulos/personas/php/ver_personas_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'id_tabla07=$id_tabla07&id_tablamodulo=$id_tablamodulo'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	

		$url="'modulos/personas/php/abm_personas_interfaz.php'";
		$vars="'nombre_funcion=borrar_personas&";
		$vars.="id_tabla07=$id_tabla07&id_tablamodulo=$id_tablamodulo'";
		$url_exito="'modulos/personas/php/ver_personas_busqueda.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
		$msg="'Esta seguro que quiere eliminar el Registro?'";
		$t->set_var("funcion_borrar","eliminar_mostrar($url,$vars,$url_exito,$id,$vars_exito,$msg);");
		//Reporte
		$url="\"modulos/personas/php/ver_reporte.php\"";
		$id="\"popup\"";
		$vars="\"id_tabla07=$id_tabla07\"";
		$t->set_var("funcion_reporte","cargar_post($url,$id,$vars)");	
		$t->set_var("icono_reporte","buscar.png");

		$t->parse("LISTADO","un",true);
	}
}else{

	$t->set_var("LISTADO","<tr class='alt' align='center'><td colspan='10'>No se encuentra ning&uacute;n Registro cargada. </td> </tr>");
}

	// New Paginador
	$qrT="select count(*) as cantidad from tabla_07_personas 
		$where " ;
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
		$pag.="<td><a href=\"javascript:cargar_post('modulos/personas/php/ver_personas.php','listado_personas','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/personas/php/ver_personas.php','listado_personas','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/personas/php/ver_personas.php','listado_personas','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
	
	function calculaedad($fechanacimiento){
    list($ano,$mes,$dia) = explode("-",$fechanacimiento);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
    return $ano_diferencia;
}
	
	$t->pparse("OUT", "main");


?>