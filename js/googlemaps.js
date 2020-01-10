    var map;
    var infowindow;
    var markersArray = [];

    function initialize() {
      var peru = new google.maps.LatLng(-9.4,-75);

      map = new google.maps.Map(document.getElementById('map'), {
//        mapTypeId: google.maps.MapTypeId.HYBRID,
        labels: true,
        scrollwheel: false,
        disableDefaultUI: true,
        center: peru,
        zoom: 5,


       mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        panControl: false,
        panControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.LEFT_CENTER
        },
        scaleControl: false,
        scaleControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT
        },
        streetViewControl: false,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        }



      });

    }


    function addMarker(location) {
      marker = new google.maps.Marker({
        position: location,
        map: map
      });
      markersArray.push(marker);
    }

    // Removes the overlays from the map, but keeps them in the array
    function clearOverlays() {
      if (markersArray) {
        for (i in markersArray) {
          markersArray[i].setMap(null);
        }
      }
    }

    // Shows any overlays currently in the array
    function showOverlays() {
      if (markersArray) {
        for (i in markersArray) {
          markersArray[i].setMap(map);
        }
      }
    }

    // Deletes all markers in the array by removing references to them
    function deleteOverlays() {
      if (markersArray) {
        for (i in markersArray) {
          markersArray[i].setMap(null);
        }
        markersArray.length = 0;
      }
    }
