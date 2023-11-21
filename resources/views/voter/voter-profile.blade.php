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
    <link rel="stylesheet" href="css/voter/voter-profile-style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>Profile | votehub</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light border-bottom py-4 px-4">
                    <div class="d-flex align-items-center">
                        <h2 class="fs-2 m-0"></h2>
                    </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user me-2"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('voter.profile') }}">{{ $VoterUser['name'] }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('logoutVoter') }}">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid px-4 w-75">
                    <form id="form" action="{{ route('change.voter.profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row my-5">
                            <div class="col-lg-4">
                                <div class="row mb-3">
                                    <div class="col-lg-12">
                                        <div class="card border-0">
                                            <div class="card-body shadow-sm">
                                                <div class="d-flex flex-column align-items-center text-center">
                                                        <!-- EDIT HERE TO ADD VOTER IMAGE -->
                                                        <img src="{{ $voter->img }}" id="file-ip-1-preview"
                                                        alt="user icon" onerror="this.onerror=null; this.src='img/user-icon.png'"
                                                        class="rounded-circle p-1" width="200" height="200">
                                                        <div class="mt-1">
                                                            <input type='file' id="image" name="image" onchange='showPreview(event);' hidden/>
                                                            <input id='buttonid' type='button' class="btn btn-link text-decoration-none" value='Change Avatar' > 
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
                                                        <p class="fs-5">Voting Status: <span class="fw-bold"></span> </p>
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
                                                <h6 class="mb-0">Voter's Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ $voter->name }}" readonly>
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
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Mobile Number</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" value="{{ $voter->mobileNo }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-end my-3">
                                    <div class="justify-content-between">
                                        <button type="submit" class="btn btn-success shadow-sm" id="save" disabled>Save</button>
                                        <a href="{{ route('ballot') }}" class="btn btn-danger btn-md text-white rounded-3 border-0 shadow-sm">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>
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
        $('#form').on('input change', function() {
            $('#save').attr('disabled', false);
        });
        })
    </script>
</body>
</html>