@extends('layout.master')

@section('HeaderScripts')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link href="css-icons/css/all.css" rel="stylesheet">
    <link rel="icon" href="img/votehub-icon.png">
    <link rel="stylesheet" href="css/org/overview-organization-style.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@stop
 
@section('title','Overview')

@section('dashboard', 'active')

@section('contents')
    <div class="container-fluid px-4 w-75">
        <div class="row my-4">
            <div class="col-lg-8">
                <div class="row-lg-12 row-md-12 mt-3 mb-1">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item fw-bold border-bottom">Election Name</li>
                            <li class="list-group-item">{{ $date -> name ?? '' }}</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mt-3 mb-1">
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item fw-bold border-bottom"><i class="far fa-calendar-alt"></i> Start Date</li>
                                <li class="list-group-item">{{ date('m/d/Y h:i a' ,strtotime($date -> startdate ?? '')) }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mt-3 mb-1">
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item fw-bold border-bottom"><i class="far fa-calendar-alt"></i> End Date</li>
                                <li class="list-group-item">{{ date('m/d/Y h:i a' ,strtotime($date -> enddate ?? '')) }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="justify-content-center">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-1">
                            @if(!$date)
                            <button type="submit" class="btn btn-outline-success rounded-pill btn-md w-100 shadow-sm mt-md-3" data-bs-toggle="modal" data-bs-target="#modalCreate">
                            <i class="far fa-plus-square"></i> Create Schedule</button>
                            @endif
                        </div>
                        <div class="modal fade" id="modalCreate">
                            <div class="modal-dialog">
                                <form id="SubmitForm" method="POST" action="{{ route('create.election') }}">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title">Create schedule for your election</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                                <div class="form-details">
                                                    <div class="mb-3">
                                                        <label class="form-label required fw-bold">Election Name</label>
                                                        <span class="text-danger fs-6" id="nameErrorMsg"></span>
                                                        <input type="text" name="name" id="name" class="form-control" pattern="[A-Za-z0-9,.'\s]+" oninvalid="InvalidMsgLetterNumber(this);" oninput="InvalidMsgLetterNumber(this);" required>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label required fw-bold">Election Start</label>
                                                            <span class="text-danger fs-6" id="electionStartErrorMsg"></span>
                                                            <input type="datetime-local" name="electionStart" id="electionStart" class="form-control" id="electionStart" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label required fw-bold">Election End</label>
                                                            <span class="text-danger fs-6" id="electionEndErrorMsg"></span>
                                                            <input type="datetime-local" name="electionEnd" id="electionEnd" class="form-control" id="electionEnd" required>
                                                        </div>
                                                    </div>
                                                </div>  
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary shadow-sm" id="createBtn" name="createBtn" >Create</button>  
                                            <button id="cancel" name="cancel" data-bs-dismiss="modal" class="btn btn-danger shadow-sm">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-1">
                            @if($date)
                                <button type="submit" class="btn btn-outline-primary rounded-pill btn-md w-100 shadow-sm mt-md-3" data-bs-toggle="modal" data-bs-target="#modalReset">
                                <i class="fas fa-undo"></i> Reset Election</button> 
                            @endif
                            <div class="modal fade" id="modalReset">
                                <form id="resetElection">
                                    @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Reset Election</h5>
                                                <button type="button" class="btn-close shadow-sm fs-6" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <p><span class="fw-bold">Warning: </span>Please note that resetting this election will result to deletion of all data and results. Download and save all needed information before confirming.</p>
                                                    <label class="form-label required fs-6">Enter your password to confirm</label>
                                                    <span id="passwordErrorText" class="text-danger"></span>                                                              
                                                    <input type="password" name="password" id="password" class="form-control" placeholder="Your password" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary shadow-sm">Submit</button>
                                                <button id="cancel" name="cancel" data-bs-dismiss="modal" class="btn btn-danger shadow-sm">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-lg-12 col-md-12 mt-3 mb-3">
                    <div class="p-3 border-5 border-start border-voters voter-bg card-text shadow-sm d-flex justify-content-between align-items-center rounded">
                        <div>
                            <h3 class="fs-1">{{ $users[0]->voterCount ?? '0' }}</h3>     
                            <p class="fs-5">Voters</p>
                        </div>
                        <i class="fas fa-users fs-1 rounded-full secondary-bg p-3"></i>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 mt-3 mb-3">
                    <div class="p-3 border-5 border-start border-positions positions-bg card-text shadow-sm d-flex justify-content-between align-items-center rounded">
                        <div>
                            <h3 class="fs-1">{{ $users[0]->positionCount ?? '0' }}</h3>
                            <p class="fs-5">Positions</p>
                        </div>
                        <i class="fas fa-map-pin fs-1 rounded-full secondary-bg p-3"></i>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 mt-3 mb-3">
                    <div class="p-3 border-5 border-start border-candidates candidates-bg card-text shadow-sm d-flex justify-content-between align-items-center rounded">
                        <div>
                            <h3 class="fs-1">{{ $users[0]->candidateCount ?? '0' }}</h3> 
                            <p class="fs-5">Candidates</p>
                        </div>
                        <i class="fas fa-list-alt fs-1 rounded-full secondary-bg p-3"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 d-flex justify-content-end position-fixed">
            <button type="button" class="btn btn-outline-primary btn-floating btn-lg shadow-sm" id="btn-back-to-top">
            <i class="fas fa-angle-up"></i></button>
        </div>
    </div>
@stop


@section('BottomScripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
    <script>
        //Get the button
        let mybutton = document.getElementById("btn-back-to-top");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
        scrollFunction();
        };

        function scrollFunction() {
        if (
            document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20
        ) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
        }
        // When the user clicks on the button, scroll to the top of the document
        mybutton.addEventListener("click", backToTop);

        function backToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
        }
    </script>
    <script type="text/javascript"> 
        $("#createBtn").click(function () {
            var startDate = document.getElementById("electionStart").value;
            var endDate = document.getElementById("electionEnd").value;
            var ToDate = new Date();
            if (new Date(startDate).getTime() <= ToDate.getTime()) {
                alert("The Start Date must be Bigger or not equal to today date");
                return false;
            } else if(new Date(endDate).getTime() <= new Date(startDate).getTime()){
                alert("The End Date must be Bigger or not equal to Start Date");
                return false;
            }
        return true;
        });
    </script>
    <script type="text/javascript">
        $('#resetElection').on('submit',function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type:"POST",
                url: "{{ route('reset.election') }}",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.status===true){
                        location.reload();    
                    }
                    if(response.status===false){
                        $('#passwordErrorText').text(response.msg);
                        document.getElementById('password').value = '' 
                    }
                },
                error: function() {
                    $('#passwordErrorMsg').text(response.responseJSON.errors.password);
                },
            });
        });
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
@stop