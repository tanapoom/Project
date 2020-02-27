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
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        float: left;
        width: 70%;
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
        <div id="map"></div>
        <h5 class="card-title">ลำลับการเดินทาง</h5>
        @foreach($dataresults as $data)
            <p>{{$data["attractions_name"]}}</p>
        @endforeach
        <script>
         function initMap() {
           var directionsService = new google.maps.DirectionsService();
           var directionsRenderer = new google.maps.DirectionsRenderer();
           var map = new google.maps.Map(document.getElementById('map'), {
             center: {lat: 13.684164, lng: 100.709522},
             zoom: 6
           });
            directionsRenderer.setMap(map);
            navigator.geolocation.getCurrentPosition(function(position) {
              var pos = {lat: position.coords.latitude,lng: position.coords.longitude};
              map.setCenter(pos);
              map.setZoom(15);
              calculateAndDisplayRoute(directionsService, directionsRenderer,pos);
            });
         }

         function calculateAndDisplayRoute(directionsService, directionsRenderer,pos) {
            var waypts = [];
            <?php $i=0; ?>
            for (var i = 0; i <= <?php echo count($dataresults)-2; ?>; i++) {
                 waypts.push({
                   location: {lat: <?php echo $dataresults[$i]["Latitude"]; ?>,lng: <?php echo $dataresults[$i]["longitude"]; ?>},
                   stopover: true
                 });
                 <?php echo "console.log(".$i.");";$i++; ?>
             }
            var posdes = {lat: <?php echo $dataresults[count($dataresults)-1]["Latitude"]; ?>,lng: <?php echo $dataresults[count($dataresults)-1]["longitude"]; ?>};
            directionsService.route(
                {
                  origin: pos,
                  destination: posdes,
                  waypoints: waypts,
                  travelMode: 'DRIVING'
                },
                function(response, status) {
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

  </body>
</html>
