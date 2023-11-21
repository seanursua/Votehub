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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="css/admin/log-files-style.css" />
    <link rel="icon" href="img/votehub-icon.png">
    <title>Log Files | votehub</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="sidebar-bg" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 mt-1 fw-bold text-lowercase border-bottom">
                votehub</div>
            <div class="list-group list-group-flush my-3">
                <a href="adminDashboard" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-home me-2"></i>Overview</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i
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
                    <h2 class="fs-2 m-0">Log Files</h2>
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
            <form action="backup2.php">
                <div class="container-fluid py-4 w-75">
                    <div class="d-flex align-items-center">
                        <h3 class="col-auto flex-grow-1">Recorded Logs</h3>
                        <button class="btn btn-sm btn-primary shadow-sm rounded-pill" type="button" onclick="location.reload()"><i class="fas fa-redo"></i> Refresh List  </button>
                        <button class="btn btn-sm btn-primary shadow-sm rounded-pill" type="submit" id="backupBtn" name="backupBtn"><i class="fas fa-database"></i> Backup Database</button>
                    </div>
                    <hr>
                    <div class="card">
                        <div class="table-responsive">
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover" id="LogsTable">
                                    <thead>
                                        <tr>
                                            <th class="py-1 px-2">Time</th>
                                            <th class="py-1 px-2">Resource Name</th>
                                            <th class="py-1 px-2">Type</th>
                                            <th class="py-1 px-2">Action</th>
                                            <th class="py-1 px-2">Performed by</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="py-1 px-2"></td>
                                            <td class="py-1 px-2"></td>
                                            <td class="py-1 px-2"></td>
                                            <td class="py-1 px-2"></td>
                                            <td class="py-1 px-2"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
        $(document).ready(function(){
            $('#LogsTable').dataTable();
        });
    </script>
</body>
</html>