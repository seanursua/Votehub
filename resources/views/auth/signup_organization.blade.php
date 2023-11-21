<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="css-icons/css/all.css" rel="stylesheet">
    <link rel="icon" href="img/votehub-icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/signup_organization_style.css">
    <title>votehub.</title>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 my-5">
            <form id="SubmitForm" action="{{ route('register.custom') }}" method="POST">
                @csrf
                <div class="d-flex justify-content-center mb-5">
                    <a href="index"><img src="img/logo-main.png"></a>
                </div>
                <h4 class="text-uppercase mb-3">Sign Up</h4>
                    <div class="form-floating mb-3">
                        <input class="form-control fs-5 @error('orgName') is-invalid @enderror" id="orgName" name="orgName" type="text" placeholder="Your Organization Name"
                        pattern="[A-Za-z0-9,'\s]+" oninvalid="InvalidMsgLetterNumber(this);" oninput="InvalidMsgLetterNumber(this);" value="{{ old('orgName') }}" required/>
                        <label for="org-name">Organization Name</label>
                        <span id="orgNameErrorMsg" class="text-danger">{{ $errors->first('orgName') }}</span>
                    </div>
                    <div class="row">
                        <h5>Officer-in-Charge</h5>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-floating mb-3">
                                <input class="form-control fs-5 @error('lname') is-invalid @enderror" id="lname" name="lname" type="text" placeholder="Your Last Name" 
                                pattern="[A-Za-z\s]+" oninvalid="InvalidMsgLetter(this);" oninput="InvalidMsgLetter(this);" value="{{ old('lname') }}" required/>
                                <label for="last-name">Last Name</label>
                                <span id="lnameErrorMsg" class="text-danger">{{ $errors->first('lname') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-floating mb-3">
                                <input class="form-control fs-5 @error('fname') is-invalid @enderror" id="fname" name="fname" type="text" placeholder="Your First Name"
                                pattern="[A-Za-z\s]+" oninvalid="InvalidMsgLetter(this);" oninput="InvalidMsgLetter(this);" value="{{ old('fname') }}" required/>
                                <label for="first-name">First Name</label>
                                <span id="fnameErrorMsg" class="text-danger">{{ $errors->first('fname') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-floating mb-3">
                                <input class="form-control fs-5 @error('mname') is-invalid @enderror" id="mname" name="mname" type="text" placeholder="Your Middle Name"
                                pattern="[A-Za-z\s]+" oninvalid="InvalidMsgLetter(this);" oninput="InvalidMsgLetter(this);" value="{{ old('mname') }}" required/>
                                <label for="middle-name">Middle Name</label>
                                <span id="mnameErrorMsg" class="text-danger">{{ $errors->first('mname') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control fs-5 @error('address') is-invalid @enderror" id="address" name="address" type="text" placeholder="Your Organization Address"
                        pattern="[A-Za-z0-9,.\s]+" oninvalid="InvalidMsgLetterNumberComma(this);" oninput="InvalidMsgLetterNumberComma(this);" value="{{ old('address') }}" required/>
                        <label for="org-address">Organization Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control fs-5 @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="Your Email Address" value="{{ old('email') }}" required/>
                        <label for="org-email">Email Address</label>
                        <!-- <span id="message"></span> -->
                        <span id="emailErrorMsg" class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control fs-5 @error('password') is-invalid @enderror" id="password" name="password" type="password" title="Be at least 8 characters. With a number, and upper case & lower case letter." minlength="8"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Your Password" required/>
                                <label for="pass">Password</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-floating mb-3">
                                <input class="form-control fs-5 @error('password') is-invalid @enderror" id="conPassword" name="conPassword" type="password" placeholder="Confirm your password" required/>
                                <label for="confirm-pass">Confirm Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control fs-5 @error('NoS') is-invalid @enderror" id="NoS" name="NoS" type="text" 
                        placeholder="Name of Signatory" data-toggle="tooltip" data-bs-placement="right"
                        title="This is the person who will sign the Election Result after Election Officer."
                        pattern="[A-Za-z\s]+" oninvalid="InvalidMsgLetter(this);" oninput="InvalidMsgLetter(this);" value="{{ old('NoS') }}" required/>
                        <label for="signatory">Name of Signatory</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control fs-5 @error('PoS') is-invalid @enderror" id="PoS" name="PoS" type="text" placeholder="Position of Signatory"
                        pattern="[A-Za-z\s]+" oninvalid="InvalidMsgLetter(this);" oninput="InvalidMsgLetter(this);" value="{{ old('PoS') }}" required/>
                        <label for="signatory-position">Position of Signatory</label>
                    </div>
                    <!--
                        <div class="mb-3">
                            <h6>Upload Front ID</h6>
                            <input type="file" name="idFront" id="idFront" class="form-control fs-6">
                        </div>
                        <div class="mb-3">
                            <h6>Upload Back ID</h6>
                            <input type="file" name="idBack" id="idBack" class="form-control fs-6">
                        </div>
                        <div class="mb-3">
                            <h6>Upload Display Photo</h6>
                            <input type="file" name="avatar" id="avatar" class="form-control fs-6">
                        </div>
                    -->
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="terms-and-policy" required>
                        <label class="form-check-label" for="terms-and-policy">
                            I have read, understand and agreed to the 
                            <a href="privacy-policy" class="text-decoration-none" target="/votehub/privacy-policy">
                            Privacy Policy</a> and the <a href="terms-of-service" class="text-decoration-none" target="/votehub/terms-of-service.php">
                            Terms of Services.</a>
                        </label>
                    </div>
                <div class="text-end">
                    <button class="btn btn-primary btn-md shadow-sm rounded-pill btn-lg w-25 mb-4" id="btnSubmit" name="btnSubmit" type="submit">Sign Up</button>
                </div>
            </form>
        </div>     
    </div>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script>
    $('#SubmitForm').on('submit',function(e){
        $(this).find(':button[type=submit]').prop('disabled', true);
    });
</script>
<!-- <script type="text/javascript">
    $('#SubmitForm').on('submit',function(e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type:"POST",
            url: "/custom-registration",
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){    
                window.location.href = "/verifyForm";
            },
            error: function(response) {
                var orgNameElement = document.getElementById("orgName");
                var emailElement = document.getElementById("email");
                $('#orgNameErrorMsg').text(response.responseJSON.errors.orgName);
                if(response.responseJSON.errors.orgName){
                    $("#orgName").addClass('is-invalid');
                }else{
                    $('#orgNameErrorMsg').text("");
                    orgNameElement.classList.remove("is-invalid");
                }
                $('#emailErrorMsg').text(response.responseJSON.errors.email);
                if(response.responseJSON.errors.email){
                    $("#email").addClass('is-invalid');
                }else{
                    $('#emailErrorMsg').text("");
                    emailElement.classList.remove("is-invalid");
                }               
            },
        });
    });
</script>     -->

<script type="text/javascript">
    $(function () {
        $("#btnSubmit").click(function () {
            var password = $("#password").val();					
            var confirmPassword = $("#conPassword").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
            return false;
            }
            return true;
        });
    });		
</script>   
<script>
    function InvalidMsgLetter(textbox) {

        if(textbox.validity.patternMismatch){
            textbox.setCustomValidity('Letters only, no numbers or special characters.');
        }    
        else {
            textbox.setCustomValidity('');
        }
        return true;
    }
</script>
<script>
    function InvalidMsgLetterNumber(textbox) {

        if(textbox.validity.patternMismatch){
            textbox.setCustomValidity('Letters and numbers only, no special characters.');
        }    
        else {
            textbox.setCustomValidity('');
        }
        return true;
    }
</script>
<script>
    function InvalidMsgLetterNumberComma(textbox) {

        if(textbox.validity.patternMismatch){
            textbox.setCustomValidity('Letters, numbers and comma(,) only, no other special characters.');
        }    
        else {
            textbox.setCustomValidity('');
        }
        return true;
    }
</script>
</body>
</html>