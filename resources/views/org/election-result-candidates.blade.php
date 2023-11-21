<?php
$point = array("label" => "BSIT" , "y" => "10");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <link rel="icon" href="{{ asset('img/votehub-icon.png') }}">
    <link href="{{ asset('css-icons/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/org/election-result-style.css') }}" />
    <title>Election Result | votehub</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="sidebar-bg" id="sidebar-wrapper">
            <div class="sidebar-heading text-center mt-1 py-4 primary-text fs-4 fw-bold text-lowercase border-bottom">
                votehub</div>
                <div class="list-group list-group-flush my-3">
                    <a href="{{ url('dashboard') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-home me-2"></i>Overview</a>
                    <a href="{{ url('positions') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-map-pin me-3"></i>Positions</a>
                    <a href="{{ url('partylist') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i 
                        class="fas fa-parking me-25"></i>Partylist</a>
                    <a href="{{ url('candidates') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-list-alt me-25"></i>Candidates</a>
                    <a href="{{ url('voters') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fas fa-users me-2"></i>Voters</a>
                    <a href="{{ url('results') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i
                        class="fas fa-poll-h me-3"></i>View Election</a>
                </div>
            </div>
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light border-bottom py-4 px-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                        <h2 class="fs-2 m-0">Election Result</h2>
                    </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user me-2"></i>{{ $LoggedUserInfo['fname'] }} {{ $LoggedUserInfo['lname'] }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('orgProfile') }}">Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid py-4 w-75">
                 
                    <div class="d-flex align-items-center">
                        <h3 class="col-auto fs-4 m-0 text-dark flex-grow-1">{{  $position->position }}</h3>
                        <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm text-white rounded-pill border-0 shadow-sm w-25">Back</a>
                    </div>
                    <hr>
                    <br>
                    <!-- CANVAS API CHART -->
                    <div class="d-flex justify-content-center mb-3">
                        <div id="chartContainer" style="height: 370px; width: 70%;" class=""></div>
                        <script src="{{ asset('js/canvasjs.min.js') }}"></script>
                    </div>
                   
                    <div class="p-3 d-flex justify-content-end position-fixed">
                        <button type="button" class="btn btn-outline-primary btn-floating btn-lg shadow-sm" id="btn-back-to-top">
                        <i class="fas fa-angle-up"></i></button>
                    </div>
                </div>
            </div> <!-- /#page-content-wrapper -->
        </div><!-- /#sidebar-wrapper -->
    </div><!-- /#wrapper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
    <!-- CANVAS API BAR CHART  -->
    <script>
    window.onload = function () {
        <?php 
            $dataArray = array();
            $name = "";
            foreach($chart as $encodeData){ 
                $name = $encodeData->name;
                $points = array("label" => $encodeData->section, "y" => $encodeData->votes);
                array_push($dataArray, $points);
            }  
        ?>
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            backgroundColor: "transparent",
            title:{
                text:"<?php echo $name ?>"
            },
            axisX:{
                interval: 1, 
            },
            axisY2:{
                interlacedColor: "rgba(1,77,101,.2)",
                gridColor: "rgba(1,77,101,.1)",
                title: "Total votes got from different sections.",
                
            },
            data: [{
                type: "bar",
                name: "companies",
                axisYType: "secondary",
                color: "#014D65",
                dataPoints: <?php echo json_encode($dataArray,JSON_NUMERIC_CHECK); ?>
                
            }]
        });
    chart.render();

    }
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
