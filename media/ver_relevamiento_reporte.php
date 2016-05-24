<?php
require "../../../php/check.php";
require "../../../php/funciones_comunes.php";
include "../../../lib/link_pg.php";
include "../../../lib/template.inc";
session_start();
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"						=> "ver_relevamiento_reporte.html",
	"un_plan_formal"			=> "un_plan_reporte.html",
	"un_plan_formal_analitico"	=> "un_plan_detalle_reporte.html",	
	"un_planta_organica"	    => "una_planta_organica.html",	
	"una_po_anal"	   			=> "una_po_anal.html",		
	));
	
$estado_presupuestario = array('1' => 'PTA','2' => 'PTI','3' => 'NPA','4' => 'NPI','5' => 'PPA','6' => 'PPI','7' => 'NPA-ET'); 

$rela_sysrele01=$_GET["rela_sysrele01"];
	$sql="select * from educacion.sys_rele_01_cab_relevamiento_planta_funcional 
		inner join educacion.sys_rele_05_cab_ofertas on educacion.sys_rele_05_cab_ofertas.id_sysrele05=educacion.sys_rele_01_cab_relevamiento_planta_funcional.rela_sysrele05 
		inner join educacion.sys_educ_06_cab_establecimientos_educativos on id_syseduc06=rela_syseduc06 
		left outer join educacion.sys_educ_09_cab_delegacion_zonal on rela_syseduc09=id_syseduc09 
		inner join educacion.sys_rele_02_cab_direccion_nivel on id_sysrele02=educacion.sys_rele_01_cab_relevamiento_planta_funcional.rela_sysrele02 
		inner join educacion.sys_rele_10_cab_condicion_trabajo on id_sysrele10=rela_sysrele10 
		inner join educacion.sys_rele_09_cab_complejidad on id_sysrele09=rela_sysrele09 
			where id_sysrele01=$rela_sysrele01";
	$result = pg_query($link_pg,$sql);
	$num_rows = pg_num_rows($result);
	if ($num_rows>0)
	{
		$row = pg_fetch_assoc($result);

			$id_sysrele01=$row["id_sysrele01"];	
			$rela_sysrele02=$row["rela_sysrele02"];	
			$rela_syseduc06=$row["rela_syseduc06"];	
			$t->set_var("nombre_apellido",$row["sysrele01_apellido_contacto"].", ".$row["sysrele01_nombre_contacto"]);
			$t->set_var("syseduc06_cue",$row["syseduc06_cue"]);
			$t->set_var("syseduc06_anexo",$row["syseduc06_anexo"]);
			$t->set_var("syseduc06_codigo_juridiccion",$row["syseduc06_codigo_juridiccion"]);			
			$t->set_var("syseduc06_establecimiento",$row["syseduc06_establecimiento"]);			
			$t->set_var("syseduc06_departamento_temp",$row["syseduc06_departamento_temp"]);			
			$t->set_var("syseduc06_localidad_temp",$row["syseduc06_localidad_temp"]);			
			$t->set_var("sysrele01_fecha_creacion",ver_fecha($row["sysrele01_fecha_creacion"]));	
			$t->set_var("sysrele01_instrumento_legal",$row["sysrele01_instrumento_legal"]);	
			$t->set_var("sysrele01_fecha_instrumento_legal",ver_fecha($row["sysrele01_fecha_instrumento_legal"]));							
			
			$t->set_var("syseduc09_nombre",$row["syseduc09_nombre"]);		
			$t->set_var("sysrele09_descripcion",$row["sysrele09_descripcion"]);			
			$t->set_var("sysrele10_descripcion",$row["sysrele10_descripcion"]);		
			$t->set_var("sysrele02_nombre",$row["sysrele02_nombre"]." - ".$row["sysrele05_nombre"]);	
			$t->set_var("sysrele01_direccion_postal",$row["sysrele01_direccion_postal"]);
			$t->set_var("sysrele01_telefono",$row["sysrele01_telefono"]);
			$t->set_var("sysrele01_celular",$row["sysrele01_celular"]);
			$t->set_var("sysrele01_correo_oficial",$row["sysrele01_correo_oficial"]);
			$rela_sysrele10=$row["rela_sysrele10"];	
			$rela_sysrele09=$row["rela_sysrele09"];	
			$t->set_var("sysrele01_observacion",$row["sysrele01_observacion"]);
	}
	/**/
	//Planes Formal
	$sql="select * from educacion.sys_rele_03_det_planes_estudio 
		inner join educacion.sys_rele_04_cab_planes_estudios on id_sysrele04=rela_sysrele04
		where rela_sysrele01=$id_sysrele01";
		//echo $sql;
	$result = pg_query($link_pg,$sql);
	$num_rows = pg_num_rows($result);
	if ($num_rows>0)
	{
		while ($row = pg_fetch_assoc($result))
		{
			$id_sysrele03=$row["id_sysrele03"];
			$rela_sysrele01=$row["rela_sysrele01"];
			$t->set_var("sysrele04_nombre",$row["sysrele04_nombre"]);
			$t->set_var("sysrele03_instrumento_legal",$row["sysrele03_instrumento_legal"]);
			$t->set_var("sysrele03_fecha_intrumento_legal",ver_fecha($row["sysrele03_fecha_intrumento_legal"]));
			$t->set_var("sysrele03_observaciones",$row["sysrele03_observaciones"]);					

			$t->parse("PLAN_FORMAL","un_plan_formal",true);
		}
	}else{
		$t->set_var("PLAN_FORMAL","");
	}
	
	if ($id_sysrele03!="")
	{
		//Plan Formal Analitico
		$sql="select * from educacion.sys_rele_06_det_analitico_plan_estudio
				inner join educacion.sys_rele_03_det_planes_estudio on id_sysrele03=rela_sysrele03
				inner join educacion.sys_rele_04_cab_planes_estudios on id_sysrele04=rela_sysrele04
				inner join educacion.sys_rele_07_cab_tipo_seccion on id_sysrele07=rela_sysrele07
				inner join educacion.sys_rele_08_cab_turno on id_sysrele08=rela_sysrele08 
				where rela_sysrele01=$id_sysrele01
				order by sysrele04_orden ASC, sysrele06_ano_grado_sala ASC, sysrele06_seccion_division ASC, sysrele07_nombre ASC,sysrele08_nombre ASC ";
				//echo $sql;
		$result = pg_query($link_pg,$sql);
		$num_rows = pg_num_rows($result);
		if ($num_rows>0)
		{
			while ($row = pg_fetch_assoc($result))
			{
				$id_sysrele06=$row["id_sysrele06"];
				$rela_sysrele03=$row["rela_sysrele03"];
				$t->set_var("sysrele04_nombre",$row["sysrele04_nombre"]);
				$t->set_var("sysrele07_nombre",$row["sysrele07_nombre"]);
				$t->set_var("sysrele08_nombre",$row["sysrele08_nombre"]);
				$t->set_var("sysrele06_instrumento_legal",$row["sysrele06_instrumento_legal"]);
				$t->set_var("sysrele06_ano_grado_sala",$row["sysrele06_ano_grado_sala"]);
				$t->set_var("sysrele06_seccion_division",$row["sysrele06_seccion_division"]);
				$t->set_var("sysrele06_total_hs_seccion",$row["sysrele06_total_hs_seccion"]);
				$t->set_var("sysrele06_total_hs_titulares",$row["sysrele06_total_hs_titulares"]);	
				$t->set_var("sysrele06_total_hs_interinos",$row["sysrele06_total_hs_interinos"]);				
				$t->set_var("sysrele06_total_hs_suplentes",$row["sysrele06_total_hs_suplentes"]);						
				$t->set_var("sysrele06_total_matriculados",$row["sysrele06_total_matriculados"]);					
				$t->set_var("sysrele06_observacion",$row["sysrele06_observacion"]);					
				$total_matriculados_formal= $total_matriculados_formal + intval($row["sysrele06_total_matriculados"]);
				$t->set_var("sysrele06_total_hs_creacion",$row["sysrele06_total_hs_creacion"]);					
				
				$t->set_var("total_matriculados_formal",$total_matriculados_formal);
				

				$t->set_var("sysrele06_estadopresupuestario",$estado_presupuestario[$row["sysrele06_estadopresupuestario"]]);
//				}
				$t->set_var("sysrele06_fecha_creacion",ver_fecha($row["sysrele06_fecha_creacion"]));
				if ($row["sysrele06_estadopresupuestario"]==1 or $row["sysrele06_estadopresupuestario"]==3 or $row["sysrele06_estadopresupuestario"]==5)
				{
					$total_hs_seccion_formal= $total_hs_seccion_formal + intval($row["sysrele06_total_hs_seccion"]);
					$total_hs_titulares_formal= $total_hs_titulares_formal + intval($row["sysrele06_total_hs_titulares"]);
					$total_hs_interinos_formal= $total_hs_interinos_formal + intval($row["sysrele06_total_hs_interinos"]);
					$total_hs_suplentes_formal= $total_hs_suplentes_formal + intval($row["sysrele06_total_hs_suplentes"]);
					$total_hs_creacion= $total_hs_creacion + intval($row["sysrele06_total_hs_creacion"]);

				}else{
					$t->set_var("total_hs_seccion_formal","");				
					$t->set_var("total_hs_titulares_formal","");	
					$t->set_var("total_hs_interinos_formal","");	
					$t->set_var("total_hs_suplentes_formal","");	
					$t->set_var("total_hs_creacion","");
					$t->set_var("total_matriculados_formal","");
					

					//$t->set_var("sysrele06_estadopresupuestario","");	
						
				}
				$t->parse("PLAN_FORMAL_ANALITICO","un_plan_formal_analitico",true);
				
			}
							
			$t->set_var("total_hs_seccion_formal",$total_hs_seccion_formal);
			$t->set_var("total_hs_titulares_formal",$total_hs_titulares_formal);
			$t->set_var("total_hs_interinos_formal",$total_hs_interinos_formal);
			$t->set_var("total_hs_suplentes_formal",$total_hs_suplentes_formal);
			$t->set_var("total_hs_creacion",$total_hs_creacion);
			$t->set_var("total_matriculados_formal",$total_matriculados_formal);
			
		}else{
		
			$t->set_var("PLAN_FORMAL_ANALITICO","");
			$t->set_var("total_hs_seccion_formal","");				
			$t->set_var("total_hs_titulares_formal","");	
			$t->set_var("total_hs_interinos_formal","");	
			$t->set_var("total_hs_suplentes_formal","");	
			$t->set_var("total_hs_creacion","");	
			$t->set_var("total_matriculados_formal","");
			$t->set_var("sysrele06_estadopresupuestario","");	
		}
	}else{
		$t->set_var("PLAN_FORMAL_ANALITICO","");
		$t->set_var("total_hs_seccion_formal","");				
		$t->set_var("total_hs_titulares_formal","");	
		$t->set_var("total_hs_interinos_formal","");	
		$t->set_var("total_hs_suplentes_formal","");	
		$t->set_var("total_matriculados_formal","");	
		$t->set_var("total_hs_creacion","");	
		$t->set_var("sysrele06_estadopresupuestario","");	
	}
	/**/
	//Planes NO Formal
	$sql="select * from educacion.sys_rele_14_det_plan_estudio_no_formal
			inner join educacion.sys_rele_04_cab_planes_estudios on id_sysrele04=rela_sysrele04
			inner join educacion.sys_rele_07_cab_tipo_seccion on id_sysrele07=rela_sysrele07
			inner join educacion.sys_rele_08_cab_turno on id_sysrele08=rela_sysrele08 
		where rela_sysrele01=$id_sysrele01
	 order by sysrele04_orden ASC, sysrele14_ano_grado_sala ASC, sysrele14_seccion_division ASC, sysrele07_nombre ASC,sysrele08_nombre ASC ";

		//echo $sql;
	$result = pg_query($link_pg,$sql);
	$num_rows = pg_num_rows($result);
	if ($num_rows>0)
	{
		while ($row = pg_fetch_assoc($result))
		{
			$id_sysrele14=$row["id_sysrele14"];
			$rela_sysrele01=$row["rela_sysrele01"];
			$t->set_var("sysrele04_nombre",$row["sysrele04_nombre"]);
			$t->set_var("sysrele03_instrumento_legal",$row["sysrele14_instrumento_legal"]);
			$t->set_var("sysrele03_fecha_intrumento_legal",ver_fecha($row["sysrele14_fecha_instrumento_legal"]));
			$t->set_var("sysrele07_nombre",$row["sysrele07_nombre"]);
			$t->set_var("sysrele08_nombre",$row["sysrele08_nombre"]);
			$t->set_var("sysrele06_instrumento_legal",$row["sysrele14_instrumento_legal"]);
			$t->set_var("sysrele06_ano_grado_sala",$row["sysrele14_ano_grado_sala"]);
			$t->set_var("sysrele06_seccion_division",$row["sysrele14_seccion_division"]);
			/*$t->set_var("sysrele06_total_hs_seccion",$row["sysrele14_hs_seccion"]);
			$t->set_var("sysrele06_total_hs_titulares",$row["sysrele14_total_hs_titulares"]);				
			$t->set_var("sysrele06_total_hs_interinos",$row["sysrele14_total_hs_interinos"]);				
			$t->set_var("sysrele06_total_hs_suplentes",$row["sysrele14_total_hs_suplentes"]);						
			$t->set_var("sysrele06_total_matriculados",$row["sysrele14_total_matriculados"]);*/
			$t->set_var("sysrele06_total_hs_seccion",$row["sysrele14_hs_seccion"]);
			$total_hs_seccion_noformal= $total_hs_seccion_noformal + intval($row["sysrele14_hs_seccion"]);
			$t->set_var("total_hs_seccion_noformal",$total_hs_seccion_noformal);
			$t->set_var("sysrele06_total_hs_titulares",$row["sysrele14_total_hs_titulares"]);	
			$total_hs_titulares_noformal= $total_hs_titulares_noformal + intval($row["sysrele14_total_hs_titulares"]);
			$t->set_var("total_hs_titulares_noformal",$total_hs_titulares_noformal);
			$t->set_var("sysrele06_total_hs_interinos",$row["sysrele14_total_hs_interinos"]);				
			$total_hs_interinos_noformal= $total_hs_interinos_noformal + intval($row["sysrele14_total_hs_interinos"]);
			$t->set_var("total_hs_interinos_noformal",$total_hs_interinos_noformal);
			$t->set_var("sysrele06_total_hs_suplentes",$row["sysrele14_total_hs_suplentes"]);						
			$total_hs_suplentes_noformal= $total_hs_suplentes_noformal + intval($row["sysrele14_total_hs_suplentes"]);
			$t->set_var("total_hs_suplentes_noformal",$total_hs_suplentes_noformal);
			$t->set_var("sysrele06_total_matriculados",$row["sysrele14_total_matriculados"]);					
			$total_matriculados_noformal= $total_matriculados_noformal + intval($row["sysrele14_total_matriculados"]);
			$t->set_var("total_matriculados_noformal",$total_matriculados_noformal);		
			$t->set_var("sysrele06_total_hs_creacion","");						
			$t->set_var("sysrele06_fecha_creacion",ver_fecha($row["sysrele14_fecha_creacion"]));
			$t->set_var("sysrele06_estadopresupuestario","-");
			$t->set_var("total_hs_creacion_noformal","");
			$t->set_var("sysrele06_observacion",$row["sysrele14_observaciones"]);		
			$t->parse("PLAN_NO_FORMAL_ANALITICO","un_plan_formal_analitico",true);			
			$t->parse("PLAN_NO_FORMAL","un_plan_formal",true);
		}
	}else{
		$t->set_var("PLAN_NO_FORMAL_ANALITICO","");
		$t->set_var("PLAN_NO_FORMAL","");
		$t->set_var("total_hs_seccion_noformal","");	
		$t->set_var("total_hs_creacion_noformal","");				
		$t->set_var("total_hs_titulares_noformal","");	
		$t->set_var("total_hs_interinos_noformal","");	
		$t->set_var("total_hs_suplentes_noformal","");	
		$t->set_var("total_matriculados_noformal","");			

	}	
	//PLANTA ORGANICA
	$sql="select * from educacion.sys_rele_11_det_planta_funcional
			inner join educacion.sys_rele_12_cab_cargos on id_sysrele12=rela_sysrele12
		    where rela_sysrele01=$id_sysrele01
			order by sysrele12_jerarquia ASC,sysrele12_nombre ASC";
		//echo $sql;
	$result = pg_query($link_pg,$sql);
	$num_rows = pg_num_rows($result);
	if ($num_rows>0)
	{
		while ($row = pg_fetch_assoc($result))
		{
			$id_sysrele14=$row["id_sysrele14"];
			$rela_sysrele01=$row["rela_sysrele01"];
			$t->set_var("sysrele12_nombre",$row["sysrele12_nombre"]);
			$t->set_var("sysrele11_cantidad_titular",$row["sysrele11_cantidad_titular"]);
			$t->set_var("sysrele11_cantidad_interino",$row["sysrele11_cantidad_interino"]);
			$t->set_var("sysrele11_cantidad_superior",$row["sysrele11_cantidad_superior"]);
			$t->set_var("sysrele11_total",$row["sysrele11_total"]);
			$t->parse("PLANTA_ORGANICA","un_planta_organica",true);
		}
	}else{
		$t->set_var("PLANTA_ORGANICA","");
	}	
	//PLANTA ORGANICA ANALITICO
	$cubierto = array('0' => 'No','1' => 'Si'); 
	$sql="select * from educacion.sys_rele_15_det_analitico_planta_funcional
			inner join educacion.sys_rele_12_cab_cargos on id_sysrele12=rela_sysrele12
		    where rela_sysrele01=$id_sysrele01
			order by sysrele12_jerarquia ASC,sysrele12_nombre ASC,sysrele15_numero ASC";
	$result = pg_query($link_pg,$sql);
	$num_rows = pg_num_rows($result);
	if ($num_rows>0)
	{
		while ($row = pg_fetch_assoc($result))
		{
			$id_sysrele15=$row["id_sysrele15"];
			$rela_sysrele01=$row["rela_sysrele01"];
			$t->set_var("sysrele12_nombre",$row["sysrele12_nombre"]);
			$t->set_var("sysrele15_numero",$row["sysrele15_numero"]);
			$t->set_var("sysrele15_fecha_creacion",ver_fecha($row["sysrele15_fecha_creacion"]));
			$t->set_var("sysrele15_cubierto",$cubierto[$row["sysrele15_cubierto"]]);
			$t->set_var("sysrele15_regprof",$cubierto[$row["sysrele15_regprof"]]);
			$t->set_var("sysrele15_instrumentolegal",$row["sysrele15_instrumentolegal"]);
			$t->set_var("sysrele15_observaciones",$row["sysrele15_observaciones"]);

			$t->parse("PLANTA_ORGANICA_ANALITICO","una_po_anal",true);
		}
	}else{
		$t->set_var("PLANTA_ORGANICA_ANALITICO","");
	}	
	

 $setting['FORMATO_FECHA_LARGO'] = '%dia% '.date("d").' %de% %mes% %de% Y'; // se le pueden poner cosas como: \H\o\y \e\s %dia%, o agregar un setting tal cual lo es "de" que se llame "hoy" y otro "es". Además de agregar cualquier comodín válido de www.php.net/date
 
 
 /***
 Para cada caso del ejemplo tengo dias, meses y el texto "de"
 ***/
 $setting['DIAS'] = array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado');
 $setting['MESES'] = array('positionZero','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
 $setting['DE'] = 'de';
 
 
 
 /********=))==))==))=********
 EN EL ARCHIVO PHP DE FUNCIONES:
 ********=))==))==))=********/
 
 /**
 Function formatearFechaIdiomas
 In: timestamp, variable setting, formato (corto, medio, largo)
 **/
 function formatearFechaIdiomas( $time, &$setting, $formato = 'largo'){
     $no = array( '%dia%', '%mes%', '%de%' ); #Esto es lo que escribimos en el setting, para que sea más legible para el administrador del sitio. Se pueden agregar tantas variantes se crean necesarias, tendiendo su posición declarada en el array $setting
     $si = array( '%\d\i\a%', '%\m\e\s%', '%\d\e%' ); #No se le pude pasar a date cosas como "mes", ya que las tres letras son valores reservados, hay que escaparlos.
     $traduccion = array( $setting['DIAS'][date("w",$time)], $setting['MESES'][date("n",$time)], $setting['DE'] ); #Y esta es la traducción de cada elemento
     #FORMATO CORTO
     if( $formato == 'corto' ) return date( $setting['FORMATO_FECHA_CORTO'], $time);
     #FORMATO MEDIO
     if( $formato == 'medio' ){
         $setting['FORMATO_FECHA_MEDIO'] = str_replace( $no, $si, $setting['FORMATO_FECHA_MEDIO'] );
         return str_replace( $no, $traduccion, date( $setting['FORMATO_FECHA_MEDIO'], $time) );
     }
     #FORMATO LARGO
     if( $formato == 'largo' ){
         $setting['FORMATO_FECHA_LARGO'] = str_replace( $no, $si, $setting['FORMATO_FECHA_LARGO'] );
         return str_replace( $no, $traduccion, date( $setting['FORMATO_FECHA_LARGO'], $time) );
     }
     return FALSE;    
 }
 
 
 /********=))==))==))=********
 EJEMPLO DE USO, la parte simple:
 ********=))==))==))=********/

 //echo formatearFechaIdiomas( time(), $setting, 'largo') . "<hr>"; #Out: Domingo 12 de Junio de 2008
	$t->set_var("fecha_actual",formatearFechaIdiomas( time(), $setting, 'largo'));
	
	$t->pparse("OUT", "ver");
?>