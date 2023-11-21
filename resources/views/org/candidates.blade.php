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
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <link rel="icon" href="img/votehub-icon.png">
    <link href="css-icons/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/org/candidates-style.css" />
@stop

@section('candidates', 'active')

@section('title', 'Candidates')

@section('contents')
<div class="container-fluid py-4 w-75">
        <!-- <div class="row"> -->
        <div class="row-lg-12 text-dark justify-content-between" id="headerBar">
            <div class="col-lg-12 mb-3">
                <div class="d-flex align-items-center">
                    <h3 class="fs-4 m-0 flex-grow-1">List of Candidates</h3>
                    @if($checker == true)
                        @if(count($date) < 1)
                            <button type="submit" 
                            class="btn btn-primary rounded-pill btn-sm shadow-sm border-0 ml-1" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalAddVoter">
                            <i class="fas fa-plus"></i> Add Candidates</button>
                            <a href="{{ route('candidateArchive') }}" class="btn btn-archive text-white rounded-pill btn-sm shadow-sm border-0 ml-1">
                            <i class="fa fa-archive"></i> Archives</a> 
                        @endif
                        <div class="modal fade" id="modalAddVoter">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form id="SubmitForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Add Candidate</h5>
                                            <button type="button" class="btn-close shadow-sm fs-6" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label required fs-6 text-dark" >Position</label>
                                                <select class="form-select" aria-label="Default select example" id="position" name="position" required>
                                                    <option value="" disabled selected>Select Position</option>
                                                    @foreach($positions as $position)
                                                        <option value="{{ $position->position }}">{{ $position->position }}</option>                                 
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required fs-6 text-dark" >Partylist</label>
                                                <select class="form-select" aria-label="Default select example" id="partylist" name="partylist" required>
                                                    <option value="" disabled selected>Select Partylist</option>
                                                    @foreach($partylists as $partylist)
                                                        <option value="{{ $partylist->partyName }}">{{ $partylist->partyName }}</option> 
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required fs-6 text-dark">Candidate's Full Name</label>
                                                <input type="text" class="form-control" id="candidateName" name="candidateName" pattern="[A-Za-z0-9.,\s]+" oninvalid="InvalidMsgLetter(this);" oninput="InvalidMsgLetter(this);" required>
                                            </div>
                                            <div class="row mb-3">
                                                    <div class="col-md-6 dropdown">
                                                    <label class="form-label required fs-6 text-dark">Gender</label>
                                                        <select class="form-select" aria-label="Default select example" id="gender" name="gender" required>
                                                            <option value="" disabled selected>Select Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Private">Prefer not to say</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <label class="form-label required fs-6 text-dark">Birthdate</label>
                                                        <input type="date" class="form-control" id="bdate" name="bdate" required>
                                                    </div>
                                            </div>
                                            <label class="form-label required fs-6 text-dark">Email Address</label>
                                            <div class="input-group mb-3" >
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">@</div>
                                                </div>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required fs-6 text-dark">Candidate Photo</label>
                                                <input type="file" name="image" id="image" class="form-control" required>
                                            </div>     
                                            <div class="mb-3">
                                                <label class="form-label required fs-6 text-dark">Candidate's Information</label>
                                                <textarea type="text" class="form-control" id="info" name="info" pattern="[A-Za-z0-9,.\s@!*]+" oninvalid="InvalidMsgLetter(this);" oninput="InvalidMsgLetter(this);" required></textarea>
                                            </div>                                                 
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="submit" id="submit" class="btn btn-primary shadow-sm">Submit</button>
                                            <button id="cancel" name="cancel" data-bs-dismiss="modal" class="btn btn-danger shadow-sm">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                            <!-- <button type="button" class="btn btn-info rounded-pill text-white btn-sm shadow-sm border-0 ml-1" onclick="location.href='ballot.php';">
                            <i class="fas fa-search"></i> Preview Ballot</button>  -->
                            <a class="btn btn-info rounded-pill text-white btn-sm shadow-sm border-0 ml-1" href="{{ route('previewBallot') }}"><i class="fas fa-search"></i> Preview Ballot</a>
                            <!-- <button type="button" class="btn btn-secondary rounded-pill btn-sm shadow-sm border-0" onclick="location.href='saveCandidatesData.php';">
                            <i class="fa fa-database"></i> Back Up</button>   -->
                    @endif      
                </div>
            </div>
        </div>
        <hr>
        <div class="col">
            <div class="card">
                <div class="table-responsive">
                    <div class="card-body">
                        <table class="table table-hover" id="candidateTable">
                            <thead>
                                <tr>
                                    <th class="py-1 px-2" scope="col">Avatar</th>
                                    <th class="py-1 px-2" scope="col">Full Name</th>
                                    <th class="py-1 px-2" scope="col">Position</th>
                                    <th class="py-1 px-2" scope="col">Partylist</th>
                                    <th class="py-1 px-2" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($checker == true)   
                                @foreach($candidates as $candidate)
                                <tr id="">
                                    <td class="py-1 px-2"><img src="{{ asset($candidate->photo) }}" alt="user icon" onerror="imageError(this)" height="75" width="75"/></td>
                                    <td>{{ $candidate->name }}</td>
                                    <td>{{ $candidate->position }}</td>
                                    <td>{{ $candidate->partyName }}</td>
                                    <td class="py-1 px-2" width=25>
                                        <a href="{{ route('candidate.profile',['id' => $candidate -> id ]) }}" type="button" id="linkViewCandidate" class="btn-info text-white btn-sm rounded-3 border-0 shadow-sm mb-1">
                                        <i class="fas fa-eye"></i></a>  
                                            @if(count($date) < 1)                                                                      
                                            <button type="button" id="btnRemarks" class="btnRem btn-warning text-white btn-sm rounded-3 mb-1 border-0 shadow-sm" 
                                            data-bs-toggle="modal" data-bs-target="#modalRemarks" data-role="remarks" data-userid="{{ $candidate->id }}" data-name="{{ $candidate->name }}">
                                            <i class="fas fa-ban fs-6"></i></button>
                                            @endif
                                                <div class="modal fade" id="modalRemarks">
                                                    <div class="modal-dialog">
                                                        <form id="DisqualifyForm">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-warning text-white">
                                                                    <h5 class="modal-title">Edit Remarks</h5>
                                                                    <button type="button" class="btn-close fs-6" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <p><span class="fw-bold text-warning">Warning: </span>Are you sure you want to disqualify this candidate?
                                                                        <span id="name1" style="font-weight:bolder; font-size:25px"></span>
                                                                        </p>
                                                                        <input type="hidden" id="CID1" name="CID1" class="form-control">
                                                                        <label class="form-label required fs-6">Enter your password to confirm</label>
                                                                        <span class="text-danger fs-6" id="RPasswordErrorText"></span>
                                                                        <input type="password" name="rPassword" id="rPassword"  class="form-control" placeholder="Your password" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary shadow-sm">Submit</button>                                                                    
                                                                    <button id="cancel" name="cancel" data-bs-dismiss="modal" class="btn btn-danger shadow-sm">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                @if(count($date) < 1)
                                                <button type="button" id="btnDelete" name="btnDelete" class="btnDel btn-danger btn-sm text-white rounded-3 border-0 shadow-sm mb-1"
                                                data-bs-toggle="modal" data-bs-target="#modalDelete" data-role="delete" data-userid="{{ $candidate->id }}" data-name="{{ $candidate->name }}">
                                                <i class="fas fa-trash-alt fs-6"></i></button>
                                                @endif
                                                <div class="modal fade" id="modalDelete">
                                                    <div class="modal-dialog">
                                                        <form id="DeleteForm">
                                                            @csrf 
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger text-white">
                                                                    <h5 class="modal-title">Delete Candidate</h5>
                                                                    <button type="button" class="btn-close shadow-sm fs-6" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <p><span class="fw-bold text-danger">Warning: </span>Are you sure you want to delete this Candidate?
                                                                            <br>
                                                                            <span id="name" style="font-weight:bolder; font-size:25px"></span>
                                                                        </p>
                                                                        <input type="hidden" id="CID" name="CID" class="form-control">
                                                                        <label class="form-label required fs-6">Enter your password to confirm</label>
                                                                        <span class="text-danger fs-6" id="DPasswordErrorText"></span>
                                                                        <input type="password" id="dPassword" name="dPassword" class="form-control" placeholder="Your password" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary shadow-sm">Submit</button>
                                                                    <button id="cancel" name="cancel" data-bs-dismiss="modal" class="btn btn-danger shadow-sm">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </form>  
                                                    </div>
                                                </div>  
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif  
                                    </tbody>
                                </table>
                            </div>
                        </div>  
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
            $('#candidateTable').dataTable();
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
        function imageError(image){
            image.onerror = "";
            image.src = "{{ asset('img/user-icon.png') }}";
            return true;
        }
    </script>
    <script type="text/javascript">
        $('#SubmitForm').on('submit',function(e){
            e.preventDefault();

            let formData = new FormData(this);
            $.ajax({
                type:"POST",
                url: "/addCandidate",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response){
                    location.reload();
                },
                error: function(response) {
                    $('#positionErrorMsg').text(response.responseJSON.errors.position);
                    $('#partylistErrorMsg').text(response.responseJSON.errors.partylist)
                    $('#candidateNameErrorMsg').text(response.responseJSON.errors.candidateName);
                    $('#genderErrorMsg').text(response.responseJSON.errors.gender);
                    $('#bdateErrorMsg').text(response.responseJSON.errors.bdate);
                    $('#emailErrorMsg').text(response.responseJSON.errors.email);
                    $('#imageErrorMsg').text(response.responseJSON.errors.image);
                    $('#infoErrorMsg').text(response.responseJSON.errors.info);
                },
            });
        });
    </script>
    <script>
        $(document).on('click','.btnRem',function(){
            var userID=$(this).attr('data-userid');
            var userName=$(this).attr('data-name');
            $('#CID1').val(userID); 
            $('#name1').text(userName);
        });
    </script>
    <script type="text/javascript">
        $('#DisqualifyForm').on('submit',function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type:"POST",
                url: "{{  route('disqualify.candidate') }}",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.status===true){
                        location.reload();    
                    }
                    if(response.status===false){  
                        $('#RPasswordErrorText').text(response.msg);
                        document.getElementById('rPassword').value = '' 
                    }
                },
                error: function() {
                    $('#rPasswordErrorMsg').text(response.responseJSON.errors.rPassword);
                },
            });
        });
    </script>
    <script>
        $(document).on('click','.btnDel',function(){
            var userID=$(this).attr('data-userid');
            var userName=$(this).attr('data-name');
            $('#CID').val(userID); 
            $('#name').text(userName);
        });
    </script>
    <script type="text/javascript">
        $('#DeleteForm').on('submit',function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type:"POST",
                url: "{{ route('delete.candidate') }}",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.status===true){
                        location.reload();    
                    }
                    if(response.status===false){  
                        $('#DPasswordErrorText').text(response.msg);
                        document.getElementById('dPassword').value = '' 
                    }
                },
                error: function() {
                    $('#dPasswordErrorMsg').text(response.responseJSON.errors.dPassword);
                },
            });
        });
    </script>
@stop
