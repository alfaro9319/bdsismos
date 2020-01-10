<?php
/**** PHP *****/

  //date_default_timezone_set('America/Lima');
  require ("class/dbconnect.php");
    //session_start();
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


  function reporteSismo(){
    //Leemos de la base de datos
    $result=readSismo();


    if (isset($result["Count"]) && ($result["Count"] == 1)) {
      # code...
      $xml = simplexml_load_string($result["parameters"][0]);
    }


    //JSON
    $json = json_encode($xml);
    echo($json);
    /*$array = json_decode($json,TRUE);
    echo '<pre>';
        print_r($array);
    echo '</pre>';*/

  }

  reporteSismo();

?>

<?php

  /*for($i=0; $i<$result["Count"]; $i++){



        $xmlt = simplexml_load_string($result["parameters"][$i]);
          echo '<pre>';
            print_r($xmlt);
          echo '</pre>';

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
    }*/

?>



