<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="Reporte del Último Sismo sentido en el Perú, elaborado por el Instituto Geofísico del Perú">



<!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">


<title>Último Sismo - Perú</title>


<link href="css/ui-lightness/jquery-ui-1.8.14.custom.css" rel="Stylesheet" type="text/css" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<!-- Framework CSS -->
<!--<link rel="stylesheet" href="css/style.css" type="text/css">-->
<!--<link rel="stylesheet" href="css/paginador.css" type="text/css">-->
<link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print">
<!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
<!-- Import fancy-type plugin for the sample page. -->
<link rel="stylesheet" href="css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
<!--<script type='text/javascript' src='js/jquery.min.js'></script>-->
<script type='text/javascript' src="js/library/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.14.custom.min.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type='text/javascript' src='js/OpenLayers.js'></script>
<script type='text/javascript' src='js/sismo.js'></script>
<script type='text/javascript' src='js/semantic.min.js'></script>



















  
  <link rel="stylesheet" type="text/css" href="css/semantic_reset.css">
  <link rel="stylesheet" type="text/css" href="css/semantic_site.css">
  <link rel="stylesheet" type="text/css" href="css/semantic_style.css">
  <link rel="stylesheet" type="text/css" href="css/semantic.min.css">
  <style type="text/css">

    .hidden.menu {
      display: none;
    }

    .masthead.segment {
      min-height: 700px;
      padding: 1em 0em;
    }
    .masthead .logo.item img {
      margin-right: 1em;
    }
    .masthead .ui.menu .ui.button {
      margin-left: 0.5em;
    }
    .masthead h1.ui.header {
      margin-top: 3em;
      margin-bottom: 0em;
      font-size: 4em;
      font-weight: normal;
    }
    .masthead h2 {
      font-size: 1.7em;
      font-weight: normal;
    }

    .ui.vertical.stripe {
      padding: 8em 0em;
    }
    .ui.vertical.stripe h3 {
      font-size: 2em;
    }
    .ui.vertical.stripe .button + h3,
    .ui.vertical.stripe p + h3 {
      margin-top: 3em;
    }
    .ui.vertical.stripe .floated.image {
      clear: both;
    }
    .ui.vertical.stripe p {
      font-size: 1.33em;
    }
    .ui.vertical.stripe .horizontal.divider {
      margin: 3em 0em;
    }

    .quote.stripe.segment {
      padding: 0em;
    }
    .quote.stripe.segment .grid .column {
      padding-top: 5em;
      padding-bottom: 5em;
    }

    .footer.segment {
      padding: 5em 0em;
    }

    .secondary.pointing.menu .toc.item {
      display: none;
    }

    @media only screen and (max-width: 700px) {
      .ui.fixed.menu {
        display: none !important;
      }
      .secondary.pointing.menu .item,
      .secondary.pointing.menu .menu {
        display: none;
      }
      .secondary.pointing.menu .toc.item {
        display: block;
      }
      .masthead.segment {
        min-height: 350px;
      }
      .masthead h1.ui.header {
        font-size: 2em;
        margin-top: 1.5em;
      }
      .masthead h2 {
        margin-top: 0.5em;
        font-size: 1.5em;
      }
    }


  .masthead.segment {
    min-height: 50px !important;
    padding: 1em 0em;
  }


  </style>

  <script>
  $(document)
    .ready(function() {

      // fix menu when passed
      $('.masthead')
        .visibility({
          once: false,
          onBottomPassed: function() {
            $('.fixed.menu').transition('fade in');
          },
          onBottomPassedReverse: function() {
            $('.fixed.menu').transition('fade out');
          }
        })
      ;

      // create sidebar and attach to menu open
      $('.ui.sidebar')
        .sidebar('attach events', '.toc.item')
      ;

    })
  ;
  </script>

</head>
<body onload="horaActual({hora_actual},{minuto_actual},{segundo_actual}); mapaSismo('{longitud_sismo}','{latitud_sismo}');  mapaSismoDetalle('{longitud_sismo}','{latitud_sismo}'); {codigo_sonido}">
<!-- GOOGLE ANALYTIC -->
<script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-89323028-1', 'auto');
  ga('send', 'pageview');

</script>


 
<div class="pusher"> 

<div class="ui container topcontent-logos">
    <div id="header-igp-ant" class="row nomargin page-header-log">
        <div id="logo-minam-ant">
          <div class="logo-minam-1">
              <a href="/" title="Inicio" rel="home">
                  <img class="img-responsive" src="http://portal.igp.gob.pe/sites/all/themes/tema_igp/images/minam.png" alt="IGP Logo">
               </a>
          </div>
        </div>

        <div id="logo-igp-ant">
            <a href="http://www.igp.gob.pe" target="_blank" rel="IGP" title="Portal web - IGP">
                <img class="img-responsive" src="http://portal.igp.gob.pe/sites/all/themes/tema_igp/images/igp.png">
            </a>
        </div>
    </div>
</div>

<div class="ui container">
  <div class="delimitador-top"></div>
</div>
   

  <div class="ui segment container">
   <div class="ui grid">
      <div class="eleven wide column"><h1 style="color:{magnitud_sismo_color_hex} !important">&Uacute;LTIMO SISMO</h1></div>
      
      <div class="four wide column">
          <span style="float:right;">Síganos en:
            <a target="_blank" href="http://www.facebook.com/sismosperuigp"><img src="img/facebook.png"></a>
            <a target="_blank" href="http://twitter.com/#!/Sismos_Peru_IGP"><img src="img/twitter.png"></a>
            <a target="_blank" href="http://groups.google.com/group/sismos-peru-igp"><img src="img/googlegroups.png"></a>
            </span>
      </div>
    </div>
  
    <div class="ui middle aligned stackable grid container">
      <div class="row">
        <div class="eight wide column">

<div class="ui top attached tabular menu">
  <div class="active item"> 
  REPORTE S&Iacute;SMICO{numero_reporte_sismo}

 </div>
</div>

<div class="ui bottom attached tab segment active" data-tab="first">
  <form class="ui form">
  










  <div class="field field-content">
    <div class="two fields">
      <div class="fieldx field-content-title">
      <label>Fecha</label>
      </div>
      <div class="fieldx field-content-descrip">
        <label class="descrip-info">{fecha_local_sismo}</label>
        <!-- <input name="shipping[last-name]" placeholder="A&ntilde;o 1500" type="text"> -->
      </div>
    </div>
  </div>

  <div class="field field-content">
    <div class="two fields">
      <div class="fieldx field-content-title">
      <label>Hora Local</label>
      </div>
      <div class="fieldx field-content-descrip">
        <label class="descrip-info">{hora_local_sismo}</label>
        <!-- <input name="shipping[last-name]" placeholder="A&ntilde;o 1500" type="text"> -->
      </div>
    </div>
  </div>

  <div class="field field-content">
    <div class="two fields">
      <div class="fieldx field-content-title">
      <label>Magnitud</label>
      </div>
      <div class="fieldx field-content-descrip">
        <label class="descrip-info">{magnitud_sismo}</label>
        <span style="width: 25px;
height: 25px;
background: {magnitud_sismo_color_hex};
padding: 2px;
margin: 2px;
border-radius: 25px;
display: inline-flex;
float: right;"></span>
      </div>
    </div>
  </div>

  <div class="field field-content">
    <div class="two fields">
      <div class="fieldx field-content-title">
      <label>Referencia</label>
      </div>
      <div class="fieldx field-content-descrip">
        <label class="descrip-info">{epicentro_sismo}.<br>{referencia_sismo}</label>
        
      </div>
    </div>
  </div>

<div class="content-moreinfo">

  <div class="field field-content">
    <div class="two fields">
      <div class="fieldx field-content-title">
      <label>Latitud (°)</label>
      </div>
      <div class="fieldx field-content-descrip">
        <label class="descrip-info">{latitud_sismo}</label>
        <!-- <input name="shipping[last-name]" placeholder="A&ntilde;o 1500" type="text"> -->
      </div>
    </div>
  </div>
<div class="field field-content">
    <div class="two fields">
      <div class="fieldx field-content-title">
      <label>Longitud (°)</label>
      </div>
      <div class="fieldx field-content-descrip">
        <label class="descrip-info">{longitud_sismo}</label>
        <!-- <input name="shipping[last-name]" placeholder="A&ntilde;o 1500" type="text"> -->
      </div>
    </div>
  </div>
<div class="field field-content">
    <div class="two fields">
      <div class="fieldx field-content-title">
      <label>Profundidad (KM)</label>
      </div>
      <div class="fieldx field-content-descrip">
        <label class="descrip-info">{profundidad_sismo}</label>
        <!-- <input name="shipping[last-name]" placeholder="A&ntilde;o 1500" type="text"> -->
      </div>
    </div>
  </div>
<div class="field field-content">
    <div class="two fields"  data-content="This popup is very long but wont escape the segment it is placed in">
      <div class="fieldx field-content-title">
      <label>Intensidad (MM)</label>
      </div>
      <div class="fieldx field-content-descrip">
        <label class="descrip-info">{intensidad_sismo}</label>
        <!-- <input name="shipping[last-name]" placeholder="A&ntilde;o 1500" type="text"> -->
      </div>
    </div>
  </div>

</div>

<div class="content-moreinfo">
  <h4 class="ui dividing header">Indicadores de Sismos</h4>
  <div class="field">
    <div class="content-semaforo">
      <ul class="ulcontent-semaforo">
        <li>
          <span class="verde"></span>
          <strong class="text-grados"> < 4.5  </strong>
        </li>
        <li>
          <span class="amarillo"></span>
          <strong class="text-grados"> entre 4.5 y 6.0  </strong>
        </li>
        <li>
          <span class="rojo"></span>
          <strong class="text-grados"> > 6.0  </strong>
        </li>
      </ul>
    </div>
  </div>
</div>



   <h4 class="ui dividing header">Ayuda</h4>
   <div class="field">
   <ul style="margin-left:16px;">
     <li><label>¡Cuidado con la información falsa en redes sociales! Los sismos no se pueden predecir.</label><a href="IGP-LEER-MAS.pdf" target="_blank"> Leer mas.</a></li>
     <li><label>¡Sismos con epicentros en el mar y magnitudes mayores a 7, pueden generar tsunamis!</label></li>
   </ul>
  </div>
  <a href="#" onclick="mostrar_glosario()">Ver glosario del reporte &uacute;ltimo sismo</a>

 
  
  <div>{link_replicas}</div>
  <div id="dialog" title="Réplicas" style="display:none">{replicas}</div>

</form>
</div>
</div>
        <!-- <div class="six wide right floated column"> -->
        <div class="six wide floated column">
          <!-- <img src="assets/images/wireframe/white-image.png" class="ui large bordered rounded image"> -->
          
            <div class="span-12 last">
		          <div id="map_element" style="height:580px; width:440px;"></div>
              
				      <hr class="space">
	           </div> 
             <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d124853.60167753174!2d-76.97005560000001!3d-12.065864399999985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2spe!4v1483022943300&q=Space+Needle" width="405" height="405" frameborder="0" style="border:0" allowfullscreen></iframe> -->

              <!-- <div style="width: 405px">
                <iframe width="405" height="405" src="http://www.mapi.ie/create-google-map/map.php?width=405&amp;height=405&amp;hl=en&amp;coord=-12.0721151,-76.9661555&amp;q=4.5%20Grados%2060%20km%20al%20oeste%20de%20Lima%20Metropolitana+(Ultimo%20Sismo%20-%20IGP)&amp;ie=UTF8&amp;t=&amp;z=13&amp;iwloc=A&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                </iframe>
              </div> -->

  <br>
  
  <a href="#" onclick="showMap(); return false;" class="ui primary button">Mapa Detallado</a>

        </div>

      <div class="row">

     

        <div class="center aligned column">
          

        <div class="span-12 last">
          <div class="ui modal" id="modal_mapa_detalle">
          
            <div class="header">Ubicaci&oacute;n del epicentro</div>
            <div class="content">
            <div class="ui grid">
              <div id="map_detail" class="six-teen wide" style="height:500px; width:800px;"></div>
            </div>
          </div>
          <div class="actions">
              <div class="ui button cancel">Cerrar</div>
            </div> 
          <hr class="space">
        </div>
        </div>
        

        <div class="ui modal" id="modal_glosario">
          
            <div class="header">GLOSARIO DEL REPORTE &Uacute;LMIMO S&Iacute;SMO</div>
            <div class="content">
            <div class="row">
              <div class="ui grid">
                <div class="ui message">
                  <div class="header">
                    FECHA
                  </div>
                  <p>Indica el dia, mes y año de ocurrencia del sismo</p>
                </div>

                <div class="ui message">
                  <div class="header">
                    HORA LOCAL
                  </div>
                  <p>Indica la hora local (Perú) de ocurrencia del sismo (hora:minuto:segundo). Para la hora universal (UTC) debe sumarse 5 horas. Es posible que esta suma derive en el cambio del día de ocurrencia del sismo.</p>
                </div>

                <div class="ui message">
                  <div class="header">
                    MAGNITUD
                  </div>
                  <p>Valor que indica la cantidad de energía liberada por el sismo. Para sismos con magnitud menor a 6.0 se considera la escala de Magnitud Local (ML), también conocida como escala de Richter. Para sismos con magnitudes mayores, se considera la escala de magnitud momento (Mw).</p>
                </div>

                <div class="ui message">
                  <div class="header">
                    REFERENCIA
                  </div>
                  <p>Indica la ubicación del epicentro del sismo en relación a la localidad más cercana al mismo. Los parámetros usados son azimut y distancia en km. En este caso se considera las coordenadas de la Plaza de Armas de la localidad.</p>
                </div>

                <div class="ui message">
                  <div class="header">
                    LATITUD
                  </div>
                  <p>Indica la distancia angular entre la línea ecuatorial y un punto cualquiera sobre la Tierra. Define una de las coordenadas en grados del epicentro. Valor expresado en grados.</p>
                </div>

                <div class="ui message">
                  <div class="header">
                    LONGITUD
                  </div>
                  <p>Indica la distancia angular entre un punto cualquiera sobre la superficie de la Tierra y el meridiano que se tome como 0°. Define una de las coordenadas en grados del epicentro. Valor expresado den grados.</p>
                </div>

                <div class="ui message">
                  <div class="header">
                    PROFUNDIDAD
                  </div>
                  <p>Define la profundidad por debajo de la superficie de la Tierra en la cual se encuentra el foco sísmico o inicio de la ruptura. Valor expresado en kilómetros.</p>
                </div>

                <div class="ui message">
                  <div class="header">
                    INTENSIDAD
                  </div>
                  <p>Define de manera indirecta la intensidad de sacudimiento del suelo en base a la percepción de las persona, daños estructurales y cambios en la naturaleza. La escala utilizada es la de Mercalli Modificada. Los valores son dados en números romanos para las localidades en las cuales se llegó a evaluar las intensidades máximas.</p>
                </div>
              </div>
            </div>

            </div>
            <div class="actions">
              <div class="ui button cancel">Cerrar</div>
            </div> 
            <hr class="space">
        </div>




      </div>
    </div>
  </div>

<div class="ui container">
  <div class="delimitador-top"></div>
  <div class="row login-footer">

  <p>Central Telefónica: 317-2300 | Portal Institucional:
				<a class="color_blue" href="http://portal.igp.gob.pe">http://portal.igp.gob.pe</a>

      <p class="login-footer-contancto text-center">
      <span>Escríbenos a:</span>
          <a class="color_blue" href="mailto:web@igp.gob.pe">admin.otidg@igp.gob.pe</a></p>
  </div>
</div>
</div>

</body>
</html>