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
      body {
        background-color: #999999;
      }
      a,form{
        margin:5px;
      }
      #div1 {
        margin: 10px;
        padding: 10px;
      }
      .row{
        margin: 10px;
        padding: 10px;
      }
      .card{
        margin:25px 25px 25px 30px;
      }
      img{
        width:100%;
        height:300px;
      }
    </style>
  </head>
  <body>
    @if(Session::has('attraction_id'))
    <nav class="navbar navbar-dark bg-dark">
      <a href="/" class="navbar-brand">Travel</a>
      <div class="form-inline">
        <a class="btn btn-danger" href="/delAllSelect">ลบที่เลือกทั้งหมด</a>
        <form action="{{ route('ResultController.getresult') }}" method="post">
          {{csrf_field()}}
          <input type= "hidden" name= "lat" id= "lat" >
          <input type= "hidden" name= "lng" id= "lng" >
          <input type= "submit" class="btn btn-primary" value= "ค้นหาเส้นทาง">
        </form>
      </div>
    </nav>
        <div class="row">
          @foreach($selecteds as $selected)
          <div class="card text-white bg-secondary mb-3" style="width: 18rem;">
            <img class="card-img-top" src="{{$selected['image_url']}}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{$selected["attractions_name"]}}</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('addplace.del') }}" method="get">
                <input type= "hidden" name= "id" value="{{$selected["attractions_id"]}}">
                <input type= "submit" class="btn btn-danger" value= "ลบ">
              </form>
            </div>
          </div>
          @endforeach
        </div>
        <script>
        var lat = document.getElementById("lat");
        var lng = document.getElementById("lng");
         function getCurrent() {
             navigator.geolocation.getCurrentPosition(function(position) {
               lat.value = position.coords.latitude;
               lng.value = position.coords.longitude;
             });
         }
        </script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQLj-_PEe0qXFXtqhs_EdE-ZmC5zoReMs&callback=getCurrent">
        </script>
    @else
    <nav class="navbar navbar-dark bg-dark">
      <a href="/" class="navbar-brand">Travel</a>
      <div class="form-inline">
        <a class="btn btn-danger" href="/delAllSelect">ลบที่เลือกทั้งหมด</a>
      </div>
    </nav>
    <p>กรุณาเลือกสถานที่</p>
    @endif
  </body>
</html>
