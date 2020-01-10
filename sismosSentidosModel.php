<?php

	function paginatorConstruct($page,$ipp,$total){
		$pages = new Paginator;
		$pages->items_total = $total;
		$pages->mid_range = 9;
	
		$function="xajax_aux";
		$pages->paginatePlus($ipp,$page,$function,"xajax.getFormValues('formMonth')");
		
		$html="<center><div class=\"ui pagination menu\">";
		$html.= $pages->display_pages();
		$html.= "</div></center>";
		return $html;
	}

	
	function listMonth(){
	
		$dbh=conn("sismos","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		$where = " AND publicado='1' ";
		//$sql = "SELECT MONTH(fecha_local) AS mes, COUNT(*) AS cantidad FROM listasismos WHERE YEAR(fecha_local)= ".date('Y').$where."  GROUP BY MONTH(fecha_local) ORDER BY MONTH(fecha_local)";
		$sql = "SELECT MONTH(fecha_local) AS mes, COUNT(*) AS cantidad FROM listasismos WHERE (YEAR(fecha_local)=2019 or YEAR(fecha_local)=2020) ".$where."  GROUP BY MONTH(fecha_local) ORDER BY MONTH(fecha_local)";

		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["mes"][$i]= $row["mes"];
				$result["cantidad"][$i]= $row["cantidad"];
				$i++;
			}
	
	
			if(isset($result["mes"])){
				$result["Count"]=count($result["mes"]);
			}
			else{
				$result["Count"]=0;
			}
	
			$result["Error"]=0;
	
		}
		else{
			$result["Error"]=1;
		}
	
		$dbh = null;
		$result["Query"]=$sql;
	
		return $result;
	
	}	
	
	
	function listSismo($pageSize=10,$currentPage=1,$option="Limit"){
	
		$dbh=conn("sismos","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		
		$limitIni=($currentPage-1)*$pageSize;
		if ($option=="All"){
			$sql = "SELECT * FROM datasismos WHERE list=1 ORDER BY idsismos DESC";
		}
		else {
			//$sql = "SELECT * FROM datasismos WHERE list=1 AND YEAR(fecha_local) = ".date("Y")." ORDER BY idsismos DESC LIMIT $limitIni,$pageSize";
			$sql = "SELECT * FROM datasismos WHERE list=1 AND (YEAR(fecha_local)=2019 or YEAR(fecha_local)=2020) ORDER BY idsismos DESC LIMIT $limitIni,$pageSize";
		}
	
		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["idsismos"][$i]= $row["idsismos"];
				$result["datepub"][$i]= $row["datepub"];
				$result["report_type"][$i] = $row["report_type"];
				$result["category"][$i] = $row["category"];
				$result["list"][$i] = $row["list"];
				$result["parameters"][$i] = $row["parameters"];
				$i++;
			}
	
	
			if(isset($result["idsismos"])){
				$result["Count"]=count($result["idsismos"]);
			}
			else{
				$result["Count"]=0;
			}
	
			$result["Error"]=0;
	
		}
		else{
			$result["Error"]=1;
		}
	
		$dbh = null;
		$result["Query"]=$sql;
	
		return $result;
	
	}	
	
	function readListSismos($option,$pageSize=10,$currentPage=1,$valOption=""){
	
		$dbh=conn("sismos","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		//$where = " AND publicado='1' ";
		$where = " AND publicado='1' and (YEAR(fecha_local)=2019 or YEAR(fecha_local)=2020)";
		$limitIni=($currentPage-1)*$pageSize;
		if ($option=="All"){
			$sql = "SELECT * FROM listasismos WHERE 1=1".$where." ORDER BY fecha_local DESC, hora_local DESC";
		}
		elseif ($option=="All-Asc"){
			$sql = "SELECT * FROM listasismos WHERE 1=1".$where." ORDER BY fecha_local ASC, hora_local ASC";
		}
		elseif ($option=="Limit"){
			$sql = "SELECT * FROM listasismos WHERE 1=1".$where." ORDER BY fecha_local DESC, hora_local DESC LIMIT $limitIni,$pageSize";
		}
		elseif ($option=="FilterMonth"){
			$sql = "SELECT * FROM listasismos WHERE 1=1".$where." AND MONTH(fecha_local) IN ($valOption)  ";
			$sql.= "ORDER BY fecha_local DESC, hora_local DESC";
		}
		elseif ($option=="FilterMonth-Asc"){
			$sql = "SELECT * FROM listasismos WHERE 1=1".$where." AND MONTH(fecha_local)= $valOption  ";
			$sql.= "ORDER BY fecha_local ASC, hora_local ASC";
		}
		elseif ($option=="FilterMonthLimit"){
			$sql = "SELECT * FROM listasismos WHERE 1=1".$where." AND MONTH(fecha_local) IN ($valOption) ";
			$sql.= "ORDER BY fecha_local DESC, hora_local DESC LIMIT $limitIni,$pageSize";
		}		
	
		if($dbh->query($sql)){
			$i=0;
			foreach($dbh->query($sql) as $row) {
				$result["idlistasismos"][$i]= $row["idlistasismos"];
				$result["numero_reporte"][$i]= $row["numero_reporte"];
				$result["fecha_local"][$i]= $row["fecha_local"];
				$result["hora_local"][$i] = $row["hora_local"];
				$result["latitud"][$i] = $row["latitud"];
				$result["longitud"][$i] = $row["longitud"];
				$result["magnitud"][$i] = $row["magnitud"];
				$result["profundidad"][$i] = $row["profundidad"];
				$result["referencia"][$i] = $row["referencia"];
				$result["intensidad"][$i] = $row["intensidad"];
				$result["tipomagnitud"][$i] = $row["tipomagnitud"];
				$result["informe"][$i] = $row["informe"];
				$result["mapa"][$i] = $row["mapa"];
				$i++;
			}
	
	
			if(isset($result["idlistasismos"])){
				$result["Count"]=count($result["idlistasismos"]);
			}
			else{
				$result["Count"]=0;
			}
	
			$result["Error"]=0;
	
		}
		else{
			$result["Error"]=1;
		}
	
		$dbh = null;
		$result["Query"]=$sql;
	
		return $result;
	
	}	
?>
