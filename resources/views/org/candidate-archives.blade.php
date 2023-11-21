@extends('layout.master')

@section('HeaderScripts')
    <head>
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
        <link rel="stylesheet" href="css/org/candidate-archives-style.css" />
        <title>Archive | votehub</title>
    </head>
@stop

@section('title', 'Candidates Archive')

@section('contents')
<div class="container-fluid py-4 w-75">
        <div class="row-lg-12 text-dark justify-content-between" id="headerBar">
            <div class="col-lg-12 mb-3">
                <div class="d-flex align-items-center">
                    <h3 class="fs-4 m-0 flex-grow-1">List of Candidates </h3>
                    <a href="{{ route('candidates') }}" class="btn btn-danger btn-sm text-white rounded-pill border-0 shadow-sm w-25">Back</a> 
                </div>
            </div>
        </div>
        <hr>
        <div class="col">
            <div class="card">
                <div class="table-responsive">
                    <div class="card-body">
                    <form id="restore">  
                        <table class="table table-hover" id="candidateTable">
                            <thead>
                                <tr>
                                    <th class="py-1 px-2" scope="col" hidden>ID</th>
                                    <th class="py-1 px-2" scope="col">Avatar</th>
                                    <th class="py-1 px-2" scope="col">Full Name</th>
                                    <th class="py-1 px-2" scope="col">Position</th>
                                    <th class="py-1 px-2" scope="col">Partylist</th>
                                    @if(count($date) < 1) 
                                    <th class="py-1 px-2" scope="col"></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($candidates as $candidate)
                                    <tr id="{{ $candidate->id }}" name="CID">
                                        <td class="py-1 px-2" data-target="name" hidden></td>
                                        <td class="py-1 px-2"><img src="{{ $candidate->photo }}" alt="user icon" onerror="this.onerror=null; this.src='image/user-icon.png'" height="75" width="75"/></td>
                                        <td class="py-1 px-2" data-target="name">{{ $candidate->name }}</td>
                                        <td class="py-1 px-2">{{ $candidate->position }}</td>
                                        <td class="py-1 px-2">{{ $candidate->partyList }}</td>
                                        @if(count($date) < 1) 
                                            <td class="py-1 px-2" width=25>
                                                <a href="{{ route('restore.candidate',['id' => $candidate -> id ]) }}" type="button" id="linkViewCandidate" class="btn-primary btn-sm text-white rounded-3 border-0 shadow-sm mb-1 btnSelect">
                                                <i class="fas fa-trash-restore"></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form> 
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <div class="p-3 d-flex justify-content-end">
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
    <script>
       $(document).ready(function(){
// code to read selected table row cell data (values).
            
        });
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

@stop