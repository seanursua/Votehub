<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link rel="icon" href="img/votehub-icon.png">
    <link href="css-icons/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/voter/vote-style.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Vote | votehub</title>
</head>
<body>
<form action="{{ route('review.votes') }}" method="post">
    @csrf
    <div class="d-flex" id="wrapper">
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom py-4 px-4">
                <div class="d-flex align-items-center">
                    <h2 class="fs-2 m-0">Election Name</h2>
                </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="right: 0; left: auto;">
                                <li><a class="dropdown-item" href="{{ route('voter.profile') }}">{{ $VoterUser['name'] }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('logoutVoter') }}">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid py-4 w-100">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="col d-flex justify-content-end text-end align-items-center">
                            <div class="dropdown my-1 text-end me-2">
                                <input type="checkbox" class="form-check-input align-self-center" id="select-all">
                                <label class="form-check-label fw-bold" for="select-all">
                                    Check All
                                </label>
                            </div>
                            <div class="dropdown my-3 w-25">
                                <input type="text" id="myInput" name="myInput" class="form-control" list="partylist"  placeholder="Search..." >
                                <datalist id="partylist">
                                    <option value="ABR">
                                </datalist>
                            </div>
                            <div class="dropdown my-3 ms-1">
                                <button type="button" class="btn btn-primary shadow-sm" onClick="window.location.reload();">Uncheck</button>
                            </div>
                        </div>
                        <div class="col">
                            <div class="table-responsive">
                                @foreach($positions as $key=>$position)
                                    <table class="table bg-white rounded shadow-sm table-hover">    
                                        <caption>A maximum of ({{ $position->maxWeight }}) 
                                            votes is required for this position</caption>
                                        <div class="table-head d-flex bg-primary text-white p-1">
                                            <h6 class="ms-1">{{ $position->position }}</h6>
                                        </div>
                                        <thead>
                                            <tr>
                                                <th class="py-1 px-2">Avatar</th>
                                                <th class="py-1 px-2">Candidate Name</th>
                                                <th class="py-1 px-2">Partylist</th>
                                                <th class="py-1 px-2" width=25></th>
                                            </tr>
                                        </thead>
                                        <tbody data-group="{{ $key }}" data-group-limit="{{ $position->maxWeight }}"  id="myTable">
                                        @foreach($candidates as $candidate) 
                                            @if($position->position == $candidate->position)
                                            <tr id="">
                                                <td class="py-1 px-2" ><a type="button" href="#" data-role="avt" data-bs-toggle="modal" data-bs-target="#modalAvatar" data-id=""><img src="img/user-icon.png" height="75" width="75"></a></td>
                                                <div class="modal fade" id="modalAvatar" tabindex="-1" aria-labelledby="modalAvatarLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="name"></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex justify-content-center">
                                                                <img id="myImage" class="img-responsive" src="img/user-icon.png" height="200" width="200">
                                                            </div>
                                                            <div class="details">
                                                                <label for="candidate-details" id="candidate-details">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <th class="py-1 px-2" id="" data-target="name">{{ $candidate->name }}</th>
                                                <th class="py-1 px-2">{{ $candidate->partylist }}</th>
                                                <th class="py-1 px-2" data-target="details" hidden>Details</th>
                                                <th class="py-1 px-2" data-target="img" hidden>Image</th>
                                                <td class="py-1 px-2">
                                                    <div class="form-check">
                                                    @if($position->maxWeight > 1)   
                                                        <input class="form-check-input fs-3"
                                                                name="candidate[]" 
                                                                data-group="{{ $key }}" 
                                                                type="checkbox" 
                                                                value="{{ $candidate->id }}"> 
                                                    @else
                                                    <input class="form-check-input fs-3"
                                                                name="candidate[{{ $position->position }}]" 
                                                                data-group="" 
                                                                type="radio" 
                                                                value="{{ $candidate->id }}"
                                                                > 
                                                    @endif
                                                    </div>
                                                </td> 
                                            </tr>
                                            @endif
                                        @endforeach    
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if($dates->startdate < $today && $dates->enddate > $today)
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-primary rounded-pill btn-md shadow-sm">
                            <i class="fas fa-search"></i> Review Votes</button>
                        </div>
                    @endif
                    <div class="p-3 d-flex justify-content-end position-fixed">
                        <button type="button" class="btn btn-outline-primary btn-floating btn-lg shadow-sm" id="btn-back-to-top">
                        <i class="fas fa-angle-up"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
</form>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $("[data-group-limit]").each(function() {
                let group = $(this).data('group')
                let limit = $(this).data('group-limit')
                //console.log("Init group " + group + " with limit of " + limit) 
                $("[data-group="+group+"]:not([data-group-limit])").click(function(e) { 
                    if ($("[data-group="+group+"]:checked").length > limit) { 
                        //console.log("Limit exceed for group " + group) 
                        e.preventDefault() 
                    }
                })
            })
        })
    </script>
    <script>
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
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
</body>
</html>



