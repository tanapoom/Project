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
</head>
<style>
    .card {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    body {
        background-color: #999999;
    }
</style>

<body>
    <div class="card text-white bg-dark mb-3" style="width: 25rem;">
        <center>
            <div class="card-header">
                Login
            </div>
        </center>
        <div class="card-body">
            @if(Session::has('loginFail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                username หรือ password ไม่ถูกต้อง
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @else
            @endif
            <form action="{{route('loginController.login')}}" method="post">
                {{csrf_field()}}
                <div class="form-col">
                    <div class="form-group">
                        <label for="username" class="card-text">Username:</label><br>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="card-text">Password:</label><br>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                </div>
            </form>

        </div>
    </div>
</body>

</html>
