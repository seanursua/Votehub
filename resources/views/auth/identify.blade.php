<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="{{ asset('css-icons/css/all.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/votehub-icon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/identify-style.css') }}" />
    <title>Login</title>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 my-5">
            <form id="identifyOrg" method="POST" action="{{ route('search.email') }}">
                <div class="d-flex justify-content-center mb-5">
                    <a href="index"><img src="img/logo-main.png"></a>
                </div>
                @csrf
                
                    <div class="card text-center">
                        <div class="card-header">
                            <h5 class="d-flex align-items-center mt-2">Find Your Account</h5>
                        </div>
                        <div class="card-body">
                                <p class="d-flex">Please enter your email to search for your account.</p>
                                @if(Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('fail') }}
                                    </div>
                                @endif    
                            <div class="form-floating">
                                <input class="form-control fs-5 @if(Session::get('fail')) is-invalid @endif" id="email" name="email" type="email" placeholder="Your Email..." required email/>
                                <label for="email">Email Address</label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary shadow-sm mx-1">Search</button>
                                <button id="cancel" name="cancel" class="btn btn-secondary shadow-sm" onclick="location.href='login';">Cancel</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <script src="jquery-3.5.1.min.js"></script>
    <!-- <script type="text/javascript">
        $(document).ready(function(){
            $("#identifyOrg").on("submit",function(e){
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url : "identify-action.php",
                    type : "POST",
                    cache:false,
                    data : formData,
                    contentType: false,
                    processData: false,
                    success:function(result){
                        if(result == 1){
                            alert("Sorry, we were unable to find an email address that matched your search.");
                        }
                        if(result == 0){
                            window.location.href = "password-reset.php";
                        }
                    }
                });  
            });
        });
    </script>  -->
</body>
</html>