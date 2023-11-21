<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="{{ asset('css-icons/css/all.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/votehub-icon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/password-reset-style.css') }}" />
    <title>Login</title>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 my-5">
            <form action="password-reset-action.php" method="post">
                <div class="d-flex justify-content-center mb-5">
                    <a href="index"><img src="{{ asset('img/logo-main.png') }}"></a>
                </div>
                    <div class="card text-center">
                        <div class="card-header">
                            <h5 class="d-flex align-items-center mt-2">Reset your password</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="form-check col-lg-8">
                                    <div class="row-lg-6 text-start">
                                        <p>How do you want to get the code to reset your password?</p>
                                    </div>
                                    <div class="row-lg-6 text-start">
                                        <input class="form-check-input" type="radio" name="buttonSend" id="buttonSend" checked>
                                        <label class="form-check-label" for="buttonSend">
                                            Send code via email
                                            {{ $data['email'] }}
                                        </label>
                                    </div>
                                    <div class="row text-start">
                                        <label for="buttonSend">
                                            <!-- Insert Email of user requesting password recovery. -->
                                            
                                        </label>
                                    </div>
                                </div>
                                <div class="row-lg-4">
                                    <!-- Insert Image of user requesting password recovery. -->
                                    <img src="{{ $data['Profile'] }}" 
                                    alt="user icon" onerror="this.onerror=null; this.src='/votehub/organization/image/user-icon.png'"
                                    class="rounded-circle p-1" width="70" height="70">
                                    <div class="mt-1">
                                        <!-- Insert Name of user requesting password recovery. -->
                                        <p class="font-size-sm">{{ $data['fname'] }} {{ $data['lname'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-primary shadow-sm" onclick="location.href='password-reset-action.php'">Continue</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <script src="jquery-3.5.1.min.js"></script>
</body>
</html>