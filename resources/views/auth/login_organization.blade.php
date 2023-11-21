<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="css-icons/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login_organization_style.css" />
    <link rel="icon" href="img/votehub-icon.png">
    <title>Login</title>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 my-5">
            <form id="login" class="sign-in" method="post" action="{{ route('login.custom') }}" onsubmit="submitButton.disabled = true; return true;">
            @csrf
                <div class="d-flex justify-content-center mb-5">
                    <a href="index"><img src="{{ asset('img/logo-main.png') }}"></a>
                </div>
                @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                @endif
                <h4 class="text-uppercase">Log in to votehub</h4>
                    <div class="form-floating mb-3">
                        <input class="form-control fs-5 @if(Session::get('fail')) is-invalid @endif" id="email" name="email" type="email" placeholder="Your Email..." required/>
                        <label for="email">Email Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control fs-5 @if(Session::get('fail')) is-invalid @endif" id="password" name="password" type="password" placeholder="Your Password" required/>
                        <label for="password">Password</label>    
                    </div>
                    <button class="btn btn-primary btn-md shadow-sm rounded-pill btn-lg w-100 mb-4" id="submitButton" name="submitButton" type="submit">Login</button>
                   
                    <div class="d-flex justify-content-center align-text-center">
                        <h6><a href="{{ route('identify') }}" class="text-decoration-none">Forgot Password?</a> 
                        <a href="{{ route('register-user') }}" class="text-decoration-none">Sign up for Votehub</a></h6>
                    </div>
            </form>
        </div>
    </div>
</body>

</html>