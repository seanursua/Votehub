<?php @include "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="css-icons/css/all.css" rel="stylesheet">
    <link rel="icon" href="img/votehub-icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login_admin_style.css" />
    <title>Login</title>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 my-5">
            <form action="{{ route('login.admin') }}" class="sign-in" method="post">
            @csrf
                <div class="d-flex justify-content-center mb-5">
                    <a href="index.php"><img src="img/logo-main.png"></a>
                </div>
                @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                @endif
                <h4 class="text-uppercase">Log in to votehub</h4>
                    <div class="form-floating mb-3">
                        <input class="form-control fs-5" id="adminID" name="adminID" type="text" placeholder="Your Admin Username" required/>
                            <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                        <label for="admin-user">Admin Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control fs-5" id="password" name="password" type="password" placeholder="Your Password" required/>
                            <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                        <label for="admin-password">Password</label>
                    </div>
                <button class="btn btn-primary btn-md shadow-sm rounded-pill btn-lg w-100 mb-4" id="submitButton" type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>