<?php
 	date_default_timezone_set('America/Lima');
	require ("../class/ClassPlantilla.php");
	require ("../class/dbconnect.php");
	require ("ultimosismoModel.php");
   	session_start();

	function alarma(){
		$result=readSismo();
		for($i=0; $i<$result["Count"]; $i++){
			$xmlt = simplexml_load_string($result["parameters"][$i]);
			$objhipocentro=$xmlt->hipocentro;
			$fechaLocal[$i] = (string)$objhipocentro->fechaLocal;
			$horaLocal[$i] = (string)$objhipocentro->horaLocal;
		}

		list($day,$month,$year)=explode("/", $fechaLocal[0]);
		$timestamp_last_publication=strtotime($year."-".$month."-".$day." ".$horaLocal[0]);
		$timestamp_current=time();
		//$timestamp_current="1340202398";
		$timestamp_difference=$timestamp_current-$timestamp_last_publication;
		$codigo_sonido="alarma();";
		if($timestamp_difference > 600){
			$codigo_sonido="";
		}
		return $codigo_sonido;
	}


	function reporteSismo(){

		//Leemos de la base de datos
		$result=readSismo();

		//Seleccionamos la plantilla correspondiente
		if ($result["report_type"][0]=="D"){
			$plantilla="tpl/ultimosismo";
		}
		if ($result["report_type"][0]=="P"){
			$plantilla="tpl/ultimosismotemp";
		}
		if ($result["report_type"][0]=="S"){
			$plantilla="tpl/simulacro";
		}

		$Contenido=new Plantilla($plantilla);


		for($i=0; $i<$result["Count"]; $i++){
				$xmlt = simplexml_load_string($result["parameters"][$i]);
				$objhipocentro=$xmlt->hipocentro;
				$fechaLocal[$i] = (string)$objhipocentro->fechaLocal;
				$horaLocal[$i] = (string)$objhipocentro->horaLocal;
				$latitud[$i] = (string)$objhipocentro->latitud;
				$longitud[$i] = (string)$objhipocentro->longitud;
				$profundidad_valor[$i] = (string)$objhipocentro->profundidad_valor;
				$profundidad[$i] = (string)$objhipocentro->profundidad_valor." ".(string)$objhipocentro->profundidad_unidad;
				$epicentro[$i] = (string)$objhipocentro->epicentro;
				$referencia[$i] = str_replace(",", "<br>", (string)$objhipocentro->referencia);
				$magnitud[$i] = (string)$objhipocentro->magnitud_valor." ".(string)$objhipocentro->magnitud_unidad;
				$magnitud_valor[$i] = (string)$objhipocentro->magnitud_valor;
				$intensidad[$i] = (string)$objhipocentro->intensidad;
				$intensidad_valor[$i] = (string)$objhipocentro->intensidad;
				$fechaGMT[$i] = (string)$objhipocentro->fechaGMT;
				$horaGMT[$i] = (string)$objhipocentro->horaGMT;

				if ((string)$objhipocentro->numeroReporte==""){
					$numeroReporte= "";
				}
				else{
					$numeroReporte= " &nbsp;N° ".(string)$objhipocentro->numeroReporte;
				}
		}

		//Sismo Principal [0] , Réplicas [1->]

		if ($result["report_type"][0]=="P"){
			if (isset($intensidad[0])){
				$intensidad[0]='<tr class="cebra"><td>Intensidad</td><td> '.$intensidad[0].'</td></tr>';
			}

		}

		$html="";
		$enlace="";
		if ($result["Count"]>1){

			$html="<tr class='cab'><td>Fecha Local</td><td>Hora Local</td><td>Latitud</td><td>Longitud</td><td>Profundidad</td>";
			$html.="<td>Intensidad</td><td>Referencia</td><td>Magnitud</td></tr>";

			for($i=1; $i<$result["Count"]; $i++){
				$html.="<tr class='cebra'><td>".$fechaLocal[$i]."</td><td>$horaLocal[$i]</td><td>$latitud[$i]</td><td>$longitud[$i]</td><td>$profundidad[$i]</td>";
				$html.="<td>$intensidad[$i]</td><td>$referencia[$i]</td><td>$magnitud[$i]</td></tr>";
			}
			$html="<table class='tablacebra' cellspacing=0 cellpading=0>$html</table>";
			$enlace='<br/><div style="text-align:center; width:230px; padding: 5px 5px 5px 5px; background-color:#EEEEEE"><a href=# onclick="showReplicas(); return false;">R&eacute;plicas</a></div>';
		}

		/*
		// Referencias
		$cities=findCities($latitud[0],$longitud[0]);

		foreach ($cities as $key => $row) {
			$distance[$key]  = $row['Distance'];
			$text[$key] = $row['Text'];
		}

		array_multisort($distance, SORT_ASC, $cities);


		$hidden="";
		for($i = 0; $i < 10; ++$i){
			$hidden.="<input type='hidden' id='city$i' value='".$cities[$i]["Location"]."' />";
		}
		*/

		/*
		// Creating map
		$objectMap = ms_newMapObj("map/static.map");
		$oLayerPoints = ms_newLayerObj($objectMap);
		$oLayerPoints->set( "name", "custom_points");
		$oLayerPoints->set( "type", MS_LAYER_POINT);
		$oLayerPoints->set( "status", MS_DEFAULT);

		$oCoordList = ms_newLineObj();
		$oPointShape = ms_newShapeObj(MS_SHAPE_POINT);
		$oCoordList->addXY($longitud[0],$latitud[0]);
		$oPointShape->add($oCoordList);
		//$oPointShape->set( "text", "PERU....................");

		$oLayerPoints->addFeature($oPointShape);

		// Create a class object to set feature drawing styles.
		$oMapClass = ms_newClassObj($oLayerPoints);
		// Create a style object defining how to draw features
		$oPointStyle = ms_newStyleObj($oMapClass);

		//$oPointStyle->outlinecolor->setRGB(255,255,255);
		$oPointStyle->set( "symbolname", "epicentro");
		//$oPointStyle->set( "size", $size);

		$image=$objectMap->draw();
		$image->saveImage("tmp/ultimosismo.png");
		*/
		if($magnitud_valor[0]<4.5){
			$magnitud_sismo_color_hex =  "#04B70D";
			$magnitud_sismo_color="verde";
		}
		else if($magnitud_valor[0]>6.0){
			$magnitud_sismo_color_hex =  "#db2828";
			$magnitud_sismo_color="rojo";
		}else{
			$magnitud_sismo_color_hex =  "#fbbd08";
			$magnitud_sismo_color="amarillo";
		}


		$Contenido->asigna_variables(array(
			"magnitud_sismo_color"=>$magnitud_sismo_color,
			"magnitud_sismo_color_hex"=>$magnitud_sismo_color_hex,
			"fecha_sismo" => $fechaGMT[0],
			"hora_sismo" => $horaGMT[0],
			"hora_local_sismo" => $horaLocal[0],
			"fecha_local_sismo" => $fechaLocal[0],
			"latitud_sismo" => $latitud[0],
			"clatitud_sismo" => (float)$latitud[0],
			"longitud_sismo"=>$longitud[0],
			"clongitud_sismo"=> (float)$longitud[0],
			"profundidad_valor"=>$profundidad_valor[0],
			"profundidad_sismo"=>$profundidad[0],
			"magnitud_sismo"=>$magnitud_valor[0],
			"intensidad_sismo"=>$intensidad_valor[0],
			"epicentro_sismo"=>$epicentro[0],
			"referencia_sismo"=>$referencia[0],
			"fecha_actual"=>date("d/m/Y"),
			"hora_actual"=>date("H"),
			"minuto_actual"=>date("i"),
			"segundo_actual"=>date("s"),
			"codigo_sonido"=>alarma(),
			"replicas"=>$html,
			"link_replicas"=>$enlace,
			"numero_reporte_sismo"=>$numeroReporte

		));
		$ContenidoString = $Contenido->muestra();
		echo $ContenidoString;
	}

	reporteSismo()

?>




