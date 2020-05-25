<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!--bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!--bootstrap-->
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
    @if(Session::has('success'))
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
    @foreach ($attractions as $attraction)
    <div class="card">
        <div class="card-body">
            <form action="{{route('adminController.update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-col">
                    <input type="hidden" name="attractions_id" value="{{$attraction['attractions_id']}}">
                    <div class="col-md-4 mb-3">
                        <label>ชื่อสถานที่ท่องเที่ยว</label>
                        <input type="text" class="form-control" name="attractions_name" placeholder="{{$attraction['attractions_name']}}" value="{{$attraction['attractions_name']}}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Latitude</label>
                        <input type="number" step="any" class="form-control" name="lat" placeholder="{{$attraction['Latitude']}}" value="{{$attraction['Latitude']}}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Longtitud</label>
                        <input type="number" step="any" class="form-control" name="lng" placeholder="{{$attraction['longitude']}}" value="{{$attraction['longitude']}}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>รายละเอียด</label>
                        <textarea class="form-control " name="description" required>{{$attraction['description']}}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>รูปภาพ</label>
                        <input type="file" name="image[]"  multiple="multiple" required multiple>
                    </div>
                    <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                </div>
            </form>
        </div>
    </div>
    @endforeach
</body>
</html>
