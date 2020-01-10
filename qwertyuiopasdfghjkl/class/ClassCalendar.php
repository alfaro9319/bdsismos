<?php
class calendar{

	function createCalendar($an,$me, $contenido,$idioma) {
		if ($idioma=='es'){
    		$meses = array(1=>"Enero",2=>"Febrero",3=>"Marzo",
    			   	4=>"Abril",5=>"Mayo",6=>"Junio",7=>"Julio",8=>"Agosto",9=>"Setiembre",
    				10=>"Octubre",11=>"Noviembre",12=>"Diciembre");

    		$tcal="<table bgcolor='#FFFFFF'; border='0' cellpadding='3' cellspacing='0'>\n
    		<tr><td colspan='7' align='center'>".$meses[$me]."</td></tr>\n
    		<tr><td align='center'>D</td><td align='center'>L</td><td align='center'>M</td><td align='center'>M</td>
    		<td align='center'>J</td><td align='center'>V</td><td align='center'>S</td></tr>\n";
		}
		else{
    		$meses = array(1=>"January",2=>"February",3=>"March",
    			   	4=>"April",5=>"May",6=>"June",7=>"July",8=>"August",9=>"September",
    				10=>"October",11=>"November",12=>"December");

    		$tcal="<table bgcolor='#FFFFFF'; border='0' cellpadding='3' cellspacing='0'>\n
			<tr><td colspan='7' align='center'>".$meses[$me]."</td></tr>\n
			<tr><td align='center'>S</td><td align='center'>M</td><td align='center'>T</td><td align='center'>W</td>
			<td align='center'>T</td><td align='center'>F</td><td align='center'>S</td></tr>\n";
		}
		$di=1; 
		$fechaActual = mktime(0,0,0,$me,$di,$an);
		$diaMes = date("t",$fechaActual);

		$diaSemana=date("w",mktime(0,0,0,$me,1,$an));
	
		if ($diaSemana != 0) {
			$tcal.= "<tr>";
			for ($i = 0; $i < $diaSemana; $i++) {
				$tcal.="<td>&nbsp;</td>";
			}
		}
	
		for ($i=1; $i<=$diaMes; $i++) {
			$diaSemana=date("w",mktime(0,0,0,$me,$i,$an));
	
			if ($diaSemana == 0) {
				$tcal.="<tr>\n";
			}
			
			$tcal.= "<td align='center'>".$contenido[$i]."</td>";
	
			if ($diaSemana == 6) {
				$tcal.= "</tr>\n";
			}
		}
	
		for ($i = $diaSemana; $i < 6; $i++) {
			$tcal.= "<td> ";
		}
		$tcal.= "</tr></table>";
	
		return $tcal;
	}
	
}
?>
