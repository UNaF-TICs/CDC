<?php
include "../../../lib/template.inc";
include "../../../lib/link_mysql.php";
include "../../../php/check.php";
include "../../../php/funciones_comunes.php";


$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_reporte.html",
	"un"		=> "un_reporte.html",
	));
	
$id_tabla07=$_POST["id_tabla07"]; 
$t->set_var("id_tabla07",$id_tabla07);

if ($id_tabla07!="")
{
	$sql="select * from tabla_07_personas 
			inner join  tabla_01_usuarios on id_tabla01=rela_tabla01
			where id_tabla07=$id_tabla07";
	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		$row = mysql_fetch_assoc($result);
		$id_tabla07 = $row["id_tabla07"];
		$t->set_var("id_tabla07",$id_tabla07);
		$tabla07_esbeneficiario = $row["tabla07_esbeneficiario"];
		$tabla07_sexo = $row["tabla07_sexo"];
		$tabla07_fechaalta = $row["tabla07_fechaalta"];
	    $tabla07_peso = $row["tabla07_peso"];
		$t->set_var("tabla07_peso",$tabla07_peso);
		$t->set_var("tabla07_dni", $row["tabla07_dni"]);
		$t->set_var("tabla07_sexo",$tabla07_sexo);
		$t->set_var("tabla07_fechaalta",ver_fecha($row["tabla07_fechaalta"]));
		$t->set_var("tabla07_nropersona",htmlentities($row["tabla07_nropersona"],ENT_QUOTES));
		$t->set_var("nombre_y_apellido",htmlentities($row["tabla07_apellido"], ENT_QUOTES)." ".htmlentities($row["tabla07_nombre"], ENT_QUOTES));
		$t->set_var("tabla07_localidad",htmlentities($row["tabla07_localidad"],ENT_QUOTES));
		$t->set_var("tabla07_direccion",htmlentities($row["tabla07_direccion"],ENT_QUOTES));
		$t->set_var("tabla07_telfijo",htmlentities($row["tabla07_telfijo"],ENT_QUOTES));
		$t->set_var("tabla07_celular",htmlentities($row["tabla07_celular"],ENT_QUOTES));
		$t->set_var("tabla07_cumple",ver_fecha($row["tabla07_cumple"]));
		$t->set_var("tabla07_mail",htmlentities($row["tabla07_mail"],ENT_QUOTES));
		$t->set_var("tabla07_nrotarjeta",htmlentities($row["tabla07_nrotarjeta"],ENT_QUOTES));
		$t->set_var("tabla01_nombre",htmlentities($row["tabla01_nombre"],ENT_QUOTES));


		$edad=calculaedad($row["tabla07_cumple"]);
		$t->set_var("edad",$edad);

		switch ($tabla07_sexo) {
			case "0":
				$t->set_var("selected_hab","");		
				$t->set_var("selected_des","selected");		
			break;
			case "1":
				$t->set_var("selected_hab","selected");		
				$t->set_var("selected_des","");		
			break;
		}
		
		if ($tabla07_esbeneficiario==1)
		{
			$t->set_var("checked_esbeneficiario","checked");
			$t->set_var("disabled_beneficiario","");
		}else{

			$t->set_var("checked_esbeneficiario","");
			$t->set_var("disabled_beneficiario","disabled");

		}		
	}
}



function calculaedad($fechanacimiento){
    list($ano,$mes,$dia) = explode("-",$fechanacimiento);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
    return $ano_diferencia;
}
/*
$qr2="select * from tabla_09_pers_disciplinas
							 inner join tabla_07_personas on rela_tabla07=id_tabla07
							 inner join tabla_08_disciplinas on rela_tabla08=id_tabla08
							 where id_tabla07=$id_tabla07";
							//echo $qr;
							$result2 = mysql_query($qr2,$link_mysql);
							$num_rows2 = mysql_num_rows($result2);
							if ($num_rows2>0)
							{
							while ($row2 = mysql_fetch_assoc($result2))
							{
								 if ($row2["tabla09_fechaalta"]=="")
								{
									$t->set_var("tabla09_fechaalta","<strong>Sin Datos</strong>");
								}else{
									$t->set_var("tabla09_fechaalta",ver_fecha($row2["tabla09_fechaalta"]));
								}

								if ($row2["tabla08_nombre"]=="")
								{
									$t->set_var("tabla08_nombre","<strong>Sin Datos</strong>");
								}else{
									$t->set_var("tabla08_nombre",htmlentities($row2["tabla08_nombre"], ENT_QUOTES));
								}

								$t->parse("LISTADO","un",true);
								}		
								}else{
										$t->set_var("LISTADO","<tr align='center' class='alt'><td colspan='9'>No se encuentran Registros Cargados. </td></tr>");
						        }	*/
$t->pparse("OUT", "ver");	
?>