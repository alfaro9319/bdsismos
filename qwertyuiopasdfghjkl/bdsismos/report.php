<?php
require ('../class/dbconnect.php');
require("sismosSentidosModel.php");
require_once('../class/tcpdf/config/lang/eng.php');
require_once('../class/tcpdf/tcpdf.php');

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
		$this->Cell(0, 10, 'Reporte de los últimos sismos sentidos', 0, false, 'C', 0, '', 0, false, 'M', 'T');

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
//Column titles
$header=array("Fecha Local","Hora Local","Latitud","Longitud","Prof. (km)","Mag.","Intensidad - Localidades");
//Data loading
$data=readListSismos("All",$pageSize=50,$currentPage=1);

// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('sismos_sentidos.pdf', 'D');


?>

