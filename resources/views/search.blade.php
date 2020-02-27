<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!--bootstrap-->
    <style media="screen">
    .container{
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    </style>
  </head>
  <body>
    <center>
    <div class="container">
        <form action="{{ route('getplace.getdata') }}" method="get">
            <div class="form-group">
              <select name="province" class="form-control">
                <option value=34 selected>อุบลราชธานี</option>
              </select>
          </div>
          <input type= "submit" class="btn btn-primary" value= "ค้นหา">
        </form>
    </div>
    </center>
  </body>
  <!--
  <script type="text/javascript">
    function g(){
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "https://tatapi.tourismthailand.org/tatapi/v5/places/search?categorycodes=RESTAURANT" , true);
      xhr.setRequestHeader('Authorization', 'G)LjeSbjx2e61rtD1gHe4uTRpVrdyF0qi)5rv9PU7v4mv(hz9gR41LRL)lZYlD1cD6hAGRSPT49ZzrMQCWvZjtm=====2');
      xhr.send();
      xhr.onreadystatechange = processRequest;
      function processRequest(e) {
        if (xhr.readyState == 4 && xhr.status == 200) {
          console.log(xhr.responseText);
          console.log("*********************************");
          let JSObj = JSON.parse(xhr.responseText);
          console.log(JSObj);
        }
      }
    }
  </script>
  -->
</html>
