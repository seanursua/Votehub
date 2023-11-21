<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="icon" href="img/votehub-icon.png">
    <link href="css-icons/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/voter/login_styles.css" />
    <title>Login</title>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 my-5">
            <form action="{{ route('login.voter') }}" method="post" class="sign-in" onsubmit="submitButton.disabled = true; return true;">
                @csrf
                <div class="d-flex justify-content-center mb-5">
                    <a href="index"><img src="img/logo-main.png"></a>
                </div>
                @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                @endif
                <h4 class="text-uppercase">Log in to votehub</h4>
                    <div class="form-floating mb-3">
                        <input class="form-control fs-5 @if(Session::get('fail')) is-invalid @endif" id="voterID" name="voterID" type="text" placeholder="Your Voter ID..." 
                        pattern="[A-Za-z0-9-@._]+" oninvalid="InvalidMsgLetterNumberDash(this);" oninput="InvalidMsgLetterNumberDash(this);" required/>
                        <label for="voterID">Voter ID</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control fs-5 @if(Session::get('fail')) is-invalid @endif" id="voterKey" name="voterKey" type="password" placeholder="Your Voter Key" required/>
                        <label for="voterKey">Password</label>
                    </div>
                <button class="btn btn-primary btn-md shadow-sm rounded-pill btn-lg w-100 mb-4" id="submitButton" name="submitButton" type="submit">Login</button>
            </form>
        </div>
    <script>
    function InvalidMsgLetterNumberDash(textbox) {

        if(textbox.validity.patternMismatch){
            textbox.setCustomValidity('Letters, numbers and hyphen(-) only, no other special characters.');
        }    
        else {
            textbox.setCustomValidity('');
        }
        return true;
    }
    </script>
    </div>
</body>
</html>