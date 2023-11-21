@extends('layout.master')

@section('HeaderScripts')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/votehub-icon.png') }}">
    <link href="{{ asset('css-icons/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/org/candidate-profile-style.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@stop

@section('title','Candidates Profile')

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
                                <img src="{{ asset($candidates->photo) }}" id="file-ip-1-preview"
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
                                    <p class="fs-5">Remarks: <span class="fw-bold">{{ $candidates->status }}</span> </p>
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
                            <h6 class="mb-0">Position</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="{{ $candidates->position }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Party</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="{{ $candidates->partyList }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Name of Candidate</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="{{ $candidates->name }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Gender</h6>
                        </div>
                        <div class="col-sm-9 text-secondary  align-items-center">
                            <input type="area" class="form-control" value="{{ $candidates->gender }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Birthdate</h6>
                        </div>
                        <div class="col-sm-9 text-secondary  align-items-center">
                            <input type="area" class="form-control" value="{{ $candidates->bday }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email Address</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" value="{{ $candidates->email }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Candidate's Information</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <textarea type="text" class="form-control" value="" readonly>{{ $candidates->info }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-end my-3">
                <div class="justify-content-between">
                    <a href="{{ route('candidates') }}" class="btn btn-danger btn-md text-white rounded-3 border-0 shadow-sm">Back</a>
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
@stop