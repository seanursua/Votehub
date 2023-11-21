@extends('layout.verify')

@section('title')
    <div class="p-2 text-center">
        <h3 class="mb-1">Verify your Account</h3>
    </div>
@stop

@section('verify')
    <div class="p-2 text-center">  
        <form action ="{{ route('logoutVoter') }}">
            <span>We've sent an email to  <span class="fw-bold">{{ $email }}</span></span><input type="submit" value="Logout"/><br>
            <span>You need to verify your email if you wish to continue.</span>
        </form>
    </div>
@stop

@section('resend')
    <div class="content d-flex justify-content-center align-items-center">
        <span class="m-0">Didn't get the code?</span>
        <a class="btn btn-transparent btn-md shadow-none text-danger" href="{{ route('resend.voter.otp', ['email' => $email]) }}">Resend</a>   
    </div>
@stop


@section('script')
<script type="text/javascript"> 
    $('#formID').on('submit',function(e){
        e.preventDefault();
        let formData = new FormData(this); 
        $.ajax({
            type:"POST",
            url: "/submitVoterOtp",
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.status===true){  
                    location.href = "/ballot"               
                }
                if(response.status===false){  
                    $('#codeErrorText').text(response.msg);
                    document.getElementById('password').value = ''                 
                }
            },
                error: function(response) { 
            },
        });
    });
</script>
@stop



