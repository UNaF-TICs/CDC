<?php
function actualizar_archivo($archivo,$label_inicio,$label_fin,$contenido_label)
{
	$archivo_import=$archivo;
	$lineas = file($archivo_import);

	//true - copio
	//false - no hago nada
	$copio=true;

	foreach ($lineas as $linea_num => $linea)
	{

		if (strncmp($linea,$label_inicio,strlen($label_inicio))==0)
		{
			//dejo de guardar en la variable temporal
			//todo lo que hay aca dentro es del dialplan
			$copio=false;
			echo "ENCONTRE <br>";
			$contenido.= $contenido_label;

		}

		if (strncmp($linea,$label_fin,strlen($label_fin))==0)
		{
			//todo lo que hay aca dentro es del dialplan
			$copio=true;
			echo "ENCONTRE FIN <br>";
			continue;
		}

		if ($copio)
		{
			$contenido.=$linea;
		}

	}
	return $contenido;
}

function elimina_acentos($cadena){
$tofind = "�����������������������������������������������������";
$replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
return(strtr($cadena,$tofind,$replac));
}

function postHttps($url,$params) {
$ch = curl_init ($url);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec ($ch);
curl_close ($ch);
return $result;
}

function buscar_post($path,$params)
{
	$url='http://localhost/portal/'.$path;
	$resultado=postHttps($url,$params);

	return $resultado;

}

function formatear_fecha($fecha)
{
	$v_fecha = split('-',$fecha);
	$dia=$v_fecha[0];
	if (strlen($dia)==1)
		$dia="0".$dia;

	$mes=$v_fecha[1];
	if (strlen($mes)==1)
		$mes="0".$mes;

	$ano=$v_fecha[2];

	$ret_fecha=$ano ."-" . $mes . "-" .$dia;
	return $ret_fecha;

}
function ver_fecha($fecha)
{
	$v_fecha = split('-',$fecha);
	$dia=$v_fecha[2];
	if (strlen($dia)==1)
		$dia="0".$dia;

	$mes=$v_fecha[1];
	if (strlen($mes)==1)
		$mes="0".$mes;

	$ano=$v_fecha[0];

	$ret_fecha= $dia."-" . $mes . "-" .$ano;
	return $ret_fecha;

}

function invertir_modo($modo_order)
{
	if ($modo_order=="DESC")
		return "ASC";
	else
		return "DESC";
}

function get_day($fecha)
{
	$v_fecha = split('-',$fecha);
	$resto=split(' ',$v_fecha[2]);
	$dia=$resto[0];
	return $dia;

}

function get_month($fecha)
{
	$v_fecha = split('-',$fecha);
	$mes=$v_fecha[1];
	return $mes;

}

function get_year($fecha)
{
	$v_fecha = split('-',$fecha);
	$ano=$v_fecha[0];
	return $ano;
}
function restaFechas($dFecIni, $dFecFin)
{
    $dFecIni = str_replace("-","",$dFecIni);
   // $dFecIni = str_replace("/","",$dFecIni);
    $dFecFin = str_replace("-","",$dFecFin);
   // $dFecFin = str_replace("/","",$dFecFin);

    ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecIni, $aFecIni);
    ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecFin, $aFecFin);

    $date1 = mktime(0,0,0,$aFecIni[2], $aFecIni[1], $aFecIni[3]);
    $date2 = mktime(0,0,0,$aFecFin[2], $aFecFin[1], $aFecFin[3]);

    return round(($date2 - $date1) / (60 * 60 * 24));
}
function array_to_json( $array ){

    if( !is_array( $array ) ){
        return false;
    }

    $associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
    if( $associative ){

        $construct = array();
        foreach( $array as $key => $value ){

            // We first copy each key/value pair into a staging array,
            // formatting each key and value properly as we go.

            // Format the key:
            if( is_numeric($key) ){
                $key = "key_$key";
            }
            $key = "\"".addslashes($key)."\"";

            // Format the value:
            if( is_array( $value )){
                $value = array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = "\"".addslashes($value)."\"";
            }

            // Add to staging array:
            $construct[] = "$key: $value";
        }

        // Then we collapse the staging array into the JSON form:
        $result = "{ " . implode( ", ", $construct ) . " }";

    } else { // If the array is a vector (not associative):

        $construct = array();
        foreach( $array as $value ){

            // Format the value:
            if( is_array( $value )){
                $value = array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = "'".addslashes($value)."'";
            }

            // Add to staging array:
            $construct[] = $value;
        }

        // Then we collapse the staging array into the JSON form:
        $result = "[ " . implode( ", ", $construct ) . " ]";
    }

    return $result;
}
function mesatexto($num){
    /**
     * Creamos un array con los meses disponibles.
     * Agregamos un valor cualquiera al comienzo del array para que los n�meros coincidan
     * con el valor tradicional del mes. El valor "Error" resultar� �til
     **/
    $meses = array('Error', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

    /**
     * Si el n�mero ingresado est� entre 1 y 12 asignar la parte entera.
     * De lo contrario asignar "0"
     **/
    $num_limpio = $num >= 1 && $num <= 12 ? intval($num) : 0;
    return $meses[$num_limpio];
}



function fechaATexto($fecha, $formato = 'c') {

    // Validamos que la cadena satisfaga el formato deseado y almacenamos las partes
    if (ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $partes)) {
        // $partes[0] contiene la cadena original
        // $partes[1] contiene el a�o
        // $partes[2] contiene el n�mero de mes
        // $partes[3] contiene el n�mero del d�a
        $mes = ' de ' . mesatexto($partes[2]) . ' de ';
        if ($formato == 'u') {
            $mes = strtoupper($mes);
        } elseif ($formato == 'l') {
            $mes = strtolower($mes);
        }
        return $partes[3] . $mes . $partes[1];

    } else {
        // Si hubo problemas en la validaci�n, devolvemos false
        return false;
    }
}

/**
 * timestampATexto()
 *
 * Devuelve la cadena de texto asociada a la fecha ingresada
 *
 * @param   string timestamp (cadena con formato XXXX-XX-XX XX:XX:XX)
 * @param   string formato (puede tomar los valores 'l', 'u', 'c')
 * @return  string  fecha_en_formato_texto
 */

function timestampATexto($timestamp, $formato = 'c') {

    // Buscamos el espacio dentro de la cadena o salimos
    if (strpos($timestamp, " ") === false){
        return false;
    }

    // Dividimos la cadena en el espacio separador
    $timestamp = explode(" ", $timestamp);

    // Como la primera parte es una fecha, simplemente llamamos a fechaATexto()
    if (fechaATexto($timestamp[0])) {
        $conjuncion = ' a las ';
        if ($formato == 'u') {
            $conjuncion = strtoupper($conjuncion);
        }
        return fechaATexto($timestamp[0], $formato) . $conjuncion;
    }
}
function compara_fechas($fecha1,$fecha2)
{
      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
          list($dia1,$mes1,$a�o1)=split("/",$fecha1);
      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
              list($dia1,$mes1,$a�o1)=split("-",$fecha1);
        if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
              list($dia2,$mes2,$a�o2)=split("/",$fecha2);
      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
              list($dia2,$mes2,$a�o2)=split("-",$fecha2);
        $dif = mktime(0,0,0,$mes1,$dia1,$a�o1) - mktime(0,0,0, $mes2,$dia2,$a�o2);
        return ($dif);
}

function redondear_dos_decimal($valor) {
$float_redondeado=round($valor * 100) / 100;
//echo $float_redondeado;
$float_redondeado=ceiling($float_redondeado, 0.05);
return $float_redondeado;
}
function ceiling($number, $significance = 1)
{
	return ( is_numeric($number) && is_numeric($significance) ) ? (ceil($number/$significance)*$significance) : false;
}

function phpConsoleLog($msg) {
	echo '<script type="text/javascript">console.log("'.$msg.'")</script>';
}

?>
