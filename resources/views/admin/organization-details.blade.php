<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link href="{{ asset('css-icons/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/organization-details-style.css') }}" />
    <link rel="icon" href="img/votehub-icon.png">
    <title>Organization Details | votehub</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="sidebar-bg" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 mt-1 fw-bold text-lowercase border-bottom">
                votehub</div>
                <div class="list-group list-group-flush my-3">
                    <a href="{{ route('adminDashboard') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fas fa-home me-2"></i>Overview</a>
                    <a href="{{ route('activityLog') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fas fa-user-check me-2"></i>Log Files</a>
                    <a href="{{ route('viewOrganization') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i
                            class="fas fa-sitemap me-2"></i>View Organization</a>
                    <a href="{{ route('logoutAdmin') }}" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                            class="fas fa-sign-out-alt me-2"></i>Logout</a>
                </div>
            </div>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Organization Details</h2>
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
                                <i class="fas fa-user me-2"></i>{{ $AdminUser['name'] }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('logoutAdmin') }}" >Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4 w-75">
                <div class="row my-5">
                    <div class="col-lg-4">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="card border-0">
                                    <div class="card-body shadow-sm">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="{{ asset($id->Profile) }}" 
                                            alt="user icon" onerror="this.onerror=null; this.src='/votehub/organization/image/user-icon.png'"
                                            class="rounded-circle p-1" width="200" height="200">
                                            <div class="mt-3">
                                                <h4>{{$id->fname}} {{$id->lname}}</h4>
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
                                                <p class="fs-5">Status: <span class="fw-bold"></span>{{$id->Status}}</p>
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
                                        <h6 class="mb-0">Organization Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" value="{{$id->orgName}}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary  align-items-center">
                                        <input type="area" class="form-control" value="{{$id->address}}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" value="{{$id->email}}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Front ID Card</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <a href="{{ asset($id->IDFront) }}" target="blank"><img src="{{ asset($id->IDFront) }}" width="75" height="75"
                                        alt="user icon" onerror="this.onerror=null; this.src='/votehub/organization/image/user-icon.png'"></a>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Back ID Card</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <a href="{{ asset($id->IDBack) }}" target="blank"><img src="{{ asset($id->IDBack) }}" width="75" height="75"
                                        alt="user icon" onerror="this.onerror=null; this.src='/votehub/organization/image/user-icon.png'"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex justify-content-end my-3">
                                    <a href="{{ route('viewOrganization') }}" class="btn btn-danger btn-md text-white rounded-3 border-0 shadow-sm">Back</a>
                        </div>
                    </div>
                </div>
                
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
</body>
</html>