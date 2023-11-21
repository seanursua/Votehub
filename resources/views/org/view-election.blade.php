@extends('layout.master')

@section('HeaderScripts')
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <link href="css-icons/css/all.css" rel="stylesheet">
    <link rel="icon" href="img/votehub-icon.png">
    <link rel="stylesheet" href="css/org/view-election-style.css" />
@stop

@section('title','View Election')

@section('view-election','active')

@section('contents')
<div class="container-fluid px-4 w-75">
<div class="row my-4">
    <div class="col-lg-6 col-md-12 mt-3 mb-3">
        <div class="p-2 border-5 border-start border-votes voter-bg primary-text shadow-sm d-flex justify-content-between align-items-center rounded mb-3">
            <div>
                <h3 class="fs-1">{{ $voted->voted }}</h3>
                <p class="fs-5">Counted Votes</p>
            </div>
            </i><i class="fas fa-poll fs-1 rounded-full secondary-bg p-3"></i>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 mt-3 mb-3">
        <div class="p-2 border-5 border-start border-pending pending-bg primary-text shadow-sm d-flex justify-content-between align-items-center rounded mb-3">
            <div>
                <h3 class="fs-1">{{ $pending->pending }}</h3>
                <p class="fs-5">Pending Voter</p>
            </div>
            <i class="fas fa-hourglass-half fs-1 rounded-full secondary-bg p-3"></i></i>
        </div>
    </div>
    <div class="col-lg-12">
         
            <div class="d-flex justify-content-end">
                <button onclick="window.open('/generate-pdf')" class="btn btn-outline-success shadow-sm btn-md mb-4" target="blank" value="Download Result">Download Result</button>
            </div>
        <!-- @if(count($date) > 1)                                         -->    
        <!-- @endif -->
        <div class="col">
            <div class="card">
                <div class="table-responsive">
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="electionTable">
                            <thead>
                                <tr>
                                    <th class="py-1 px-2" scope="col">#</th>
                                    <th class="py-1 px-2" scope="col">Position</th>
                                    <th class="py-1 px-2" scope="col">Leading/s</th>
                                    <th class="py-1 px-2" width=100 scope="col">View Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($checker == true) 
                                    @foreach($users as $user)
                                        <tr>    
                                            <th class="py-1 px-2" scope="row"></th>
                                            <th class="py-1 px-2">{{ $user->position }}</th>
                                            <th class="py-1 px-2">{{ $user->name }}</th>
                                            <td class="py-1 px-2"><a href="{{ route('election.position',['position' => $user->position ]) }}" id="linkView"
                                            class="btn btn-info btn-sm text-white rounded-3 border-0 shadow-sm">
                                            <i class="fas fa-eye fs-6"></i></a></td>    
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
            $('#electionTable').dataTable();
        });
    </script>
@stop