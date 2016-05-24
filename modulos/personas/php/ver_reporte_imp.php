<?php
include "../../../lib/template.inc";
include "../../../lib/link_mysql.php";
include "../../../php/check.php";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_reporte_imp.html",
	"un"		=> "un_reporte.html",
	));
	
$id_tabla07=$_GET["id_tabla07"]; 

//echo $rela_tabla09;
if ($id_tabla07!="")
{
	
	$qr="Select * from tabla_07_personas
	where id_tabla07=$id_tabla07";
	//echo $qr;
	$result = mysql_query($qr,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		  $row = mysql_fetch_assoc($result);
		$id_tabla07 = $row["id_tabla07"];
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
 //Cursos Realizados/
							

function calculaedad($fechanacimiento){
    list($ano,$mes,$dia) = explode("-",$fechanacimiento);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
    return $ano_diferencia;
}						
$t->pparse("OUT", "ver");	
?>