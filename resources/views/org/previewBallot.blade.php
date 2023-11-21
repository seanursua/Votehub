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
    <link rel="stylesheet" href="{{ asset('css/org/ballot-style.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@stop

@section('title', 'Preview Ballot')

@section('contents')
 <div class="container-fluid py-4 w-100">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center" id="headerBar">
                    <h3 class="col-auto fs-4 m-0 text-dark flex-grow-1">Current Ballot</h3>
                    <a href="{{ route('candidates') }}" class="btn btn-danger btn-sm text-white rounded-pill border-0 shadow-sm w-25">Back</a>
                </div>
                <hr>
                <div class="col">
                    <div class="table-responsive">
                    @foreach($positions as $position)
                        <table class="table bg-white rounded shadow-sm table-hover">
                            <div class="table-head d-flex bg-primary text-white p-1">
                                <h6 class="ms-1">{{ $position->position }}</h6>
                            </div>
                            <thead>
                                <tr>
                                    <th class="py-1 px-2">Avatar</th>
                                    <th class="py-1 px-2">Candidate Name</th>
                                    <th class="py-1 px-2" width=25>Partylist</th>
                                </tr>
                            </thead>
                            @foreach($candidates as $candidate) 
                                @if($candidate->position == $position->position)
                                    <tbody id="myTable">
                                        <tr>
                                            <td class="py-1 px-2"><img src="" alt="user icon" onerror="this.onerror=null; this.src='/orgImage/user-icon.png'" height="75" width="75"></td>
                                            <th class="py-1 px-2" id="">{{ $candidate->name }}</th>
                                            <th class="py-1 px-2">{{ $candidate->partylist }}</th>
                                            </td>
                                        </tr> 
                                    </tbody>
                                @endif
                            @endforeach   
                        </table>   
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="p-3 d-flex justify-content-end position-fixed">
                <button type="button" class="btn btn-outline-primary btn-floating btn-lg shadow-sm" id="btn-back-to-top">
                <i class="fas fa-angle-up"></i></button>
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
@stop



