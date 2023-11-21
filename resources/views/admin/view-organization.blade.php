<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link href="css-icons/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin/view-organization-style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="icon" href="img/votehub-icon.png">
    <title>View Organization | votehub</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="sidebar-bg" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 mt-1 fw-bold text-lowercase border-bottom">
                votehub</div>
                <div class="list-group list-group-flush my-3">
                    <a href="adminDashboard" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fas fa-home me-2"></i>Overview</a>
                    <a href="activityLog" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fas fa-file-alt me-2"></i>Log Files</a>
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i
                            class="fas fa-sitemap me-2"></i>View Organization</a>
                    <a href="{{ route('logoutAdmin') }}" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                            class="fas fa-sign-out-alt me-2"></i>Logout</a>
                </div>
            </div>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">View Organization</h2>
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
                <div class="row my-4">
                    <h3 class="fs-4 mb-3">Organizations</h3>
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col" width="70%">Organization Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($organizations as $organization)
                                <tr>
                                    <th scope="row">{{ $organization -> id}}</th>
                                    <th data-target="name"><a href="{{ url('orgProfile/' . $organization -> id) }}" class="org-link link-dark text-decoration-none">{{ $organization -> orgName}}</a></th>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm border-0 shadow-sm text-white" id="archiveBtn" 
                                        name="archiveBtn" data-bs-toggle="modal" data-bs-target="#modalArchive" data-role="archive">
                                        <i class="fas fa-archive"></i> Archive</button>
                                        <div class="modal fade" id="modalArchive">
                                            <div class="modal-dialog">
                                            <form action="archive.php" method="post">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning text-white">
                                                            <h5 class="modal-title">Archive Organization</h5>
                                                            <button type="button" class="btn-close shadow-sm fs-6" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <p><span class="fw-bold text-warning">Warning: </span>Are you sure you want to archive this Organization?</p>
                                                                    <p><input type="text" id="name" class="form-control" disabled></p>
                                                                    <input type="hidden" id="OID" name="OID" class="form-control">
                                                                    <label class="form-label required fs-6">Enter your password to confirm</label>
                                                                    <input type="password" name="password" id="password" class="form-control" placeholder="Your password" required>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary shadow-sm">Submit</button>
                                                            <button id="cancel" name="cancel" data-bs-dismiss="modal" class="btn btn-danger shadow-sm">Cancel</button>
                                                        </div>
                                                    </div>
                                            </form>
                                            </div>
                                        </div>
                                    </td>
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
