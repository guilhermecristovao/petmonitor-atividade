<?php

$con = mysqli_connect("localhost", "root", "", "petmonitor");
echo " " . PHP_EOL;

if (mysqli_connect_errno()) {
  throw new Exception(mysqli_connect_error(), mysqli_connect_errno());
}

getPosts($con);

function getPosts()
{
  global $con;
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Consulta | Mapa de Monitoramento</title>
</head>

<body>
  <style>
    #map {
      height: 50%;
    }

    html,
    body {
      height: 100%;
      margin: 15;
      padding: 15;
    }
  </style>

  <div id="map"></div>

  <script>
    var customLabel = {
      restaurant: {
        label: 'R'
      },
      bar: {
        label: 'B'
      }
    };

    function initMap() {

      var myLatlng = new google.maps.LatLng(-22.740799, -47.656667);
      var mapOptions = {
        zoom: 18,
        center: {
          lat: -22.740799,
          lng: -47.656667
        },
        mapTypeId: 'satellite'
      };

      var map = new google.maps.Map(document.getElementById('map'),
        mapOptions);

      var flightPlanCoordinates = [{
          lat: -22.740799,
          lng: -47.656667
        },
        {
          lat: -22.741281,
          lng: -47.655543
        },
        {
          lat: -22.741732,
          lng: -47.654663
        },
        {
          lat: -22.741005,
          lng: -47.654288
        },
      ];
      var flightPath = new google.maps.Polyline({
        path: flightPlanCoordinates,
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 1.5,
        strokeWeight: 3
      });

      flightPath.setMap(map);

      var infoWindow = new google.maps.InfoWindow;

      downloadUrl('resultado.php', function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function(markerElem) {
          var name = markerElem.getAttribute('name');
          var address = markerElem.getAttribute('address');
          var type = markerElem.getAttribute('type');
          var point = new google.maps.LatLng(
            parseFloat(markerElem.getAttribute('lat')),
            parseFloat(markerElem.getAttribute('lng')));

          var infowincontent = document.createElement('div');
          var strong = document.createElement('strong');
          strong.textContent = name
          infowincontent.appendChild(strong);
          infowincontent.appendChild(document.createElement('br'));

          var text = document.createElement('text');
          text.textContent = address
          infowincontent.appendChild(text);
          var icon = customLabel[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            label: icon.label
          });
          marker.addListener('click', function() {
            infoWindow.setContent(infowincontent);
            infoWindow.open(map, marker);
          });
        });
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBU5tSACf5gVANaW7KV5QirRMVrrHCq5RA&callback=initMap">
  </script>
</body>

</html>