<!DOCTYPE html>
<html>
  <head>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!--bootstrap-->
    <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 500px;  /* The height is 400 pixels */
        width: 600px;  /* The width is the width of the web page */
        margin: 25px 25px 25px 100px;
       }
       .card{

         width: 450px;
         margin: 25px;
         padding: 5px;
       }
       #cardlocation{
         height: auto;
         width: auto;
         margin: 25px;
         padding: 5px;
       }
       h3 {
         margin: 10px 10px 1px 100px;
        }
        body {
          background-color: #999999;
        }
        img{
          width:100%;
          height:300px;
        }
    </style>
  </head>
  <body>
    @foreach($details as $detail)
    <nav class="navbar navbar-dark bg-dark">
      <a href="/" class="navbar-brand">Travel</a>
      <form action="{{ route('addplace.add') }}" method="get">
        <!--{{csrf_field()}}-->
        <input type= "hidden" name= "id" value="{{$detail["attractions_id"]}}">
        <input onclick="success()" type= "submit" class="btn btn-primary" value= "เลือก">
      </form>
    </nav>
    <?php
      $pics= explode("|",$detail['image_url']);
     ?>
     <center>
       <div class="card">
          <div class="card-body">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <?php
                for ($i=0; $i < count($pics) ; $i++) {
                  if ($i==0) {
                    echo "<div class='carousel-item active'>";
                    echo "<img class='d-block w-100' src='../upload/$pics[$i]' >";
                    echo "</div>";
                  }else {
                    echo "<div class='carousel-item'>";
                    echo "<img class='d-block w-100' src='../upload/$pics[$i]' >";
                    echo "</div>";
                  }
                } ?>

              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
     </center>
    <h3 class="text-left">{{$detail['attractions_name']}}</h1>
    <div class="row">
        <div id="map"></div>
        <script>
        function initMap() {
          var uluru = {lat: {{$detail["Latitude"]}}, lng:{{$detail["longitude"]}} };
          var map = new google.maps.Map(
              document.getElementById('map'), {
                zoom: 16,
                center: uluru
              });
          var marker = new google.maps.Marker({position: uluru, map: map});
        }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQLj-_PEe0qXFXtqhs_EdE-ZmC5zoReMs&callback=initMap"
        async defer></script>
        <div class="card">
          <h3>รายละเอียด</h3>
          <p>{{$detail["description"]}}</p>
        </div>
    </div>
    @endforeach
    <script type="text/javascript">
    function success(){
      alert("success");
    }
    </script>
    <div class="card" id="cardlocation">
      <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v6.0"></script>
      <center><div class="fb-comments" data-href={{Request::url()}} data-width="1000" data-numposts="5"></div></center>
    </div>
  </body>
</html>
