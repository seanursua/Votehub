<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="{{ asset('css-icons/css/all.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/votehub-icon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="">
    <title>Verification | votehub</title>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 my-5">
            <div class="d-flex justify-content-center mb-5">
                <img src="{{ asset('img/logo-main.png') }}"></a>
            </div>
            @yield('title')

                @yield('verify')
                    <div class="text-center">
                        <span id="codeErrorText" style="color:red"></span> 
                    </div>
                <form id="formID">  
                    @csrf
                    <div class="text-center">
                        <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                        <input class="m-2 text-center form-control rounded" type="text" id="email" name="email" value=""  hidden/>
                            <input class="m-2 text-center form-control rounded ap-otp-input" type="text" id="first" name="first" maxlength="1" />
                            <input class="m-2 text-center form-control rounded ap-otp-input" type="text" id="second" name="second" maxlength="1" />
                            <input class="m-2 text-center form-control rounded ap-otp-input" type="text" id="third" name="third" maxlength="1" />
                            <input class="m-2 text-center form-control rounded ap-otp-input" type="text" id="fourth" name="fourth" maxlength="1" />
                            <input class="m-2 text-center form-control rounded ap-otp-input" type="text" id="fifth" name="fifth"  maxlength="1" />
                            <input class="m-2 text-center form-control rounded ap-otp-input" type="text" id="sixth" name="sixth" maxlength="1" />
                        </div>
                        <div class="mt-2 mb-2"> 
                            <button class="btn btn-danger px-4 validate" id="submit" name="submit" type="submit">Verify</button> 
                        </div>
                    </div>
                </form>
                <div class="card-2">
                    @yield('resend')
                    <span class="m-0 d-flex justify-content-center" id="timeLeft">Time left: 60 seconds</span>
                </div>               
        </div> 
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        const $inp = $(".ap-otp-input");

        $inp.on({
            paste(ev) { // Handle Pasting
            
                const clip = ev.originalEvent.clipboardData.getData('text').trim();
                // Allow numbers only
                if (!/\d{6}/.test(clip)) return ev.preventDefault(); // Invalid. Exit here
                // Split string to Array or characters
                const s = [...clip];
                // Populate inputs. Focus last input.
                $inp.val(i => s[i]).eq(5).focus(); 
            },
            input(ev) { // Handle typing
                
                const i = $inp.index(this);
                if (this.value) $inp.eq(i + 1).focus();
            },
            keydown(ev) { // Handle Deleting
                
                const i = $inp.index(this);
                if (!this.value && ev.key === "Backspace" && i) $inp.eq(i - 1).focus();
            }
        
        });

    </script>
    <script>
        window.onload = function(){
            document.getElementsByName("resend")[0].disabled = true;
            setTimeout(function(){  
                var element = document.getElementsByName("resend")[0] ;
                element.disabled = false;
            }, 60000);

            document.getElementsByName("submit")[0].disabled = false;
            setTimeout(function(){  
                var element1 = document.getElementsByName("submit")[0] ;
                element1.disabled = true;
            }, 60000);
        }
        var countdownNum = 60;
        incTimer();
        function incTimer(){
            setTimeout (function(){
                if(countdownNum != 0){
                    countdownNum--;
                    document.getElementById('timeLeft').innerHTML = 'Time left: ' + countdownNum + ' seconds';
                    incTimer();
                } else {
                    document.getElementById('timeLeft').innerHTML = '';
                }
            },1000);
        }
    </script>   
    @yield('script') 
</body>
</html>