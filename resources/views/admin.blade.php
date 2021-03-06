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
    <?php

    use App\Province;

    $provinces = Province::all();

    ?>
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
        ลบข้อมูลแล้ว
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="card">
        <table style="width:100%" class="table">
            <tr>
                <th scope="col">รหัสจังหสัด</th>
                <th scope="col">ชื่อจังหวัด</th>
                <th></th>
            </tr>
            @foreach ($provinces as $province)
            <tr>
                <td>{{$province["provinces_id"]}}</td>
                <td>{{$province["provinces_name"]}}</td>
                <form class="delete" action="{{ route('adminController.deleteProvince') }}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="province_id" value={{$province["provinces_id"]}}>
                    <td><input type="submit" class="btn btn-danger" value="ลบ"></td>
                </form>
                <form action="{{ route('adminController.search') }}" method="get">
                    <input type="hidden" name="province_id" value={{$province["provinces_id"]}}>
                    <td><input type="submit" class="btn btn-primary" value="ค้นหา"></td>
                </form>
            </tr>
            @endforeach
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('.delete').on('submit', function() {
                if (confirm("ยืนยันการลบ ?")) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
</body>

</html>