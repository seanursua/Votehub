@extends('layout.master')

@section('HeaderScripts')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link href="{{ asset('css-icons/css/all.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/votehub-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/org/voter-profile-style.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@stop

@section('title','Voter Profile')

@section('contents')

<div class="container-fluid px-4 w-75">
    <div class="row my-5">
        <div class="col-lg-4">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="card border-0">
                        <div class="card-body shadow-sm">
                            <div class="d-flex flex-column align-items-center text-center">
                                <!-- EDIT HERE TO ADD VOTER IMAGE -->
                                <img src="{{ $voter->img }}" id="file-ip-1-preview"
                                alt="user icon" onerror="imageError(this)"
                                class="rounded-circle p-1" width="200" height="200">
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
                                    <p class="fs-5">Status: <span class="fw-bold"></span>{{ $voter->status }}</p>
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
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Name of Voter</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="{{ $voter->name }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Section</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="{{ $voter->section }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Representative</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="{{ $voter->representative }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Gender</h6>
                        </div>
                        <div class="col-sm-9 text-secondary  align-items-center">
                            <input type="area" class="form-control" value="{{ $voter->gender }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Birthdate</h6>
                        </div>
                        <div class="col-sm-9 text-secondary  align-items-center">
                            <input type="area" class="form-control" value="{{ $voter->bday }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email Address</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="{{ $voter->email }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Phone Number</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="{{ $voter->mobileNo }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-end my-3">
                <div class="justify-content-between">
                <button type="button" id="btnSend" class="btn btn-send btn-md text-white rounded-3 border-0 shadow-sm" 
                data-bs-toggle="modal" data-bs-target="#modalSend" >
                <i class="fas fa-envelope"></i> Send Mail</button>
                    <div class="modal fade" id="modalSend">
                        <form action="single-mail.php" method="post">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-send text-white">
                                        <h5 class="modal-title">Send Mail</h5>
                                        <button type="button" class="btn-close shadow-sm fs-6" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                            <div class="mb-3">
                                                <input type="hidden" id="id" name="id" value="ID" class="form-control">
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
                    <a href="{{ route('voters') }}" class="btn btn-danger btn-md text-white rounded-3 border-0 shadow-sm">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('BottomScripts')				
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script> 
        function imageError(image){
            image.onerror = "";
            image.src = "{{ asset('img/user-icon.png') }}";
            return true;
        }
    </script>
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
            document.getElementById('fileid').click();
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
        function load() {
            $('.output_message').text('Loading...');
            $('.output_message');
        }
    </script>
@stop
