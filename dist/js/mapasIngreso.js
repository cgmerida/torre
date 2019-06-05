var map = null, marker = null, latitud=null, longitud=null, infowindow=null;
var center=new google.maps.LatLng(14.66041377324729,-90.44734954833984);

function initialize() {
   var mapProp = {
      center: center,
      zoom:13,
      disableDefaultUI:true,
      zoomControl: true,
      zoomControlOptions: {
         style: google.maps.ZoomControlStyle.SMALL,
         position: google.maps.ControlPosition.RIGHT_TOP
      },
      mapTypeControl: true,
      mapTypeId:google.maps.MapTypeId.ROADMAP
   };
   map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

   var areaNorte = new google.maps.KmlLayer({
      url: 'https://sites.google.com/site/mapabaseregencia/home/LimitesRN.kml?attredirects=0&d=1',
      map:map,
      preserveViewport:true,
      suppressInfoWindows: true
   });

   google.maps.event.addListener(map, 'click', function(event) {
      placeMarker(event.latLng);
      if (!infowindow) {
         infowindow = new google.maps.InfoWindow({
            content: 'Latitud: ' + latitud + '<br>Longitud: ' + longitud
         });
         infowindow.open(map,marker);
      } else{
         infowindow.setContent('');
         infowindow.close();
         infowindow.setContent('Latitud: ' + latitud + '<br>Longitud: ' + longitud);
         infowindow.open(map,marker);
      }
   });
}

function placeMarker(location) {
   if (!marker) {
      // Crea el punto en el mapa sino existe un punto
      marker = new google.maps.Marker({
         position: location,
         map: map
      });
      latitud=location.lat();
      longitud=location.lng();
   }
    // de otro modo, solo cambia la ubicacion en el mapa.
    else { 
      marker.setPosition(location);
      latidud=location.lat();
      longitud=location.lng();
   }
}

google.maps.event.addDomListener(window, 'load', initialize);

google.maps.event.addDomListener(window, "resize", resizeMap);

function resizeMap() {
   if(typeof map =="undefined") return;
   setTimeout( function(){resizingMap();} , 400);
}

function resizingMap() {
   if(typeof map =="undefined") return;
   google.maps.event.trigger(map, "resize");
   map.setZoom(13);
   map.setCenter( center );
}

function openMap(){
   initialize();
   $("#ubicacion").removeClass('btn-success').addClass('btn-info').html('<i class="fa fa-map-marker fa-fw"></i> Ingrese ubicación');
   $("#lat").val("");
   $("#lng").val("");
   if(marker) marker.setMap(null);
   marker=null;
}
$(document).ready(function() {
   $("#posicion").click(function(e) {
      $("#ubicacion").removeClass('btn-info').addClass('btn-success').html('<i class="fa fa-map-marker fa-fw"></i>Ubicacion Guardada!');
      $("#lat").val(latitud);
      $("#lng").val(longitud);
   });
});