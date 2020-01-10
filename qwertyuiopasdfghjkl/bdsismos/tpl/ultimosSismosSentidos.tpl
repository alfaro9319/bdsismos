<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>&Uacute;ltimos simos sentidos - Per&uacute;</title>

    <link rel="stylesheet" href="css/style_dropdowns.css" type="text/css" media="screen, projection"/>
    <!-- Framework CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/paginador.css" type="text/css">    
    <link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print">
    
    <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

    <!-- Import fancy-type plugin for the sample page. -->
    <link rel="stylesheet" href="css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
	{ajax}	     
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.js"></script>       
    <script>
        $(function() {
            $( "#tabs" ).tabs();
        });
    </script>
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
  </head>
  <body onload="xajax_auxIni('20','1'); initialize(); epicentro(); xajax_tabla();">
	<div style="margin:0 auto 0 auto; width:970px; background-image: url(img/006a.gif);">
		<div class="container" style="margin: 0 auto;">
	    	<div id="header" class="cabecera1">
	    		<div class="span-9" style="text-align:center;"><br/><img src="img/logo-minan-igp_2012.png">
	    		</div>
			
	    		<div class="span-11">&nbsp;</div>
	    		<div class="span-4 last"><img src="img/igp-trans.png"></div>
						    							
                            <div class="span-24 last" style="background-image:url('img/004.gif'); background-repeat: repeat-x;" >
                                    <span style="float:left;"><img src="img/002b.gif"></span>
                                    <span style="float:left;" class="link-blanco">&nbsp;&nbsp;&Uacute;ltimos sismos sentidos</span>
                                    <span style="float:right;"><img src="img/003b.gif"></span>
                                    <span style="float:right;">
                                        <a target="_blank" href="http://www.facebook.com/sismosperuigp"><img src="img/facebook.png"/></a>
                                        <a target="_blank" href="http://twitter.com/#!/Sismos_Peru_IGP"><img src="img/twitter.png"  /></a>
                                        <a target="_blank" href="http://groups.google.com/group/sismos-peru-igp"><img src="img/googlegroups.png"  /></a>
                                    </span>
                                    <span style="float:right; padding:8px 10px 0px 0px; font-size:14px; color:#FFFFFF; font-weight:bold;">S&iacute;ganos en:</span>

                            </div>
 </div>
             <div style="background-color:#C48118; text-align:left; border-bottom: 1px solid #C48118; border-top: 1px solid #C48118;">
                 &nbsp;
             </div>
<div id="tabs">
    <ul>
    <li><a href="#tabs-1">Mapa</a></li>
    <li><a href="#tabs-2">Lista</a></li>
    </ul>	
	      
        <div id="tabs-2">
	      <table>
                  <tr>
                    <td width="200px" style="vertical-align: top;">
	      		<div style="padding-left:20px; text-align:left;">
     				Puede seleccionar a continuación los sismos de los meses que quiere visualizar
	      		</div>	      
	      		<hr class="space">
	      		<form id="formMonth" name="formMonth" action="reportMonth.php">
	      		<div id="meses" style="padding-left:10px;">
	      		</div>
	      		</form>
	      		<div style="padding-left:10px; text-align:left;">
				<img style="vertical-align:middle;" width="20px" src="img/pdf.png"/><a class="imprimir" target="_blank" href="#" onclick="formMonth.submit(); return false;"> Archivo con los sismos sentidos de los meses seleccionados</a>
	      		</div>	      		

	      		<hr class="space">
	      		<div style="padding-left:10px; text-align:left;">
				<a class="imprimir" target="_blank" href=report.php><img style="vertical-align:middle;" width="20px" src="img/pdf.png"/> Archivo con los sismos sentidos de este a&ntilde;o</a>
	      		</div>	      		
	      		
                    </td>
                    <td>	      
			<div id="tablaResultados"> </div>
			<div class="paginacion">
                            <div id="paginator" class="wp-pagenavi" style="display: block;">
                            </div>					
			</div>
                    </td>
                </tr>                       
              </table>
        </div>
    <div id="tabs-1">
	      <table>
                  <tr>
                    <td width="200px" style="vertical-align: top;">	      
	      		<div style="padding-left:20px; text-align:left;">
     				Puede seleccionar a continuación los sismos de los meses que quiere visualizar
	      		</div>	      
                        <hr class="space">  

	      		<div id="meses-mapa" style="padding-left:10px;">
	      		</div>

                        
	      		<div id="herramientas" style="padding-left:20px; text-align:left;">
                            <span class="txt-azul">
                                    <a class="imprimir" target="_blank" href="tmp/sismos_sentidos.pdf"><img style="vertical-align:middle;" width="20px" src="img/pdf.png"/> Archivo de mapas con los sismos sentidos por mes</a>
                            </span>
	      		</div>	      		
                        
                    </td>
                    <td>
                        <div style="position:relative">
                            <div id="map"> </div>
                            <div style="position:absolute; left: 10px; top: 480px;"><img src="img/magnitudes.png"></div>
                            <div style="position:absolute; left: 10px; top: 10px;"><img src="img/profundidades.png"></div>
                    </td>
                  </tr>
                  </table>

	      
    </div>  
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
