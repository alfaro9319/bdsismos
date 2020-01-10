function mapaSismo(lon,lat){
	
	var map;
	format = 'image/png';		
	 	    
	var bounds = new OpenLayers.Bounds(	-81.5, -18.01, -68.05, -0.95);
		var options = {
	 		controls: [],	
			maxExtent: bounds,
			maxResolution: 0.03,
	 		projection: 'EPSG:4326',
	 		units: 'degrees',
	 		numZoomLevels: 5
	 	};	    
    
	map = new OpenLayers.Map('map_element', options);

	fondo = new OpenLayers.Layer.MapServer( "Peru",
		       "http://www.igp.gob.pe/cgi-bin/mapserv?map=/data/paginasweb/ultimosismo/map/dynamic.map",
		       {	layers:'FondoPeru', 
					isBaseLayer: true,
				},
				{
					buffer: 0,
					displayOutsideMaxExtent: true,
				 	yx : {'EPSG:4326' : true}
				}				
		       );

	
	cd = new OpenLayers.Layer.MapServer("Capital_de_Departamento",
			"http://www.igp.gob.pe/cgi-bin/mapserv?map=/data/paginasweb/ultimosismo/map/dynamic.map",
			 {layers: 'Capital_de_Departamento',
			  tiled: true,
			  transparent: true
			 },
			 {buffer: 0, 
				  displayOutsideMaxExtent: true,
				  yx : {'EPSG:4326' : true}
			 }
	);
	
	oceano = new OpenLayers.Layer.MapServer("Oceano",
			"http://www.igp.gob.pe/cgi-bin/mapserv?map=/data/paginasweb/ultimosismo/map/dynamic.map",
			 {layers: 'Oceano',
				tiled: true,
				isBaseLayer: true,
			 },
			 {buffer: 0, 
				  displayOutsideMaxExtent: true,
				  yx : {'EPSG:4326' : true}
			 }
	);
	
	
	sudamerica = new OpenLayers.Layer.MapServer(
			 'Sudamerica', "http://www.igp.gob.pe/cgi-bin/mapserv?map=/data/paginasweb/ultimosismo/map/dynamic.map",
			 {
			 layers: 'Sudamerica',
			 tiled: true,
			 transparent: true
			 },
			 {
			 buffer: 0,
			 displayOutsideMaxExtent: true,
			 yx : {'EPSG:4326' : true}
			 }
	);
	
	departamentos = new OpenLayers.Layer.MapServer(
			 'Departamentos', "http://www.igp.gob.pe/cgi-bin/mapserv?map=/data/paginasweb/ultimosismo/map/dynamic.map",
			 {
			 layers: 'Departamentos',
			 tiled: true,
			 transparent: true
			 },
			 {
			 buffer: 0,
			 displayOutsideMaxExtent: true,
			 yx : {'EPSG:4326' : true}
			 }
	);

	lagos = new OpenLayers.Layer.MapServer(
			 'Lagos', "http://www.igp.gob.pe/cgi-bin/mapserv?map=/data/paginasweb/ultimosismo/map/dynamic.map",
			 {
			 layers: 'Lagos_Principales',
			 tiled: true,
			 transparent: true
			 },
			 {
			 buffer: 0,
			 displayOutsideMaxExtent: true,
			 yx : {'EPSG:4326' : true}
			 }
	);	
	

	localidades = new OpenLayers.Layer.MapServer(
			 'Localidades', "http://www.igp.gob.pe/cgi-bin/mapserv?map=/data/paginasweb/ultimosismo/map/dynamic.map",
			 {
			 layers: 'Localidades_IGP',
			 tiled: true,
			 transparent: true
			 },
			 {
			 buffer: 0,
			 displayOutsideMaxExtent: true,
			 yx : {'EPSG:4326' : true}
			 }
	);	
	
/*
	fosaperu = new OpenLayers.Layer.WMS(
			 'Fosa', "http://localhost/cgi-bin/mapserv?map=/data/paginasweb/ultimosismo/map/dynamic.map",
			 {
				 layers: 'Fosa',
				 tiled: false,
				 transparent: true
			 },
			 {
				 yx : {'EPSG:4326' : true},
			 }
	);		
*/	
	
	fosaperu = new OpenLayers.Layer.MapServer( "Fosa",
		       "http://www.igp.gob.pe/cgi-bin/mapserv?map=/data/paginasweb/ultimosismo/map/dynamic.map",
		       {	layers:'Fosa', 
					transparent: true
				},
				{
					buffer: 0,
					displayOutsideMaxExtent: true,
				 	yx : {'EPSG:4326' : true}
				}				
		       );	

	dorsal = new OpenLayers.Layer.MapServer( "Dorsal",
		       "http://www.igp.gob.pe/cgi-bin/mapserv?map=/data/paginasweb/ultimosismo/map/dynamic.map",
		       {	layers:'Dorsal', 
					transparent: true
				},
				{
					buffer: 0,
					displayOutsideMaxExtent: true,
				 	yx : {'EPSG:4326' : true}
				}				
		       );
	

	mendana = new OpenLayers.Layer.MapServer( "Mendana",
		       "http://www.igp.gob.pe/cgi-bin/mapserv?map=/data/paginasweb/ultimosismo/map/dynamic.map",
		       {	layers:'Mendaña', 
					transparent: true
				},
				{
					buffer: 0,
					displayOutsideMaxExtent: true,
				 	yx : {'EPSG:4326' : true}
				}				
		       );	


	fosatext1 = new OpenLayers.Layer.MapServer( "fosatext1",
		       "http://www.igp.gob.pe/cgi-bin/mapserv?map=/data/paginasweb/ultimosismo/map/dynamic.map",
		       {	layers:'FOSATEXT1', 
					transparent: true
				},
				{
					buffer: 0,
					displayOutsideMaxExtent: true,
				 	yx : {'EPSG:4326' : true}
				}				
		       );	

	fosatext2 = new OpenLayers.Layer.MapServer( "fosatext2",
		       "http://www.igp.gob.pe/cgi-bin/mapserv?map=/data/paginasweb/ultimosismo/map/dynamic.map",
		       {	layers:'FOSATEXT2', 
					transparent: true
				},
				{
					buffer: 0,
					displayOutsideMaxExtent: true,
				 	yx : {'EPSG:4326' : true}
				}				
		       );	
	
	
/*	
	var lv1 = new OpenLayers.Layer.Vector('Texto1');
	var p1 = new OpenLayers.Geometry.Point(-83,-13);
	var pstyle1 = OpenLayers.Util.extend(OpenLayers.Feature.Vector.style['default1'],OpenLayers.Feature.Vector.style['default1']);
	pstyle1.graphic = false;
	pstyle1.label = "OCÉANO PACÍFICO";
	pstyle1.labelAlign = 'l';
	pstyle1.labelXOffset = 8;
	pstyle1.fontColor = '#FFFFFF';
	pstyle1.fontOpacity = 1;
	pstyle1.fontFamily='Arial';
	pstyle1.fontSize = '20';
	pstyle1.fontWeight = 'bold';		
	var feat1 = new OpenLayers.Feature.Vector(p1,null,pstyle1);
	lv1.addFeatures([feat1]);
*/	
	
	map.addLayers([oceano,sudamerica,departamentos,lagos,fosaperu,dorsal,mendana,localidades,fosatext1,fosatext2]);

	locmap0=[-85.2,-10,"FRACTURA DE MENDAÑA",10,"#FFFFFF"];
	locmap1=[-82,-16.5,"DORSAL DE NAZCA",10,"#FFFFFF"];
	locmap2=[-85,-13.5,"OCÉANO PACÍFICO",18,"#FFFFFF"];
	locmap3=[-79, -1.5 ,"ECUADOR",12,"#000000"];
	locmap4=[-73, 0 ,"COLOMBIA",12,"#000000"];
	locmap5=[-70, -8 ,"BRASIL",12,"#000000"];
	locmap6=[-67, -15 ,"BOLIVIA",12,"#000000"];
	locmap7=[-70, -19.4 ,"CHILE",12,"#000000"];
	
	for (i = 0; i < 8; i++){
		k = i.toString();
		// location [0]=Longitude; [1]=Latitude; [2]=Text [3]=Font size  [4]=Rotation
		eval("var lv"+ k +" = new OpenLayers.Layer.Vector('referencia"+ k +"');");
		eval("var p"+ k +" = new OpenLayers.Geometry.Point(locmap"+ k +"[0],locmap"+ k +"[1]);");
		eval("var pstyle"+ k +" = OpenLayers.Util.extend(OpenLayers.Feature.Vector.style['default"+ k + "'],OpenLayers.Feature.Vector.style['default"+ k +"']);");
		eval("pstyle"+ k +".graphic = false;");
		eval("pstyle"+ k +".label = locmap"+ k +"[2];");
		eval("pstyle"+ k +".labelAlign = 'l';");
		eval("pstyle"+ k +".fontColor = locmap"+ k +"[4];");
		eval("pstyle"+ k +".fontOpacity = 1;");
		eval("pstyle"+ k +".fontFamily='Arial';");
		eval("pstyle"+ k +".fontSize = locmap"+ k +"[3];");
		eval("pstyle"+ k +".fontWeight = 'bold';");		
		eval("var feat"+ k +" = new OpenLayers.Feature.Vector(p"+ k +",null,pstyle"+ k +");");
		eval("lv"+ k +".addFeatures([feat"+ k +"]);");
		eval("map.addLayer(lv"+ k +");");
		
	}	
	
	
	
/*
	for (i=0; i<10; i++){
		k = i.toString();
		eval("var city"+ k +"=document.getElementById('city"+ k +"').value;"); 
		eval("locmap"+ k +"=city"+ k +".split(',');");
		// texto de las referencias
		// location 0=Longitud; 1=Latitud; 2=Nombre de la ciudad
		eval("var lv"+ k +" = new OpenLayers.Layer.Vector('referencia"+ k +"');");
		eval("var p"+ k +" = new OpenLayers.Geometry.Point(locmap"+ k +"[0],locmap"+ k +"[1]);");
		eval("var pstyle"+ k +" = OpenLayers.Util.extend(OpenLayers.Feature.Vector.style['default"+ k + "'],OpenLayers.Feature.Vector.style['default"+ k +"']);");
		eval("pstyle"+ k +".graphic = false;");
		eval("pstyle"+ k +".label = locmap"+ k +"[2];");
		eval("pstyle"+ k +".labelAlign = 'l';");
		eval("pstyle"+ k +".labelXOffset = 8;");
		eval("pstyle"+ k +".fontColor = '#0D648C';");
		eval("pstyle"+ k +".fontOpacity = 1;");
		eval("pstyle"+ k +".fontFamily='Arial';");
		eval("pstyle"+ k +".fontSize = '10';");
		eval("pstyle"+ k +".fontWeight = 'bold';");		
		eval("var feat"+ k +" = new OpenLayers.Feature.Vector(p"+ k +",null,pstyle"+ k +");");
		eval("lv"+ k +".addFeatures([feat"+ k +"]);");
		eval("map.addLayer(lv"+ k +");");
		
		// iconos de las referencias			
	    eval ("var markers"+ k +" = new OpenLayers.Layer.Markers('icoref"+ k +"');");
	    eval ("var size"+ k +" = new OpenLayers.Size(7,7);");
	    eval ("var offset"+ k +" = new OpenLayers.Pixel(-(size"+ k +".w/2), -(size"+ k +".h/2));");
	    eval ("var icon"+ k +" = new OpenLayers.Icon('img/iconos/guion_circulo.png', size"+ k +", offset"+ k +");");
	    eval ("markers"+ k +".addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(locmap"+ k +"[0],locmap"+ k +"[1]),icon"+ k +"));");					
	    eval("map.addLayer(markers"+ k +");");
		
	}
*/	
	// Epicentro		
    var markers = new OpenLayers.Layer.Markers( "Sismo" );
    var size = new OpenLayers.Size(32,32);
    var offset = new OpenLayers.Pixel(-(size.w/2), -(size.h/2));
    var icon = new OpenLayers.Icon('img/circulos.gif', size, offset);
    markers.addMarker(new OpenLayers.Marker(new OpenLayers.LonLat(lon,lat),icon));
    map.addLayer(markers);
	
	map.addControl(new OpenLayers.Control.Navigation());
	//map.addControl(new OpenLayers.Control.LayerSwitcher());		
	map.addControl(new OpenLayers.Control.PanZoomBar({
		position: new OpenLayers.Pixel(2, 15)
	}));
	
	map.setCenter(new OpenLayers.LonLat(-76.5,-10));
	//map.zoomTo(1);
		if(!map.getCenter()){
			map.zoomToMaxExtent();
		}

}
