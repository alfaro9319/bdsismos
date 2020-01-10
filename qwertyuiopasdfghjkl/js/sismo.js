function horaActual(hora, minuto, segundo){
	/*
	segundo = segundo + 1;
	if(segundo == 60) {
		minuto = minuto + 1;
		segundo = 0;
		if(minuto == 60) {
			minuto = 0;
			hora = hora + 1;
			if(hora == 24) {
				hora = 0;
			}
		}
	}
	if(hora < 10) hora = '0' + hora;
	if(minuto < 10) minuto = '0' + minuto;
	if(segundo < 10) segundo = '0' + segundo;
	HoraCompleta= hora + ":" + minuto + ":" + segundo;
	document.getElementById('contenedor_reloj').innerHTML = HoraCompleta;
	setTimeout("horaActual("+hora+", "+minuto+", "+segundo+")", 1000);
	*/
}

function alarma(){
	$('#player').html('<object data="swf/dewplayer-mini.swf" width="1" height="1" name="dewplayer" id="dewplayerjs" type="application/x-shockwave-flash"><param name="movie" value="dewplayer-mini.swf" /><param name="flashvars" value="mp3=mp3/alarm.mp3&javascript=on&autostart=1&autoreplay=1" /><param name="wmode" value="transparent" /></object>');
}

function showReplicas() {
	$( "#dialog" ).dialog({
		height:600,
		width: 750
	});
}

function showMap() {
	/*
	$( "#map_detail" ).dialog({
		resizable: false,
		height: 500,
		width: 800,
		modal: true
	});
	*/

	$('#modal_mapa_detalle').modal('show');
}


function mapaSismo(lon,lat){

	var map;
	format = 'image/png';

	var bounds = new OpenLayers.Bounds(	-85, -22, -60, 1.5);

	var options = {
		controls: [],
		maxExtent: bounds,
		maxResolution: 0.04395,
			projection: 'EPSG:4326',
			units: 'degrees'
	};

	map = new OpenLayers.Map('map_element', options);


	fondo = new OpenLayers.Layer.WMS( "Peru",
		      "http://"+window.location.hostname +"/wms/igp", {layers:'sismos'});
	/*
	fondo = new OpenLayers.Layer.WMS( "Peru",
	      "http://sismos.igp.gob.pe/cgi-bin/mapserv.fcgi?map=/data/paginasweb/ultimosismo/map/sismos.map",
	      {	layers:'FondoPeru,Capital_de_Departamento,Tacna,Sudamerica,PERU,ECUADOR,COLOMBIA,BRASIL,BOLIVIA,CHILE',
			isBaseLayer: true,
			tiled: true
		},
		{
			buffer: 0,
			displayOutsideMaxExtent: true,
		 	yx : {'EPSG:4326' : true}
		}
	);
	*/

	map.addLayers([fondo]);

	// Epicentro
    var markers = new OpenLayers.Layer.Markers( "Sismo" );
    var size = new OpenLayers.Size(32,32);
    var offset = new OpenLayers.Pixel(-(size.w/2), -(size.h/2));
    var icon = new OpenLayers.Icon('img/circulos.gif', size, offset);
    markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(lon,lat),icon));
    map.addLayer(markers);

	map.setCenter(new OpenLayers.LonLat(-74.5,-10));
	//map.zoomTo(1);
		if(!map.getCenter()){
			map.zoomToMaxExtent();
		}

}


function mapaSismoDetalle(lon,lat){

	var map;
	format = 'image/png';

	var bounds = new OpenLayers.Bounds(	-85, -22, -60, 1.5);

	var options = {
        tileSize: new OpenLayers.Size(512,512),
		controls: [],
		maxExtent: bounds,
		maxResolution: 0.010986,
		projection: 'EPSG:4326',
		units: 'degrees'
	};

	map = new OpenLayers.Map('map_detail', options);

	fondo = new OpenLayers.Layer.WMS( "Peru",
		      "http://"+window.location.hostname + "/wms/igp", {layers:'sismoDetalle'});

/*
	fondo = new OpenLayers.Layer.WMS( "PeruZoom",
	      "http://"+  document.location.hostname + "/maps?map=/data/paginasweb/ultimosismo/map/sismoDetalle.map",
	      {	layers:'Sudamerica,Departamentos,Oceano,Localidades_IGP',
			isBaseLayer: true,
			tiled: true
		},
		{
			buffer: 0,
			displayOutsideMaxExtent: true,
		 	yx : {'EPSG:4326' : true}
		}
	);
*/
	map.addLayers([fondo]);

	// Epicentro
    var markers = new OpenLayers.Layer.Markers( "Sismo" );
    var size = new OpenLayers.Size(32,32);
    var offset = new OpenLayers.Pixel(-(size.w/2), -(size.h/2));
    var icon = new OpenLayers.Icon('img/circulos.gif', size, offset);
    markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(lon,lat),icon));
    map.addLayer(markers);

	map.setCenter(new OpenLayers.LonLat(lon,lat));
//	map.zoomTo(2);
	if(!map.getCenter()){
		map.zoomToMaxExtent();
	}

}

function mostrar_glosario(){
  $("#modal_glosario").modal('show');
}