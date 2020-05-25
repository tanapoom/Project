<!DOCTYPE html>
<html>

<head>
    <title></title>
    <script type="text/javascript">
        function setForm(value) {
            if (value == 'form1') {
                document.getElementById('form1').style = 'display:block;';
                document.getElementById('form2').style = 'display:none;';
            } else {

                document.getElementById('form2').style = 'display:block;';
                document.getElementById('form1').style = 'display:none;';
            }
        }

        /*function setImage(value) {
            if (value == 'urlform') {
                document.getElementById('urlform').style = 'display:block;';
                document.getElementById('browsform').style = 'display:none;';
            } else {

                document.getElementById('browsform').style = 'display:block;';
                document.getElementById('urlform').style = 'display:none;';
            }
        }*/
    </script>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!--bootstrap-->
    <script>
        /*$('#myInput').on('change', function() {
            //get the file name
            var fileName = document.getElementById("myInput").files[0].name;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })*/
    </script>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a href="/" class="navbar-brand">Travel</a>
        <form class="form-inline">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Admin
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="/admin" class="dropdown-item">หน้าแรก</a>
                    <a class="dropdown-item" href="/admin/insert">เพิ่มข้อมูล</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/admin/logout">Log out</a>
                </div>
            </div>
        </form>
    </nav>
    <?php

    use App\Province;

    $provinces =  Province::all();
    ?>
    <div class="card">
        <div class="card-header">
            <label>เพิ่มข้อมูล</label>
            <select class="custom-select" onchange="setForm(this.value)" style="width: 25rem;">
                <option value="form1">สถานที่ท่องเที่ยว</option>
                <option value="form2">จังหวัด</option>
            </select>
        </div>
        <div class="card-body">
            @if(Session::has('inserted'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                success
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (count($errors) > 0)
                      <div class="alert alert-danger">

                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
            @endif
            <!--form1-->
            <div id="form1">
                <form action="{{route('adminController.insertAttraction')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-col">
                        <div class="col-md-4 mb-3">
                            <label>จังหวัด</label>
                            <select name="province_id" class="form-control">
                                @foreach ($provinces as $province)
                                <option value={{$province["provinces_id"]}}>{{$province["provinces_name"]}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>ชื่อสถานที่ท่องเที่ยว</label>
                            <input type="text" class="form-control" name="attractions_name" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Latitude</label>
                            <input type="number" step="any" class="form-control" name="lat" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Longtitud</label>
                            <input type="number" step="any" class="form-control" name="lng" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>รายละเอียด</label>
                            <textarea class="form-control " name="description" required></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>รูปภาพ</label>
                            <input type="file" name="image[]"  multiple="multiple" required multiple>
                        </div>
                        <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                    </div>
                </form>
            </div>
            <!--form2-->
            <div id="form2" style="display: none">
                <form action="{{route('adminController.insertProvince')}}" method="post">
                    {{csrf_field()}}
                    <div class="col-md-4 mb-3">
                        <label>รหัสจังหวัด</label>
                        <input type="number" class="form-control" name="province_id" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>ชื่อจังหวัด</label>
                        <input type="text" class="form-control" name="province_name" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
