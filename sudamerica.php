    <?php

//    dl('php_mapscript.so');
//if (!extension_loaded("MapScript")) dl('php_mapscript.'.PHP_SHLIB_SUFFIX);
    $map_path="map/";
    $map = ms_newMapObj($map_path."sudamerica.map");
    

    // Create a map symbol, used as a brush pattern
    // for drawing map features (lines, points, etc.)
    /*
    $nSymbolId = ms_newSymbolObj($map, "circlered");
    $oSymbol = $map->getsymbolobjectbyid($nSymbolId);
    $oSymbol->set("type", MS_SYMBOL_ELLIPSE);
    $oSymbol->set("filled", MS_TRUE);
    $aPoints[0] = 1;
    $aPoints[1] = 1;
    $oSymbol->setpoints($aPoints);    
    */
    
    /*
    // Create label settings for drawing text labels
    $oMapClass->label->set( "position", MS_AUTO);
    $oMapClass->label->set( "font", "ubuntu");
    $oMapClass->label->set( "type", "truetype");
    $oMapClass->label->set( "size", "20");
    $oMapClass->label->color->setRGB(250,0,0);
    $oMapClass->label->outlinecolor->setRGB(255,255,255);        
    */
 
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
    
    
    //$oPointStyle->outlinecolor->setRGB(255,255,255);
    $oPointStyle->set( "symbolname", "circle");
    $oPointStyle->set( "size", $size);    
	

}



    epicenterPoint($map,-77,-12,5,10);
    epicenterPoint($map,-80,-12,5,500);
    
    $image=$map->draw();
    $image_url=$image->saveWebImage();

    ?>

     <HTML>
      <HEAD>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          <TITLE>SUDAMERICA</TITLE>
      </HEAD>
      <BODY>
          <IMG SRC=<?php echo $image_url; ?> >
      </BODY>
     </HTML>


