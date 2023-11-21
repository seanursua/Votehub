@extends('layout.master')

@section('HeaderScripts')
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <link href="css-icons/css/all.css" rel="stylesheet">
    <link rel="icon" href="img/votehub-icon.png">
    <link rel="stylesheet" href="css/org/voters-style.css" />
@stop

@section('voters', 'active')

@section('title', 'Voters')

@section('contents')
<div class="container-fluid py-4 w-75">
<!-- <div class="row my-2"> --> 
    <div class="row-lg-12text-dark justify-content-between" id="headerBar">
        <div class="col-lg-12 mb-3">
            <div class="d-flex align-items-center">
                <h3 class="fs-4 mb-0 flex-grow-1">List of Voters</h3>
                @if(count($date) < 1)
                    <button type="submit" 
                        class="btn btn-primary rounded-pill btn-sm shadow-sm border-0 ml-1" 
                        data-bs-toggle="modal" 
                        data-bs-target="#modalAddVoter">
                        <i class="fas fa-plus"></i> Add Voter
                    </button>
                    <button type="submit" 
                        class="btn btn-success rounded-pill btn-sm shadow-sm border-0 ml-1" 
                        data-bs-toggle="modal" 
                        data-bs-target="#modalImport">
                        <i class="fas fa-file-import"></i>Import
                    </button>
                    <a 
                        class="btn btn-archive text-white rounded-pill btn-sm shadow-sm border-0 ml-1" 
                        href="{{ route('voter.archives') }}" >
                        <i class="fa fa-archive"></i> Archives
                    </a>
                    <button type="button" id="btnSend" class="btn btn-secondary rounded-pill btn-sm btn-send border-0 ml-1" 
                        data-bs-toggle="modal" data-bs-target="#modalSend"><i class="fas fa-envelope"></i> Send Mail
                    </button> 
                    <button type="button" class="btn btn-secondary rounded-pill btn-sm shadow-sm border-0" 
                        onclick="location.href='/sendMail';"><i class="fas fa-database"></i></i> Back Up
                    </button>
                @endif
                <!-- Modal Add Voter -->
                    <div class="modal fade" id="modalAddVoter">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="VoterForm">
                                    @csrf
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Add Voters</h5>
                                        <button type="button" class="btn-close shadow-sm fs-6" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label required fs-6 text-dark">Full Name</label>
                                            <span class="text-danger fs-6" id="nameErrorMsg"></span>
                                            <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z\s]+" oninvalid="InvalidMsgLetter(this);" oninput="InvalidMsgLetter(this);"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label required fs-6 text-dark">Section or Course</label>
                                            <span class="text-danger fs-6" id="sectionErrorMsg"></span>
                                            <input type="text" class="form-control" id="section" name="section" pattern="[A-Za-z0-9,.\s]+" oninvalid="InvalidMsgLetter(this);" oninput="InvalidMsgLetter(this);"
                                                required>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-12 dropdown">
                                            <label class="form-label required fs-6 text-dark">Representative Area</label>
                                            <span class="text-danger fs-6" id="representativeErrorMsg"></span>
                                                <select class="form-select" aria-label="Default select example" id="representative" name="representative" required>
                                                    <option value="" disabled selected >Select an area</option>
                                                    <option value="Not Applicable">Not Applicable</option>
                                                    @if($position)
                                                        @foreach($reps as $rep)
                                                            <option value="{{ $rep->position }}">{{ $rep->position }}</option>
                                                        @endforeach 
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6 dropdown">
                                            <label class="form-label required fs-6 text-dark">Gender</label>
                                                <span class="text-danger fs-6" id="genderErrorMsg"></span>
                                                <select class="form-select" aria-label="Default select example" id="gender" name="gender" required>
                                                    <option value="" disabled selected >Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Private">Prefer not to say</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                            <label class="form-label required fs-6 text-dark">Birthdate</label>
                                            <span class="text-danger fs-6" id="bdateErrorMsg"></span>
                                                <input type="date" class="form-control" id="bdate" name="bdate" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="form-label required fs-6 text-dark" >Voter ID</label>
                                                <span class="text-danger fs-6" id="voterIDErrorMsg"></span>
                                                <div class="input-group mb-3">        
                                                    <input type="text" class="form-control" id="voterID" name="voterID" placeholder="Student ID or Company ID"  aria-label="Recipient's username" aria-describedby="basic-addon2" value="" 
                                                    pattern="[A-Za-z0-9-]+" oninvalid="InvalidMsgLetterNumberDash(this);" oninput="InvalidMsgLetterNumberDash(this);" 
                                                    required>     
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <label class="form-label required fs-6 text-dark">Email Address</label>
                                        <span class="text-danger fs-6" id="emailErrorMsg"></span>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">@</div>
                                            </div>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <label class="form-label required fs-6 text-dark">Mobile Number</label>
                                        <span class="text-danger fs-6" id="phoneErrorMsg"></span>
                                        <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="phone" name="phone" maxlength="11" onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))" />                                                        </div>
                                    </div>
                                    <div class="modal-footer ">                                                        
                                        <div>
                                            <button type="submit" id="submitForm" class="btn btn-primary shadow-sm">Submit</button>
                                            <button id="cancel" name="cancel" data-bs-dismiss="modal" class="btn btn-danger shadow-sm">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Import Voter  -->
                    <div class="modal fade" id="modalImport">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="importForm" method="post" action="{{ route('import.voter') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title">Import</h5>
                                        <button type="button" class="btn-close shadow-sm fs-6" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">                                      
                                            <div class="mb-3">
                                                <label class="form-label required fs-6 text-dark">Import CSV File:</label> 
                                                @if($errors->has('document'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('document') }}
                                                    </div>
                                                @endif
                                                <input type="file" id="document" name="document" class="form-control" multiple name="filename">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="upload" name="upload" class="btn btn-primary shadow-sm">Upload</button>
                                        <button id="cancel" name="cancel" data-bs-dismiss="modal" class="btn btn-danger shadow-sm">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Sending Mail to the Voter -->
                <div class="modal fade" id="modalSend">
                    <form action="send-mail.php" method="post">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-send text-white">
                                    <h5 class="modal-title">Send Mail</h5>
                                    <button type="button" class="btn-close shadow-sm fs-6" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                        <div class="mb-3">
                                            <input type="hidden" id="id" name="id" class="form-control">
                                            <label class="form-label required fs-6">Enter your password to confirm</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Your password" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <div>
                                        <span class="output_message" style="color:black"></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary shadow-sm" onclick="load()">Submit</button>
                                    <button id="cancel" name="cancel" data-bs-dismiss="modal" class="btn btn-danger shadow-sm">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>
    <hr>
    <div class="col">
        <div class="card">
            <div class="table-responsive">
                <div class="card-body">
                    <table class="table bg-white table-hover" id="votersTable">
                        <thead>
                            <tr>
                                <th class="py-1 px-2">Avatar</th>
                                <th class="py-1 px-2">Name</th>
                                <th class="py-1 px-2">Vote Status</th>
                                <th class="py-1 px-2">⠀⠀⠀</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($voters as $voter)
                                <tr>
                                    <td class="py-1 px-2" width=25><img src="" alt="user icon" onerror="this.onerror=null; this.src='img/user-icon.png'" height="75" width="75"/></td>
                                    <td class="py-1 px-2">{{ $voter->name }}</td>
                                    <td class="py-1 px-2">{{ $voter->status }}</td>
                                    <td class="py-1 px-2" width=25>
                                    <a href="{{ route('view.voter',['id' => $voter->voterID ]) }}" type="button" id="linkViewVoter" class="btn-info text-white btn-sm rounded-3 border-0 shadow-sm mb-1">
                                    <i class="fas fa-eye"></i></a>
                                        @if(count($date) < 1)
                                        <button type="button" id="btnDelete" class="btnDel btn-danger text-white btn-sm rounded-3 border-0 shadow-sm mb-1"
                                        data-bs-toggle="modal" data-bs-target="#modalDelete" data-role="delete" data-userid="{{ $voter->voterID }}" data-name="{{ $voter->name }}">
                                        <i class="fas fa-trash-alt fs-6"></i></button>
                                        @endif
                                        <div class="modal fade" id="modalDelete">
                                            <form id="deleteVoter">
                                                @csrf
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title">Delete Voter</h5>
                                                            <button type="button" class="btn-close shadow-sm fs-6" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <p><span class="fw-bold text-danger">Warning: </span>Are you sure you want to delete this Voter?
                                                                    <br>
                                                                    <span id="name1" style="font-weight:bolder; font-size:25px"></span>
                                                                </p>
                                                                    <input type="hidden" id="vid" name="vid" class="form-control">
                                                                    <label class="form-label required fs-6">Enter your password to confirm</label>
                                                                    <span class="text-danger fs-6" id="passwordErrorText"></span>
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
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
        <!-- <script type="text/javascript" src="jquery-3.5.1.min.js"></script> -->
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
    <script>
        $(document).ready(function(){
            $('#votersTable').dataTable();
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
    <script type="text/javascript">
        $('#VoterForm').on('submit',function(e){
            e.preventDefault();
            $(this).find(':button[type=submit]').prop('disabled', true);
            let formData = new FormData(this);
            $.ajax({
                type:"POST",
                url: "{{ route('add.voter') }}",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response){
                    location.reload();
                },
                error: function(response) {
                    document.getElementById("submitForm").disabled = false;
                    $('#nameErrorMsg').text(response.responseJSON.errors.name);
                    $('#sectionErrorMsg').text(response.responseJSON.errors.section);
                    $('#representativeErrorMsg').text(response.responseJSON.errors.representative);
                    $('#genderErrorMsg').text(response.responseJSON.errors.gender);
                    $('#bdateErrorMsg').text(response.responseJSON.errors.bdate);
                    $('#voterIDErrorMsg').text(response.responseJSON.errors.voterID);
                    $('#emailErrorMsg').text(response.responseJSON.errors.email);
                    $('#phoneErrorMsg').text(response.responseJSON.errors.phone);
                },
            });
        });
    </script>
    <script>
        $(document).on('click','.btnDel',function(){
            var userID=$(this).attr('data-userid');
            var userName=$(this).attr('data-name');
            $('#vid').val(userID); 
            $('#name1').text(userName);
        });
    </script>
    <script type="text/javascript">
        $('#deleteVoter').on('submit',function(e){
            e.preventDefault();
            let formData = new FormData(this);
            let dPasswordDiv = document.getElementById('passwordErrorDiv');
            $.ajax({
                type:"POST",
                url: "{{ route('delete.voter') }}",
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
                    $('#requiredErrorMsg').text(response.responseJSON.errors.password);
                },
            });
        });
    </script>
    @if (count($errors) > 0)
        <script type="text/javascript">
             $(document).ready(function(){
                $('#modalImport').modal('show');
            });
        </script>
    @endif
@stop