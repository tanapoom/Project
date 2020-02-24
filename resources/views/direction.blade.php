<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!--bootstrap-->
    <style>
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        float: left;
        width: 70%;
        height: 100%;
      }
      #right-panel {
        margin: 20px;
        border-width: 2px;
        width: 20%;
        height: 400px;
        float: left;
        text-align: left;
        padding-top: 0;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-light bg-light">
      <a href="/" class="navbar-brand">Travel</a>
      <form class="form-inline">
        <!--<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <a class="btn btn-primary" href="/search">ค้นหา</a>-->
        <a class="btn btn-danger" href="/delAllSelect">ลบที่เลือกทั้งหมด</a>
      </form>
    </nav>
    @if(Session::has('attraction_id'))
    <div id="map"></div>
    <div id="right-panel">
    <div>
    <b>ต้นทาง</b>
    <select id="start">
      @foreach($places as $place)
        <option value=<?php echo $place["attractions_name"]; ?>>{{$place["attractions_name"]}}</option>
      @endforeach
    </select>
    <br>
    <b>ปลายทาง</b>
    <select id="end">
      @foreach($places as $place)
        <option value=<?php echo $place["attractions_name"]; ?>>{{$place["attractions_name"]}}</option>
      @endforeach
    </select>
    <br>
      <input type="submit" id="submit">
    </div>
    </div>
    <script>
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsRenderer = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: {lat: 13.776465, lng:100.524566}
        });
        directionsRenderer.setMap(map);

        document.getElementById('submit').addEventListener('click', function() {
          calculateAndDisplayRoute(directionsService, directionsRenderer);
        });
      }

      function calculateAndDisplayRoute(directionsService, directionsRenderer) {


        directionsService.route({
          origin: document.getElementById('start').value,
          destination: document.getElementById('end').value,
          //waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsRenderer.setDirections(response);

          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQLj-_PEe0qXFXtqhs_EdE-ZmC5zoReMs&callback=initMap">
    </script>
    @else
    <p>กรุณาเลือกสถานที่</p>
    @endif
  </body>
</html>
