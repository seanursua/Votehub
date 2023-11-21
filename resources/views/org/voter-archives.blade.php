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
    <link href="css-icons/css/all.css" rel="stylesheet">
    <link rel="icon" href="img/votehub-icon.png">
    <link rel="stylesheet" href="css/org/voter-archives-style.css" />
    <title>Archive | votehub</title>
</head>
@stop

@section('title','Voter Archive')

@section('contents')
    <div id="page-content-wrapper">
                <div class="container-fluid py-4 w-75">
                    <!-- <div class="row my-2"> -->
                        <div class="row-lg-12text-dark justify-content-between" id="headerBar">
                            <div class="col-lg-12 mb-3">
                                <div class="d-flex align-items-center">
                                    <h3 class="fs-4 mb-0 flex-grow-1">List of Voters</h3>
                                    <a href="{{ route('voters') }}" class="btn btn-danger btn-sm text-white rounded-pill border-0 shadow-sm w-25">Back</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col">
                            <div class="card">
                                <div class="table-responsive">
                                    <div class="card-body">
                                    <form id="restore">
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
                                                <tr id="">
                                                    <td class="py-1 px-2" width=25><img src="{{ $voter->img }}" alt="user icon" onerror="this.onerror=null; this.src='img/user-icon.png'" height="75" width="75"/></td>
                                                    <td class="py-1 px-2" data-target="name">{{ $voter->name }}</td>
                                                    <td class="py-1 px-2">{{ $voter->status}}</td>
                                                    <td class="py-1 px-2" width=25>
                                                        <a href="{{ route('restore.voter',['id' => $voter->voterID ]) }}" id="btnRestore" name="btnRestore" class="btn-primary btn-sm text-white rounded-3 border-0 shadow-sm mb-1 btnSelect">
                                                        <i class="fas fa-trash-restore"></i></a>  
                                                    </td>
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
                    <div class="p-3 d-flex justify-content-end position-fixed">
                        <button type="button" class="btn btn-outline-primary btn-floating btn-lg shadow-sm" id="btn-back-to-top">
                        <i class="fas fa-angle-up"></i></button>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
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
@stop



