<?php

	function findCity($lat0, $lon0){
		$lat0 = (float)$lat0;
		$lon0 = (float)$lon0;
		$dist0 = 100000000;
		$city0 = 'Unknown';
		$lines = file('dat/locations.dat');
		for ($i = 0; $i < sizeof($lines); ++$i){
			list($city,$location) = explode('|', $lines[$i]);
			list($lat1,$lon1) = explode(',',$location);
			$lat1 = (float)$lat1;
		        $lon1 = (float)$lon1;
			$dist=sqrt(pow($lat1-$lat0,2)+pow($lon1-$lon0,2));
			if ($dist<$dist0){
				$dist0=$dist;
				$city0=$city;
				$nlat=$lat1;
				$nlon=$lon1;
				$angle=rad2deg(atan2($lat1-$lat0, $lon1-$lon0))+180;
				if($angle<0){$angle+=360;}
			}
		}
		if ($angle>337.5 or $angle<22.5){$ori='E';}
		elseif ($angle>22.5 and $angle<67.5){$ori='NE';}
		elseif ($angle>67.5 and $angle<112.5){$ori='N';}
		elseif ($angle>112.5 and $angle<157.5){$ori='NO';}
		elseif ($angle>157.5 and $angle<202.5){$ori='O';}
		elseif ($angle>202.5 and $angle<247.5){$ori='SO';}
		elseif ($angle>247.5 and $angle<292.5){$ori='S';}
		elseif ($angle>292.5 and $angle<337.5){$ori='SE';}
		else {$ori='';}
		$dist_km = substr((string)$dist0*111,0,4);
		$dist_km = round($dist_km);
		return $dist_km.' Km al '.$ori.' de '.$city0;

	}


	function findCities($lat0, $lon0){
		$lat0 = (float)$lat0;
		$lon0 = (float)$lon0;
		$city0 = 'Unknown';
		$lines = file('dat/locations.dat');
		for ($i = 0; $i < sizeof($lines); ++$i){
			list($city,$location) = explode('|', $lines[$i]);
			list($lat1,$lon1) = explode(',',$location);
			$lat1 = (float)$lat1;
			$lon1 = (float)$lon1;
			$dist=sqrt(pow($lat1-$lat0,2)+pow($lon1-$lon0,2));
	
	
			$angle=rad2deg(atan2($lat1-$lat0, $lon1-$lon0))+180;
			if($angle<0){
				$angle+=360;
			}
				
				
			if ($angle>337.5 or $angle<22.5){
				$ori='E';
			}
			elseif ($angle>22.5 and $angle<67.5){
				$ori='NE';
			}
			elseif ($angle>67.5 and $angle<112.5){
				$ori='N';
			}
			elseif ($angle>112.5 and $angle<157.5){
				$ori='NO';
			}
			elseif ($angle>157.5 and $angle<202.5){
				$ori='O';
			}
			elseif ($angle>202.5 and $angle<247.5){
				$ori='SO';
			}
			elseif ($angle>247.5 and $angle<292.5){
				$ori='S';
			}
			elseif ($angle>292.5 and $angle<337.5){
				$ori='SE';
			}
			else {$ori='';
			}
	
			$dist_km = substr((string)$dist*111,0,4);
			$dist_km = round($dist_km);
				
			$arrayCities[$i]=array("Location"=>"$lon1,$lat1,$city","Distance" => $dist_km, "Text" => $dist_km.' Km al '.$ori.' de '.$city );
				
		}
	
	
		return $arrayCities;
	
	}
	
	
	function moc($lat0, $lon0){
		$lat0 = (float)$lat0;
		$lon0 = (float)$lon0;
		$lines = file('dat/litoral.dat');
		for ($i = 2; $i < count($lines); ++$i){
			$longitud = substr($lines[$i],0,6);
			$latitud = substr($lines[$i],7);

			if((float)$latitud< $lat0){
				$X1= (float)substr($lines[$i-1],0,6);
				$Y1= (float)substr($lines[$i-1],7);
				$X2= (float)$longitud;
				$Y2= (float)$latitud;
				break;
			}
		}
		
		if(isset($X1) and isset($Y1) and isset($X2) and isset($Y2)){
			$X = ($X2-$X1)*($lat0-$Y1)/($Y2-$Y1) + $X1;
		}


		if (isset($X)){
			if($lon0<$X){
				return "Mar";
			}
			else{
				return "Continente";	
			}
		}
		else{
			return " ";
		}
	}


	
	
	function readSismo(){
	
		$dbh=conn("sismos","wmaster","igpwmaster");
		$dbh->query("SET NAMES 'utf8'");
		$sql = "SELECT * FROM datasismos WHERE idsismos >= (SELECT idsismos FROM datasismos WHERE category='P' ORDER BY idsismos DESC LIMIT 1) ORDER BY idsismos ASC";
	
		
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
	
	
?>