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
    <link rel="stylesheet" href="css/org/org-profile-style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@stop
    
@section('title', 'Profile')

@section('contents')
<div class="container-fluid px-4 w-75">
    <form id="SubmitForm" enctype="multipart/form-data">
        @csrf
        <div class="row my-5">
            <div class="col-lg-4">
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="card border-0">
                            <div class="card-body shadow-sm">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ $LoggedUserInfo['Profile'] }}" 
                                    alt="user icon" onerror="this.onerror=null; this.src='img/user-icon.png'"
                                    class="rounded-circle p-1" width="200" height="200" id="file-ip-1-preview">
                                    <input type='file' id="image" name="image" onchange='showPreview(event);' hidden/>
                                    <input id='buttonid' type='button' class="btn btn-link text-decoration-none" value='Change Avatar' > 
                                    <div class="mt-3">
                                        <h4></h4>
                                        <p class="text-muted font-size-sm">Officer In Charge</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="card border-0">
                            <div class="card-body shadow-sm">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <div class="mt-3">
                                        <p class="fs-5">Status: <span class="fw-bold">{{ $LoggedUserInfo['Status'] }}</span> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card border-0">
                    <div class="card-body shadow-sm">
                        <div class="row mb-4 align-items-center g-1">
                            <div class="col-lg-3 mb-2">
                                <h6 class="mb-0">Officer In Charge</h6>
                            </div>
                                <div class="col-lg-3 form-floating text-secondary mb-1">
                                    <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name" value="{{ $LoggedUserInfo['lname'] }}">
                                    <label for="lname" style="font-size: 14px;">Last Name</label>
                                </div>
                                <div class="col-lg-3 form-floating text-secondary mb-1">
                                    <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name" value="{{ $LoggedUserInfo['fname'] }}">
                                    <label for="fname" style="font-size: 14px;">First Name</label>
                                </div>
                                <div class="col-lg-3 form-floating text-secondary mb-1">
                                    <input type="text" id="mname" name="mname" class="form-control" placeholder="Middle Name" value="{{ $LoggedUserInfo['mname'] }}">
                                    <label for="mname" style="font-size: 14px;">Middle Name</label>
                                </div>
                        </div>
                        <div class="row mb-4 align-items-center g-1">
                            <div class="col-lg-3 mb-2">
                                <h6 class="mb-0">Organization Name</h6>
                            </div>
                            <div class="col-lg-9 text-secondary">
                                <input type="text" id="orgName" name="orgName" class="form-control" value="{{ $LoggedUserInfo['orgName'] }}">
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center g-1">
                            <div class="col-lg-3 mb-2">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-lg-9 text-secondary  align-items-center">
                                <input type="area" id="address" name="address" class="form-control" value="{{ $LoggedUserInfo['address'] }}">
                            </div>
                        </div>
                        
                        <div class="row mb-4 align-items-center g-1">
                            <div class="col-lg-3 mb-2">
                                <h6 class="mb-0">Signatory Person</h6>
                            </div>
                            <div class="col-lg-9 text-secondary">
                                <input type="text" id="NoS" name="NoS" class="form-control" value="{{ $LoggedUserInfo['NoS'] }}">
                            </div>
                        </div>
                        <div class="row mb-4 align-items-center g-1">
                            <div class="col-lg-3 mb-2">
                                <h6 class="mb-0">Position of Signatory Person</h6>
                            </div>
                            <div class="col-lg-9 text-secondary">
                                <input type="text" id="PoS" name="PoS" class="form-control" value="{{ $LoggedUserInfo['PoS'] }}">
                            </div>
                        </div>

                        <div class="row mb-4 align-items-center g-1">
                            <div class="col-lg-3 mb-2">
                                <h6 class="mb-0">Email Address</h6>
                            </div>
                            <div class="col-lg-7 text-secondary">
                                <input type="text" id="email" name="email" class="form-control" value="{{ $LoggedUserInfo['email'] }}" readonly>
                            </div>
                            <div class="col-lg-2 input-group-append gx-0">
                                <button type="button" class="btn btn-primary shadow-sm w-100" style="font-size:0.98rem;" id="update"
                                data-bs-toggle="modal" data-bs-target="#updateModal">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-end my-3">
                    <div class="justify-content-between">
                        <button type="submit" class="btn btn-success shadow-sm" id="save" disabled>Save</button>
                        <a href="dashboard" class="btn btn-danger btn-md text-white rounded-3 border-0 shadow-sm">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </form>  
    <!-- Update Modal -->
    <form id="changeEmail" action="{{ route('change.email') }}" method="post">
        @csrf
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Email Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3 g-0">
                            <div class="col-lg-12 text-secondary">
                                <input type="text" id="email" name="email" class="form-control @if($errors->first('email')) is-invalid @endif" placeholder="New Email Address" value="{{ old('email') }}">
                                @if($errors->email)
                                <div class="">
                                    <span class="badge bg-danger" style="font-size: 100%">{{ $errors->first('email') }}</span>
                                </div>    
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <span class="output_message" style="color:black"></span>
                        </div>
                        <button type="submit" class="btn btn-primary" id="send" name="send" onclick="load()">Send Mail</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>    
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
        document.getElementById('buttonid').addEventListener('click', openDialog);
        function openDialog() {
            document.getElementById('image').click();
        }
    </script>
    <script>
        function showPreview(event){
            
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
    <script>
        $(document).ready(function() {
        $('#SubmitForm').on('input change', function() {
            $('#save').attr('disabled', false);
        });
        })
    </script>
    <script type="text/javascript">
        $('#SubmitForm').on('submit',function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type:"POST",
                url: "/changeProfile",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response){
                    location.reload();
                },
                error: function(response) {
                   
                },
            });
        });
    </script>
    <script>
        $('#changeEmail').on('submit',function(e){
            $(this).find(':button[type=submit]').prop('disabled', true);
        });
    </script>
    <script>
        function load() {
            $('.output_message').text('Loading...');
            $('.output_message');
        }
    </script>
    @if ($errors->first('email'))
        <script>
            $( document ).ready(function() {
                $('#updateModal').modal('show');
            });
        </script>
    @endif
@stop