<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!--bootstrap-->
    <style>
    .card{
      margin:25px 25px 25px 30px;
    }
    a,form{
      margin:5px;
    }
    </style>
    <title></title>
  </head>
  <body>
    <nav class="navbar navbar-light bg-light">
      <a href="/" class="navbar-brand">Travel</a>
      <form class="form-inline">
        <a class="btn btn-primary" href="/selectview">สถานที่ที่เลือก</a>
      </form>
    </nav>
    <?php //$get_results = json_decode($data, true); ?>
      @if($places!=null)
        <div class="row">
          @foreach($places as $place)
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="{{$place['image_url']}}" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">{{$place["attractions_name"]}}</h5>
                <div class="row">
                  <a href="/detail/{{$place["attractions_id"]}}" class="btn btn-primary">รายละเอียด</a>
                  <form action="{{ route('addplace.add') }}" method="get">
                    <!--{{csrf_field()}}-->
                    <input type= "hidden" name= "id" value="{{$place["attractions_id"]}}">
                    <input onclick="success()" type= "submit" class="btn btn-primary" value= "เลือก">
                  </form>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <script type="text/javascript">
        function success(){
          alert("success");
        }
        </script>
      @else
        <p>ไม่มีข้อมูล</p>
      @endif
  </body>
</html>
