<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/admin/home_admin_style.css" />
    <link rel="icon" href="img/votehub-icon.png">
    <title>Overview | votehub</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="sidebar-bg" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 mt-1 fw-bold text-lowercase border-bottom">
                votehub</div>
            <div class="list-group list-group-flush my-3">
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i
                        class="fas fa-home me-2"></i>Overview</a>
                <a href="activityLog" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-file-alt me-2"></i>Log Files</a>
                <a href="viewOrganization" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-sitemap me-2"></i>View Organization</a>
                <a href="{{ route('logoutAdmin') }}" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-sign-out-alt me-2"></i>Logout</a>
            </div>
        </div>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Overview</h2>
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
                                <li><a class="dropdown-item" href="{{ route('logoutAdmin') }}">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4 w-75">
                <div class="row g-3 my-3">
                    <div class="col-md-6">    
                        <div class="p-3 applications-bg primary-text shadow-sm d-flex justify-content-between align-items-center rounded">
                            <div>
                                <h3 class="fs-1">{{ $pending }}</h3>
                                <p class="fs-4">Pending Applications</p>
                            </div>
                            <i class="fas fa-list-alt fs-1 rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 active-org-bg primary-text shadow-sm d-flex justify-content-between align-items-center rounded">
                            <div>
                                <h3 class="fs-1">{{ $active }}</h3>
                                <p class="fs-4">Active Organizations</p>
                            </div>
                            <i class="fas fa-check-circle fs-1 rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                    <div class="col">
                    <h3 class="fs-4 my-3">Registered Organizations</h3>
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">Organization Name</th>
                                    <th scope="col">Election Officer Name</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($organizations as $organization)
                                <tr>
                                    <th scope="row">{{$organization -> id}}</th>
                                    <td>{{$organization -> orgName}}</td>
                                    <td>{{$organization -> fname}} {{$organization -> lname}}</td>
                                </tr>  
                            @endforeach  
                            </tbody>
                        </table>
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