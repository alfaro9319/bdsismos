<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Último Sismo - Perú</title>
<meta name="description" content="Reporte del Último Sismo sentido en el Perú, elaborado por el Instituto Geofísico del Perú">
<link type="text/css" rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print">
<link href="css/ui-lightness/jquery-ui-1.8.14.custom.css" rel="Stylesheet" type="text/css" />
<!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
<!-- Import fancy-type plugin for the sample page. -->
<link rel="stylesheet" href="css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<script type='text/javascript' src='js/jquery.min.js'></script>
<script type="text/javascript" src="js/jquery-ui-1.8.14.custom.min.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type='text/javascript' src='js/OpenLayers.js'></script>
<script type="text/javascript" src="js/sismo.js"></script> 

</head>
<body onload="horaActual({hora_actual},{minuto_actual},{segundo_actual}); mapaSismo('{longitud_sismo}','{latitud_sismo}'); mapaSismoDetalle('{longitud_sismo}','{latitud_sismo}');  {codigo_sonido}"> 

	<div style="margin:0 auto 0 auto; width:970px; background-image: url(img/006a.gif);">
		<div class="container" style="margin: 0 auto;">
	    	<div id="header" class="cabecera1">
	    		<div class="span-9" style="text-align:center;"><br/><img src="img/logo-minan-igp_2012.png">
	    		</div>
			
	    		<div class="span-11">&nbsp;</div>
	    		<div class="span-4 last"><img src="img/igp-trans.png"></div>
						    							
					<div class="span-24 last" style="background-image:url('img/004.gif'); background-repeat: repeat-x;" >
						<span style="float:left;"><img src="img/002b.gif"></span>
						<span style="float:left;" class="link-blanco">&nbsp;&nbsp;Reporte s&iacute;smico{numero_reporte_sismo}</span>
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
	      <div class="prepend-1 span-7" >
	      		<div style="text-align:left;">
     				
					<table cellspacing="0" cellpadding="0" border="0" align="center" class="tablacebra">
					<tr class="cab"><td colspan="2">Parámetros Hipocentrales</td></tr>
					<tr class="cebra"><td>Fecha Local</td><td>{fecha_local_sismo}</td></tr>
					<tr class="cebra"><td>Hora Local</td><td>{hora_local_sismo}</td></tr>
					<tr class="cebra"><td>Latitud</td><td>{latitud_sismo}</td></tr>
					<tr class="cebra"><td>Longitud</td><td>{longitud_sismo}</td></tr>
					<tr class="cebra"><td>Profundidad</td><td>{profundidad_sismo}</td></tr>
					<tr class="cebra"><td>Referencia</td><td>{epicentro_sismo}.<br>{referencia_sismo}</td></tr>
					<tr class="cebra"><td>Magnitud</td><td>{magnitud_sismo}</td></tr>
					<tr class="cebra"><td>Intensidad</td><td>{intensidad_sismo}</td></tr>
					<tr class="cebra"><td>Fecha UTC</td><td>{fecha_sismo}</td></tr>
					<tr class="cebra"><td>Hora UTC</td><td>{hora_sismo}</td></tr>
					</table>
					 <div style="font-size:44px; color:red; font-weight:bold; padding: 0px 0px 5px 0px;">SIMULACRO</div>
					<div style="width:260px; padding: 5px 5px 5px 5px; text-align:center; font-size:16px; font-weight:bold; background-color:#EEEEEE">
						<div>Fecha y hora actual</div>
						<span>{fecha_actual}&nbsp;&nbsp;&nbsp;&nbsp;</span><span id="contenedor_reloj"></span>
					</div>
					<br/>
					<div style="text-align:center; width:260px; padding: 5px 5px 5px 5px; background-color:#EEEEEE">
						<a href=# onclick="showMap(); return false;">Mapa Detallado</a>
					</div>
                                        <br/>
					<div style="text-align:center; width:260px; padding: 5px 5px 5px 5px; background-color:#EEEEEE">
						<a style="color:blue" href="http://ultimosismo.igp.gob.pe/bdsismos/ultimosSismosSentidos.php" target="_blank" >Ultimos Sismos Sentidos</a>
					</div>
                                        
					<div id="player"></div>
					
					<div>{link_replicas}</div>
					<div id="dialog" title="Réplicas" style="display:none">{replicas}</div>

	      		</div>	      
	      </div>
	      <div class="span-14 last">
				<div id="map_element" style="height:600px; width:600px;"></div>
				<div id="map_detail" style="display:none;height:500px; width:800px;"></div>
				<hr class="space">
	      </div>

	      
	      <div class="span-24 contenedor-pie">
	      	    <br>
				<p>Central Telefónica: 317-2300 | Portal Institucional: 
				<a class="mostaza" href="http://www.igp.gob.pe">http://www.igp.gob.pe</a>
				</p>
				      
	      </div>
		</div>
	</div>
</body>
</html>
