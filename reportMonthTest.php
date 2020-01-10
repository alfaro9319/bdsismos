<?php
require ('../class/dbconnect.php');
require("sismosSentidosModel.php");
require_once('../class/tcpdf/config/lang/eng.php');
require_once('../class/tcpdf/tcpdf.php');
//require_once('ultimosSismosSentidos2.php');
require ('class/ClassPaginatorSismos.php');
//require ('class/dbconnect.php');
require ('class/xajax_core/xajax.inc.php');
//require("sismosSentidosModel.php");

require_once 'http-client/index.php';

// extend TCPF with custom functions
class MYPDF extends TCPDF {


	public function Header() {
		/*
		// Logo
		$image_file = K_PATH_IMAGES.'igp-azul-trans.png';
		$this->Image($image_file, 10, 5, 0, 0, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('dejavusans', 'B', 20);
		// Title
		$this->Cell(0, 18, 'Instituto Geofísico del Perú', 0, false, 'C', 0, '', 0, false, 'M', 'B');
		$this->Ln();
		//Subtitle
		$this->SetFont('dejavusans', 'B', 18);
		$this->Cell(0, 10, '             Reporte de los últimos sismos sentidos', 0, false, 'C', 0, '', 0, false, 'M', 'T');
		*/
		$this->SetFont('dejavusans', 'B', 20);
		$this->Cell(0, 18, '', 0, false, 'C', 0, '', 0, false, 'M', 'B');
		$this->Ln();
		$this->SetFont('dejavusans', 'B', 18);
		$this->Cell(0, 10, 'Mapas sísmicos por mes', 0, false, 'C', 0, '', 0, false, 'M', 'T');

		$this->SetFont('helvetica', '', 20);
		$this->SetDrawColor(200,0,0);
		$this->SetTextColor(200,0,0);

		//$this->StartTransform();
		//$this->Rotate(50, 150, 150);
		//$this->Rect(150, 150, 60, 10, 'D');
		//$this->Text(155, 150, 'Sin valor oficial');
		//$this->SetDrawColor(0,0,0);
		//$this->StopTransform();
		$this->Ln();


	}


	public function resumeTable($header,$data) {
		// Colors, line width and bold font
		$this->SetFillColor(109, 110, 113);
		$this->SetTextColor(255);
		$this->SetDrawColor(109, 110, 113);
		$this->SetLineWidth(0.3);
		$this->SetFont('', 'B',8);

		// Header
		$w=16;

		for($i = 0; $i < count($header); ++$i) {
			$this->Cell($w, 7, $header[$i], 1, 0, 'C', 1);
		}
		$this->Ln();
		// Color and font restoration
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;

		for($k = 1; $k < 13; ++$k) {

			for($i = 0; $i < count($data["mes"]); ++$i) {
				if ($k==$data["mes"][$i]){
					$cantidadMes=$data["cantidad"][$i];
					break;
				}
				else{
					$cantidadMes="";
				}
			}
			$this->Cell($w, 7, $cantidadMes, 1, 0, 'C', $fill);

		}
		$this->Ln();
	}


	// Colored table
	public function ColoredTable($header,$data) {
		// Colors, line width and bold font
		$this->SetFillColor(0, 0, 0);
		$this->SetTextColor(255);
		$this->SetDrawColor(0, 0, 0);
		$this->SetLineWidth(0.3);
		$this->SetFont('', 'B');
		// Header
		$w = array(22, 18, 16, 16,14, 14, 92);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
		}
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(224, 235, 255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = 0;

		for($i=0; $i<$data["Count"]; $i++){
			$this->SetFont('Courier', '', 9);
			$this->Cell($w[0],7,date("d/m/Y",strtotime($data["fecha_local"][$i])),1);
			$this->Cell($w[1],7,$data["hora_local"][$i],1);
			$this->Cell($w[2],7,str_pad($data["latitud"][$i], 6, ' ', STR_PAD_LEFT),1);
			$this->Cell($w[3],7,$data["longitud"][$i],1);
			$this->Cell($w[4],7,str_pad($data["profundidad"][$i], 4, ' ', STR_PAD_LEFT),1);
			$this->Cell($w[5],7,str_pad($data["magnitud"][$i], 5, ' ', STR_PAD_LEFT),1);
			$this->SetFont('helvetica', '', 8);
			$this->Cell($w[6],7,$data["intensidad"][$i],1);
			$this->Ln();
		}




		/*
		foreach($data as $row) {
			$this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
			$this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
			$this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
			$this->Ln();
			$fill=!$fill;
		}
		$this->Cell(array_sum($w), 0, '', 'T');
		*/

	}
}

$xajax=new xajax();
$xajax->configure('javascript URI', 'class/');
date_default_timezone_set('America/Lima');


function aux($pageSize,$currentPage,$form){


$objResponse = new xajaxResponse();

if (count($form)<>0){
	$tabla=tablaSismos($pageSize,$currentPage,$form);
	$objResponse->assign("tablaResultados", "innerHTML",$tabla);
	//$objResponse->alert(print_r($form,TRUE));
	$paginador=paginadorSismos($pageSize,$currentPage,$form);
	$objResponse->assign("paginator", "innerHTML", $paginador);
}
else{
	$objResponse->assign("tablaResultados", "innerHTML","");
	$objResponse->assign("paginator", "innerHTML", "");
}
return $objResponse;
}


function auxIni($pageSize,$currentPage){
$objResponse = new xajaxResponse();

$html='<table class="ui table"><tbody>';
$arrayMeses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre",);

$result=listMonth();

for($i=0; $i<$result["Count"]; $i++){
	$html.="<tr class='mes'>";
	$html.="<td>".$arrayMeses[$result["mes"][$i]]."</td>";
	$html.="<td>(".$result["cantidad"][$i].")</td>";
	$html.="<td><input type='checkbox' onclick=\"xajax_aux($pageSize,$currentPage,xajax.getFormValues('formMonth'))\" checked='true' id='optionMonth".$i."' name='optionMonth".$i."' value='".$result["mes"][$i]."'></td>";
	$html.="</div>";
}
$html.="</tbody></table>";

$objResponse->assign("meses", "innerHTML",$html);

$tabla=tablaSismos($pageSize,$currentPage,"");
$objResponse->assign("tablaResultados", "innerHTML",$tabla);
$paginador=paginadorSismos($pageSize,$currentPage,"xajax.getFormValues('formMonth')");
$objResponse->assign("paginator", "innerHTML",$paginador);

return $objResponse;
}


function tablaSismos($pageSize,$currentPage,$form){
$valuesMonth="";
// El resultado debe ser solo de la pagina a mostrar
if ($form==""){
	$result=readListSismos("Limit",$pageSize,$currentPage);
}
elseif(is_array($form)){
	// Verificamos que meses tienen valor
	for($i=0; $i<12; $i++){
		if (isset($form["optionMonth$i"])){
			$valuesMonth.=$form["optionMonth$i"].",";
		}
	}
	// Le quitamos la ultima coma
	$valuesMonth=substr_replace($valuesMonth,'',strripos($valuesMonth,","),1);
	$result=readListSismos("FilterMonthLimit",$pageSize,$currentPage,$valuesMonth);
}
//<th colspan="2">Intensidad</th>
$html='<table class="ui table collapsing striped"><thead>
<tr valign="top"><th>Fecha Local</th>
<th>Hora Local</th>
<th>Latitud°</th>
<th>Longitud°</th>
<th>Profundidad</th>
<th>Magnitud</th>

<th>Mapas tem&aacute;ticos</th>
<th>Informe</th></tr></thead><tbody>
';

for($i=0; $i<$result["Count"]; $i++){
	$html.="<tr>";
	$html.="<td>".date("d/m/Y",strtotime($result["fecha_local"][$i]))."</td>";
	$html.="<td>".$result["hora_local"][$i]."</td>";
	$html.="<td>".$result["latitud"][$i]."</td>";
	$html.="<td>".$result["longitud"][$i]."</td>";
	$html.="<td>".$result["profundidad"][$i]." km</td>";
	$html.="<td>".$result["magnitud"][$i]." ".$result["tipomagnitud"][$i]."</td>";
	/*$html.="<td colspan='2'>&nbsp;".$result["intensidad"][$i]."</td>";*/
	/*$html.="<td>".(($result["anyMap"][$i]=="1")?"<img src='https://cdn2.iconfinder.com/data/icons/file-8/128/file_pdf_download-32.png'>":"")."</td>";*/
	$html.="<td class='".$result["idlistasismos"][$i]."'>".(( !empty($result["mapa"][$i]))?"<a target='_blank' href='".http_client_download_file($result["idlistasismos"][$i].'/'.$result["mapa"][$i])."'><img style='height: 20px;' src='https://cdn2.iconfinder.com/data/icons/file-8/128/file_pdf_download-32.png'></a>":"")."</td>";
	$html.="<td>".(( !empty($result["informe"][$i]))?"<a target='_blank' href='".http_client_download_file($result["informe"][$i])."'><img style='height: 20px;' src='https://cdn1.iconfinder.com/data/icons/hawcons/32/699327-icon-55-document-text-48.png'></a>    ":"")."</td>";
				$html.="</tr>";
}
$html.="<tbody></table>";

return $html;
}


function paginadorSismos($pageSize, $currentPage,$parameter){

$valuesMonth="";
// El resultado debe ser el total de la consulta

if(is_array($parameter)){
	// Verificamos que meses tienen valor
	for($i=0; $i<12; $i++){
		if (isset($parameter["optionMonth$i"])){
			$valuesMonth.=$parameter["optionMonth$i"].",";
		}
	}
	// Le quitamos la ultima coma
	$valuesMonth=substr_replace($valuesMonth,'',strripos($valuesMonth,","),1);

	$result=readListSismos("FilterMonth",$pageSize,$currentPage,$valuesMonth);
}
else{
	$result=readListSismos("All",$pageSize, $currentPage);
}
$total=$result["Count"];
$pagHtml=paginatorConstruct($currentPage,$pageSize,$total);

return $pagHtml;
}





function tabla(){

$objResponse = new xajaxResponse();

$html='<table cellspacing="0" cellpadding="0" border="0" align="center" class="ui table tablalateral">';
$arrayMeses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre",);

$result=listMonth();

for($i=0; $i<$result["Count"]; $i++){
	$html.="<tr class='mes'>";
	$html.="<td>".$arrayMeses[$result["mes"][$i]]."</td>";
	$html.="<td>(".$result["cantidad"][$i].")</td>";
	$html.="<td><input type='checkbox' onclick=\"showsismo".$arrayMeses[$result["mes"][$i]]."(this.checked)\" checked='true' id='optionMonth".$i."' name='optionMonth".$i."' value='".$result["mes"][$i]."'></td>";
	$html.="</tr>";
}
$html.="</tabla>";

$objResponse->assign("meses-mapa", "innerHTML",$html);
return $objResponse;
}

$result=readListSismos("All","","");
$arrayMeses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre",);

$grupoEneroCheck="";
$grupoEneroNoCheck="";
$grupoFebreroCheck="";
$grupoFebreroNoCheck="";
$grupoMarzoCheck="";
$grupoMarzoNoCheck="";
$grupoAbrilCheck="";
$grupoAbrilNoCheck="";
$grupoMayoCheck="";
$grupoMayoNoCheck="";
$grupoJunioCheck="";
$grupoJunioNoCheck="";
$grupoJulioCheck="";
$grupoJulioNoCheck="";
$grupoAgostoCheck="";
$grupoAgostoNoCheck="";
$grupoSetiembreCheck="";
$grupoSetiembreNoCheck="";
$grupoOctubreCheck="";
$grupoOctubreNoCheck="";
$grupoNoviembreCheck="";
$grupoNoviembreNoCheck="";
$grupoDiciembreCheck="";
$grupoDiciembreNoCheck="";



for($i=0; $i<$result["Count"]; $i++){
	$fechaLocal[$i] = $result["fecha_local"][$i];
	$horaLocal[$i] = $result["hora_local"][$i];
	$latitud[$i] = $result["latitud"][$i];
	$longitud[$i] = $result["longitud"][$i];
	$profundidad_valor[$i] = $result["profundidad"][$i];
	$profundidad_unidad[$i] = "Km";
	$referencia[$i] = $result["referencia"][$i];
	$magnitud_valor[$i] = $result["magnitud"][$i];
	$magnitud_unidad[$i] = "ML";
	$intensidad[$i] = $result["intensidad"][$i];
	list($year[$i],$month[$i],$day[$i])=explode("-", $fechaLocal[$i]);

	if ($month[$i]==1){
		$grupoEneroCheck.="markersArray[$i].setMap(map);";
		$grupoEneroNoCheck.="markersArray[$i].setMap(null);";
	}
	if ($month[$i]==2){
		$grupoFebreroCheck.="markersArray[$i].setMap(map);";
		$grupoFebreroNoCheck.="markersArray[$i].setMap(null);";
	}
	if ($month[$i]==3){
		$grupoMarzoCheck.="markersArray[$i].setMap(map);";
		$grupoMarzoNoCheck.="markersArray[$i].setMap(null);";
	}
	if ($month[$i]==4){
		$grupoAbrilCheck.="markersArray[$i].setMap(map);";
		$grupoAbrilNoCheck.="markersArray[$i].setMap(null);";
	}
	if ($month[$i]==5){
		$grupoMayoCheck.="markersArray[$i].setMap(map);";
		$grupoMayoNoCheck.="markersArray[$i].setMap(null);";
	}
	if ($month[$i]==6){
		$grupoJunioCheck.="markersArray[$i].setMap(map);";
		$grupoJunioNoCheck.="markersArray[$i].setMap(null);";
	}
	if ($month[$i]==7){
		$grupoJulioCheck.="markersArray[$i].setMap(map);";
		$grupoJulioNoCheck.="markersArray[$i].setMap(null);";
	}
	if ($month[$i]==8){
		$grupoAgostoCheck.="markersArray[$i].setMap(map);";
		$grupoAgostoNoCheck.="markersArray[$i].setMap(null);";
	}
	if ($month[$i]==9){
		$grupoSetiembreCheck.="markersArray[$i].setMap(map);";
		$grupoSetiembreNoCheck.="markersArray[$i].setMap(null);";
	}
	if ($month[$i]==10){
		$grupoOctubreCheck.="markersArray[$i].setMap(map);";
		$grupoOctubreNoCheck.="markersArray[$i].setMap(null);";
	}
	if ($month[$i]==11){
		$grupoNoviembreCheck.="markersArray[$i].setMap(map);";
		$grupoNoviembreNoCheck.="markersArray[$i].setMap(null);";
	}
	if ($month[$i]==12){
		$grupoDiciembreCheck.="markersArray[$i].setMap(map);";
		$grupoDiciembreNoCheck.="markersArray[$i].setMap(null);";
	}
}





$script = "";

for($i=0; $i<$result["Count"]; $i++){
	//$reporteTxt=readReporteTxt1($i);

	//color segun la profundidad
	if($i==0){
		$icono="ico_amarillo.png";
		$zindex=999;
	}
	else{
		$profundidad_valor[$i]=floatval($profundidad_valor[$i]);

		if($profundidad_valor[$i]<=60){
			$icono="ico_rojo.png";
		}

		if($profundidad_valor[$i]>60 and $profundidad_valor[$i]<300){
			$icono="ico_verde.png";
		}

		if($profundidad_valor[$i]>300){
			$icono="ico_azul.png";
		}
		$zindex=999-$i;
	}


	$magnitud_valor[$i]=floatval($magnitud_valor[$i]);
	// Alto y Ancho de la imagen
	if($magnitud_valor[$i]>3 and $magnitud_valor[$i]<=4){
		$ancho=12;
		$alto=12;
	}

	if($magnitud_valor[$i]>4 and $magnitud_valor[$i]<=5){
		$ancho=16;
		$alto=16;
	}

	if($magnitud_valor[$i]>5 and $magnitud_valor[$i]<=6){
		$ancho=20;
		$alto=20;
	}

	if($magnitud_valor[$i]>6 and $magnitud_valor[$i]<=7){
		$ancho=24;
		$alto=24;
	}

	if($magnitud_valor[$i]>7 and $magnitud_valor[$i]<=9){
		$ancho=26;
		$alto=26;
	}
	if($magnitud_valor[$i]>9) {
		$ancho=28;
		$alto=28;
	}


// Tener cuidado de no dejar espacios en blanco
	$script.='
	var markImage'.$i.' = new google.maps.MarkerImage("img/'.$icono.'", null, null, new google.maps.Point('.(float)($ancho/2).', '.(float)($alto/2).'), new google.maps.Size('.$ancho.','. $alto.'));
	var location'.$i.' = new google.maps.LatLng('.floatval($latitud[$i]).','.floatval($longitud[$i]).');
	var marker'.$i.' = new google.maps.Marker({
	position: location'.$i.',
	map: map,
	icon: markImage'.$i.',
	optimized: false,
	zIndex:'.$zindex.'
});
markersArray['.$i.']=marker'.$i.';
var infowindow'.$i.' = new google.maps.InfoWindow(
{ content: "<table><tr><td style=\"padding:0px; font-weight:bold;\">Fecha Local</td><td style=\"padding:0px; \">: '.$day[$i]."/".$month[$i]."/".$year[$i].'</td></tr>'.
'<tr><td style=\"padding:0px; font-weight:bold;\">Hora Local</td><td style=\"padding:0px; \">: '.$horaLocal[$i] .'</td></tr>'.
'<tr><td style=\"padding:0px; font-weight:bold;\">Latitud</td><td style=\"padding:0px; \">: '.$latitud[$i].'</td></tr>'.  // Tener cuidado de no dejar espacios en blanco
'<tr><td style=\"padding:0px; font-weight:bold;\">Longitud</td><td style=\"padding:0px; \">: '.$longitud[$i].'</td></tr>'.
'<tr><td style=\"padding:0px; font-weight:bold;\">Profundidad</td><td style=\"padding:0px; \">: '.$profundidad_valor[$i].' '.$profundidad_unidad[$i].'</td></tr>'.
'<tr><td style=\"padding:0px; font-weight:bold;\">Magnitud</td><td style=\"padding:0px; \">: '.$magnitud_valor[$i].' '.$magnitud_unidad[$i].'</td></tr>'.
'</table>"
});
google.maps.event.addListener(markersArray['.$i.'], \'mouseover\', function() {
infowindow'.$i.'.open(map,markersArray['.$i.']);
});
google.maps.event.addListener(markersArray['.$i.'], \'mouseout\', function() {
infowindow'.$i.'.close(map,markersArray['.$i.']);
});

';

}



//$xajax->registerFunction('mostrarListaSismos');
//$xajax->registerFunction('mostrarPaginador');
//$xajax->registerFunction('mostrarMeses');
$xajax->registerFunction('aux');
$xajax->registerFunction('auxIni');

$xajax->registerFunction('mapasismico');
$xajax->registerFunction('tabla');
$xajax->processRequest();


$xajax->processRequest();

include("../class/ClassPlantilla.php");

$Contenido=new Plantilla("tpl/onlymap");
$Contenido->asigna_variables(array(
	"script" => $script,
	"showbymonth" => $showbymonth,
	"ajax" => $xajax->printJavascript(),
));

$ContenidoString = $Contenido->muestra();
//echo $ContenidoString;

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
//$pdf->SetHeaderData();
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(10, 34, 7,TRUE);


$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page break
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage('P','A4');


$headerResumen=array("Enero", "Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre");
$dataResumen=listMonth();
$pdf->resumeTable($headerResumen, $dataResumen);
$pdf->Ln();

$magnitudes = "img/magnitudes-linea.png";
$pdf->Image($magnitudes);
$pdf->Ln(15);

$profundidades = "img/profundidades-linea.png";
$pdf->Image($profundidades);
$pdf->Ln(15);

$pdf->writeHTML($ContenidoString);


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('sismos_sentidos_test.pdf', 'D');


?>
