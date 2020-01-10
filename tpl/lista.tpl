  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">


    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Reporte del Último Sismo sentido en el Perú, elaborado por el Instituto Geofísico del Perú">
    <title>Sismos reportados en el Perú  | Instituto Geofísico del Perú</title>
    <meta name="keywords" content="&uacute;ltimo sismo, sismo per&uacute;, instituto geof&iacute;sico del per&uacute;, IGP , portal , portada" />

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">

    <!--Footer-->
    <link href="css/footer.css?17052018" rel="stylesheet" type="text/css" />

    <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
    <link href="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.css" rel="stylesheet" type="text/css"/>


    <link rel="stylesheet" type="text/css" href="http://ultimosismo.igp.gob.pe/css/semantic_reset.css">
    <link rel="stylesheet" type="text/css" href="http://ultimosismo.igp.gob.pe/css/semantic_site.css">
    <link rel="stylesheet" type="text/css" href="http://ultimosismo.igp.gob.pe/css/semantic_style.css">
    <link rel="stylesheet" type="text/css" href="http://ultimosismo.igp.gob.pe/css/semantic.min.css">

    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJRGE_Fw9Mpd9BS_U5oMD2bDgCsNviWkE"></script>
    <!--
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdn.datatables.net/scroller/1.4.2/js/dataTables.scroller.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.js"></script>
  -->

  <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>

  <style type="text/css">
    #map {
      height:550px;
      min-width:460px;
      width: 100%;
    }

  </style>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&amp;libraries=places"></script>
  <script type="text/javascript" src="js/googlemaps.js"></script>
  {ajax}
  <script type="text/javascript">
    function epicentro(){
      {script}
    }

    {showbymonth}

  </script>
</head>
<body onload="xajax_auxIni('10','1'); initialize(); epicentro(); xajax_tabla();">


  <div class="pusher">
    <div class="ui container topcontent-logos">
      <div id="header-igp-ant" class="row nomargin page-header-log">
        <div id="logo-minam-ant">
          <div class="logo-minam-1">
            <a href="http://ultimosismo.igp.gob.pe" title="Inicio" rel="home">
              <img class="img-responsive" src="http://ultimosismo.igp.gob.pe/images/minam.png" alt="IGP Logo">
            </a>
          </div>
        </div>

        <div id="logo-igp-ant">
          <a href="http://www.igp.gob.pe" target="_blank" rel="IGP" title="Portal web - IGP">
<!--            <img class="img-responsive" src="http://ultimosismo.igp.gob.pe/images/igp.png" > -->
            <img class="img-responsive" src="https://portal.igp.gob.pe/sites/default/files/logos/logo-igp-min.png" >
          </a>
        </div>
      </div>
    </div>

    <div class="ui container">
      <div class="delimitador-top"></div>
    </div>
    <center><h1>Sismos Reportados</h1></center>
    <div class="ui middle aligned stackable grid container">
      <div class="row">
        <div class="sixteen wide column">
          <div class="ui top attached tabular menu">
            <a class="item active" data-tab="first">Mapa</a>
            <a class="item" data-tab="second">Lista</a>
          </div>
          <div class="ui bottom attached tab segment active" data-tab="first">

            <div class="ui grid column stackable">
            <div class="three wide column">
                <p>Puede seleccionar a continuación los sismos de los meses que quiere visualizar</p>
                <div id="meses-mapa" style="padding-left:20px;"></div>
                <div id="herramientas" style="padding-left:20px; text-align:left;">
                  <br>
                  <span class="txt-azul">
                    <a class="imprimir" target="_blank" href="http://portal.igp.gob.pe/sismos-reportados-anualmente"><img style="vertical-align:middle;" width="20px" src="img/pdf.png"/> Archivo de mapas con los sismos reportados anualmente</a>
                  </span>
                </div>
                <div id="herramientas2" style="padding-left:20px; text-align:left; display: none;">
                  <br>
                  <span class="txt-azul">
                    <a class="imprimir" target="_blank" href="reportMonthTest.php"><img style="vertical-align:middle;" width="20px" src="img/pdf.png"/> Archivo de mapas con los sismos reportados por mes test</a>
                  </span>
                </div>
              </div>
              <div class="twelve wide column">
                <div id="map"> </div>
                <div style="position:absolute; left: 20px; top: 480px;"><img src="img/magnitudes.png"></div>
                <div style="position:absolute; left: 20px; top: 20px;"><img src="img/profundidades.png"></div>
              </div>
            </div>

        </div>

        <div class="ui bottom attached tab segment" data-tab="second">
          <div class="ui grid column stackable">
            <div class="three wide column">
              <p>Puede seleccionar a continuación los sismos de los meses que quiere visualizar</p>
              <form id="formMonth" name="formMonth" action="reportMonth.php">
                <div id="meses" style="padding-left:10px;">
                </div>
              </form>
              <p><img style="vertical-align:middle;" width="20px" src="img/pdf.png"/><a class="imprimir" target="_blank" href="#" onclick="formMonth.submit(); return false;"> Archivo con los sismos reportados de los meses seleccionados</a></p>
              <hr class="space">
              <p>
                <a class="imprimir" target="_blank" href=report.php><img style="vertical-align:middle;" width="20px" src="img/pdf.png"/> Archivo con los sismos reportados de este a&ntilde;o</a>
              </p>
            </div>
            <div class="twelve wide column">
             <div id="tablaResultados"> </div>
             <div class="paginacion">
              <div id="paginator" class="wp-pagenavi" style="display: block;">
              </div>
            </div>
            <br><center><h4><i>Magnitud de sismos reportados: ML (≤6.5), Mw (>6.5)</i></h4></center>
          </div>
        </div>

      </div>

    </div>
  </div>

</div>
</div>


<script>
  $(document).ready(function(){
    $('.menu .item').tab();
  });
</script>
<div >

<!-- .page-footer-info -->
<div class="footer-igp">
  <div class="footer-col footer-logo">
    <div class="text-center">
      <img src="img/footer/igp-logo.png" style="margin-right: 10px;">
    </div>
    <div class="text-center">
      <img src="img/footer/logo-minam-102.png">
    </div>
    <div class="text-center">
      <a href="http://busquedas.elperuano.pe/normaslegales/establecen-como-politica-de-comunicaciones-del-poder-ejecuti-resolucion-ministerial-n-113-2018-pcm-1641857-1/" target="_blank">
        <img title="Logo Perú primero" src="img/footer/peru_primero.jpeg" width="180px" align="middle">
      </a>
    </div>
  </div>

  <div class="footer-col page-f-i-description">
    <div class="footer-row">
      <div class="page-f-i-image text-center">
        <img src="img/footer/map-marker-icon.png" align="middle">
      </div>
      <div class='page-f-i-description-content'>
        <div class="page-f-i-title">LIMA</div>
        <div class="page-f-i-content"><strong>Sede Principal</strong><br>
          Calle Badajoz N° 169 Urb. Mayorazgo IV Etapa<br>
          Ate, Lima 15012 - Perú.
        </div>
      </div>
    </div>
    <div class="footer-row">
      <div class="page-f-i-image text-center"></div>
      <div class='page-f-i-description-content'>
        <div class="page-f-i-content"><strong>Sede Camacho</strong><br>
          Centro Nacional de Monitoreo Sísmico (CENSIS)<br>
          Calle Calatrava N° 216 Urb. Camino Real<br>
          La Molina, Lima 15023 - Perú.
        </div>
      </div>
    </div>
    <div class="footer-row">
      <div class="page-f-i-image text-center"></div>
      <div class='page-f-i-description-content'>
        <div class="page-f-i-content"><strong>Sede Jicamarca</strong><br>
          Radio Observatorio Jicamarca<br>
          Chosica S/N<br>
          Lurigancho, Lima 15464 - Perú
        </div>
      </div>
    </div>
    <div class="footer-row">
      <div class="page-f-i-image text-center"></div>
      <div class='page-f-i-description-content'>
        <div class="page-f-i-title">PROVINCIAS</div>
        <div class="page-f-i-content"><strong>Sede Arequipa</strong><br>
          Dirección de Vulcanología<br>
          Mz B Lote 19 Urb. La Marina<br>
          Cayma, Arequipa 04017 - Perú
        </div>
      </div>
    </div>
    <div class="footer-row">
      <div class="page-f-i-image text-center"></div>
      <div class='page-f-i-description-content'>
        <div class="page-f-i-content"><strong>Sede Lambayeque</strong><br>
          Av. Arequipa N° 168 Urb. Los Libertadores<br>
          Chiclayo - Lambayeque 14009 - Perú
        </div>
      </div>
    </div>
    <div class="footer-row">
      <div class="page-f-i-image text-center"></div>
      <div class='page-f-i-description-content'>
        <div class="page-f-i-content"><strong>Sede Junin</strong><br>
          Observatorio de Huancayo<br>
          Km 15 Carretera Huachac<br>
          Huachac, Junin 12480 - Perú
        </div>
      </div>
    </div>
  </div>

  <div class="footer-col page-f-i-description">
    <div class="footer-row">
      <div class="page-f-i-image text-center">
        <img src="img/footer/reloj.png" align="middle">
      </div>
      <div class='page-f-i-description-content'>
        <div class="page-f-i-title">HORARIO DE ATENCIÓN</div>
        <div class="page-f-i-content">De lunes a viernes<br>
        Atención al ciudadano: de 8:30 Hrs. a 17:15 Hrs.</div>
      </div>
    </div>

    <div class="footer-row">
      <div class="page-f-i-image text-center">
        <img src="img/footer/phone-icon.png" align="middle" style="text-align:center;">
      </div>
      <div class='page-f-i-description-content'>
        <div class="page-f-i-title">CENTRAL TELEFÓNICA</div>
        <div class="page-f-i-content">Ate: (51) 13172300</div>
      </div>
    </div>
    <div class="footer-row">
      <div class="page-f-i-image text-center">
        <img src="img/footer/envelope-icon.png" align="middle" style="text-align:center;">
      </div>
      <div class='page-f-i-description-content'>
        <div class="page-f-i-title">CONSULTAS Y SUGERENCIAS</div>
        <div class="page-f-i-content">comunicaciones@igp.gob.pe</div>
      </div>
    </div>
  </div>
</div>
<!-- EOF: .page-footer-info -->

</div>
    </body>
    </html>
