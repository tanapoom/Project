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
    @if(Session::has('attraction_id'))
        <div id="map"></div>
        <h5 class="card-title">สถานที่ที่เลือก</h5>
        @foreach($places as $place)
            <p>{{$place["attractions_name"]}}</p>
        @endforeach
        <form action="{{ route('ResultController.getresult') }}" method="get">
            <div class="form-group">
              <input type= "hidden" name= "lat" id= "lat" >
              <input type= "hidden" name= "lng" id= "lng" >
              <input type= "submit" class="btn btn-primary" value= "ค้นหาเส้นทาง">
            </div>
        </form>
        <button class="btn btn-primary" onclick="set()">ตำแหน่งปัจจุบัน</button>
        <script>
         function initMap() {
           var map = new google.maps.Map(document.getElementById('map'), {
             center: {lat: 13.684164, lng: 100.709522},
             zoom: 6
           });
         }
         var lat = document.getElementById("lat");
         var lng = document.getElementById("lng");
         function set(){
            navigator.geolocation.getCurrentPosition(function(position) {
              lng.value = position.coords.longitude;
              lat.value = position.coords.latitude;
            });
         }
        </script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQLj-_PEe0qXFXtqhs_EdE-ZmC5zoReMs&callback=initMap">
        </script>
        @if(Session::has('result'))
          @foreach($places as $data)
              <p>{{$data["attractions_name"]}}</p>
          @endforeach
        @endif
    @else
    <p>กรุณาเลือกสถานที่</p>
    @endif
  </body>
</html>
