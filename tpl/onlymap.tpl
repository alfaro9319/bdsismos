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

<script type="text/javascript">
  function epicentro(){
    {script}
  }

</script>

<script type="text/javascript" src="http://localhost/pruebaphp/html2canvas.js"></script>

</head>
<body onload="xajax_auxIni('10','1'); initialize(); epicentro(); xajax_tabla();">

  <div class="twelve wide column" id='mapGenereado'>
    <div id="map"> </div>
    <div style="position:absolute; left: 20px; top: 480px;"><img src="img/magnitudes.png"></div>
    <div style="position:absolute; left: 20px; top: 20px;"><img src="img/profundidades.png"></div>
  </div>

  <div id="imagen">
  <p>Esto es una prueba para <strong>exportar código HTML</strong> a imagen en formato PNG. Ofrecido por ProgramacionExtrema.com<p>
</div>
  <button id="downloadMap" type="button" name="button">Download</button>

<script>
$(document).ready(function(){
  $('.menu .item').tab();
});
</script>
<script>
  var downloadMap = document.getElementById('downloadMap');
  downloadMap.addEventListener('click', function(){
    downloadCanvas('mapGenereado', 'imagen.png');
  });

  function generateImg(){
    var divID = 'mapGenereado';
    html2canvas([document.getElementById(divID)], {
      onrendered: function (canvas) {
        var img = canvas.toDataURL('image/png'); //o por 'image/jpeg'
        //display 64bit imag
        document.write('<img src="'+img+'"/>');
      }
    })
  }

  function downloadCanvas(canvasId, filename) {
      // Obteniendo la etiqueta la cual se desea convertir en imagen
      var domElement = document.getElementById(canvasId);

      // Utilizando la función html2canvas para hacer la conversión
      html2canvas(domElement, {
          onrendered: function(domElementCanvas) {
              // Obteniendo el contexto del canvas ya generado
              var context = domElementCanvas.getContext('2d');

              // Creando enlace para descargar la imagen generada
              var link = document.createElement('a');
              link.href = domElementCanvas.toDataURL("image/png");
              link.download = filename;

              // Chequeando para browsers más viejos
              if (document.createEvent) {
                  var event = document.createEvent('MouseEvents');
                  // Simulando clic para descargar
                  event.initMouseEvent("click", true, true, window, 0,
                      0, 0, 0, 0,
                      false, false, false, false,
                      0, null);
                  link.dispatchEvent(event);
              } else {
                  // Simulando clic para descargar
                  link.click();
              }
          }
      });
  }

  // Haciendo la conversión y descarga de la imagen al presionar el botón
  $('#boton-descarga').click(function() {
      downloadCanvas('imagen', 'imagen.png');
  });
</script>
    <!--
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJRGE_Fw9Mpd9BS_U5oMD2bDgCsNviWkE"></script>-->
  </body>
  </html>
