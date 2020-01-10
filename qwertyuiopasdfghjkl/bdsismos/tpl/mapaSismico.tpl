<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Mapa S&iacute;smico - Per&uacute;</title>

    <link rel="stylesheet" href="css/style_dropdowns.css" type="text/css" media="screen, projection"/>
    <!-- Framework CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/paginador.css" type="text/css">    
    <link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print">
    <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
    <!-- Import fancy-type plugin for the sample page. -->
    <link rel="stylesheet" href="css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
	<style type="text/css">
		#map {
		height:550px;
		width:660px;
	</style>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&amp;libraries=places"></script>
	<script type="text/javascript" src="js/googlemaps.js"></script>
	<script type="text/javascript">
	function epicentro(){
		{script}
	}
	
	{showbymonth}
	
	</script>
	
	
	{ajax}
  </head>
  <body onload="initialize(); epicentro(); xajax_tabla();">
	<div style="margin:0 auto 0 auto; width:970px; background-image: url(img/006a.gif);">
		<div class="container" style="margin: 0 auto;">
	    	<div id="header" class="cabecera1">
	    		<div class="span-9" style="text-align:center;"><br/><img src="img/logo-minan-igp_2012.png">
	    		</div>
			
	    		<div class="span-11">&nbsp;</div>
	    		<div class="span-4 last"><img src="img/igp-trans.png"></div>
						    							
					<div class="span-24 last" style="background-image:url('img/004.gif'); background-repeat: repeat-x;" >
						<span style="float:left;"><img src="img/002b.gif"></span>
						<span style="float:left;" class="link-blanco">&nbsp;&nbsp;Mapa s&iacute;smico</span>
						<span style="float:right;"><img src="img/003b.gif"></span>
						<span style="float:right;">
							<a target="_blank" href="http://www.facebook.com/sismosperuigp"><img src="img/facebook.png"/></a>
							<a target="_blank" href="http://twitter.com/#!/Sismos_Peru_IGP"><img src="img/twitter.png"  /></a>
							<a target="_blank" href="http://groups.google.com/group/sismos-peru-igp"><img src="img/googlegroups.png"  /></a>
						</span>
						<span style="float:right; padding:8px 10px 0px 0px; font-size:14px; color:#FFFFFF; font-weight:bold;">S&iacute;ganos en:</span>
											
					</div>
             </div>
             <div style="background-color:#C48118; text-align:right; border-bottom: 1px solid #C48118; border-top: 1px solid #C48118;">
					&nbsp;
             </div>
	
	      <hr class="space">
	      <div class="span-6" >
	      		<div style="padding-left:20px; text-align:left;">
     				Puede seleccionar a continuación los sismos de los meses que quiere visualizar
	      		</div>	      
	      		<hr class="space">
	      		<form id="formMonth" name="formMonth">
	      		<div id="meses" style="padding-left:10px;">
	      		</div>
	      		</form>
	      		<hr class="space">
	      		<div id="herramientas" style="padding-left:20px; text-align:left;">
      			
					<span class="txt-azul">
						<a class="imprimir" target="_blank" href="tmp/sismos_sentidos.pdf"> Archivo con los mapas por mes <img style="vertical-align:middle;" width="20px" src="img/pdf.png"/></a>
					</span>
	      		</div>	      		
	      		
	      </div>
	      <div style="position:relative"  class="span-17 last">
				<div id="map"> </div>
				<div style="position:absolute; left: 10px; top: 480px;"><img src="img/magnitudes.png"></div>
				<div style="position:absolute; left: 10px; top: 10px;"><img src="img/profundidades.png"></div>
				<hr class="space">
	      </div>

	      
	      <div class="span-24 contenedor-pie">
	      	    <br>
				<p>Calle Badajoz # 169 - Mayorazgo IV Etapa - Ate Vitarte | Central Telefónica: 317-2300 |
				<a class="mostaza" href="#">Contacto</a>| Escríbenos a: <a class="mostaza" href="mailto:web@igp.gob.pe">web@igp.gob.pe</a>
				</p>
				      
	      </div>
		</div>
	</div>
	
  </body>
</html>
