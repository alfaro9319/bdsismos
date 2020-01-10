<?php
require ('/data/paginasweb/bdsismos/class/dbconnect.php');
require("sismosSentidosModel.php");
require_once('/data/paginasweb/bdsismos/class/tcpdf/config/lang/eng.php');
require_once('/data/paginasweb/bdsismos/class/tcpdf/tcpdf.php');

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
		$this->Cell(0, 5, '', 0, false, 'C', 0, '', 0, false, 'M', 'B');
		$this->Ln();
		$this->SetFont('dejavusans', 'B', 18);
		$this->Cell(0, 10, 'Mapas sísmicos por mes', 0, false, 'C', 0, '', 0, false, 'M', 'T');
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
		$this->Image("/data/paginasweb/bdsismos/img/magnitudes-linea.png", 10, 38, 0, 0, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->Ln();
		$this->Image("/data/paginasweb/bdsismos/img/profundidades-linea.png", 10, 50, 0, 0, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->SetFont('dejavusans', 'B', 20);
		$this->Cell(0, 10, '', 0, false, 'C', 0, '', 0, false, 'M', 'B');
	}
	
}


function seismicMap($seismicData){
	$map_path="/data/paginasweb/bdsismos/map/";
	$map = new shapeObj($map_path."sudamerica.map");
	$totalSeismicData = count($seismicData["idlistasismos"]);


	$arrayMonth = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre",);
	$numberMonth=date("n",strtotime($seismicData["fecha_local"][0]));
	$text=$arrayMonth[$numberMonth];
	
	labelMonth($map,$text);
		
	for($i = 0; $i < $totalSeismicData; ++$i) {
		epicenterPoint($map,$seismicData["longitud"][$i],$seismicData["latitud"][$i],$seismicData["magnitud"][$i],$seismicData["profundidad"][$i]);
	}
	$image=$map->draw();
	$image_url=$image->saveWebImage();
	return $image_url;
}

function labelMonth($objectMap,$text){
	
	// Create another layer to hold point locations
	$oLayerLabel = ms_newLayerObj($objectMap);
	$oLayerLabel->set( "name", "Label Month");


	$oLayerLabel->set( "type", MS_LAYER_POINT);
	$oLayerLabel->set( "status", MS_DEFAULT);
	
	$oCoordList = ms_newLineObj();
	$oAnnotation = ms_newShapeObj(MS_SHAPE_POINT);
	$oCoordList->addXY(-84.5,0.5);
	$oAnnotation->add($oCoordList);
	$oAnnotation->set( "text", $text);
	
	$oLayerLabel->addFeature($oAnnotation);
	
	// Create a class object to set feature drawing styles.
	$oMapClass = ms_newClassObj($oLayerLabel);
	$oMapClass->label->set( "position", MS_CR);
	$oMapClass->label->set( "font", "DejaVuSans");
	$oMapClass->label->set( "type", "truetype");
	$oMapClass->label->set( "size", "16");
	$oMapClass->label->color->setRGB(0,0,0);
	$oMapClass->label->outlinecolor->setRGB(255,255,255);
	$oPointStyle = ms_newStyleObj($oMapClass);
	
	
}


function epicenterPoint($objectMap,$x,$y,$mag,$prof){

	// Create another layer to hold point locations
	$oLayerPoints = ms_newLayerObj($objectMap);
	$oLayerPoints->set( "name", "custom_points");
	$oLayerPoints->set( "type", MS_LAYER_POINT);
	$oLayerPoints->set( "status", MS_DEFAULT);

	$oCoordList = ms_newLineObj();
	$oPointShape = ms_newShapeObj(MS_SHAPE_POINT);
	$oCoordList->addXY($x,$y);
	$oPointShape->add($oCoordList);
	//$oPointShape->set( "text", "PERU....................");

	$oLayerPoints->addFeature($oPointShape);

	// Create a class object to set feature drawing styles.
	$oMapClass = ms_newClassObj($oLayerPoints);
	// Create a style object defining how to draw features
	$oPointStyle = ms_newStyleObj($oMapClass);

	if($prof<=60){
		$oPointStyle->color->setRGB(255,0,0);
	}

	if($prof>60 and $prof<300){
		$oPointStyle->color->setRGB(0,255,0);
	}

	if($prof>300){
		$oPointStyle->color->setRGB(0,0,255);
	}


	if($mag>3 and $mag<=4){
		$size=12;
	}

	if($mag>4 and $mag<=5){
		$size=16;
	}

	if($mag>5 and $mag<=6){
		$size=20;
	}

	if($mag>6 and $mag<=7){
		$size=24;
	}

	if($mag>7 and $mag<=9){
		$size=24;
	}
	if($mag>9) {
		$size=28;
	}
	
   	$oPointStyle->outlinecolor->setRGB(0, 0, 0);
	$oPointStyle->set( "symbolname", "circle");
	$oPointStyle->set( "size", $size);	
	
}



// create new PDF dDefine los márgenes izquierdo, superior, y derecho. Por defecto, son iguales a 1 cm. Invoque este método para cambiarlas. ocument
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
$pdf->SetMargins(10, 20, 7,TRUE);


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


$headerResume=array("Enero", "Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre");
$dataResume=listMonth();
$pdf->resumeTable($headerResume, $dataResume);

$pdf->Ln();
//Data loading

// Creating map

for ($i=1; $i<13; $i++){
	$data=readListSismos("FilterMonth-Asc",$pageSize="",$currentPage="",$valOption=$i);
	if($data["Count"]>0){
		$pathImage=seismicMap($data);
		$pdf->Image("/data/paginasweb/bdsismos/".$pathImage,"","",0,0,"","","",false,300,"",false,false,1) ;
		$pdf->Ln();
		
		//$pdf->SetFont('helvetica', '', 20);
		
		//$pdf->SetDrawColor(200,0,0);
		//$pdf->SetTextColor(200,0,0);
		
		//$pdf->StartTransform();
		//$pdf->Rotate(50, 150, 150);
		//$pdf->Rect(150, 150, 60, 10, 'D');
		//$pdf->Text(155, 150, 'Sin valor oficial');
		//$pdf->SetDrawColor(0,0,0);
		//$pdf->StopTransform();
                //$pdf->Text(155, 150 + 5*$i,$pathImage );
		$pdf->Ln();
	}
}

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('/data/paginasweb/bdsismos/tmp/sismos_sentidos.pdf', 'F');
exec("rm -rf /data/paginasweb/bdsismos/tmp/*.png");

?>

