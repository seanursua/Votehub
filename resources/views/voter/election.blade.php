<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="css-icons/css/all.css" rel="stylesheet">
    <link rel="icon" href="img/votehub-icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <title>votehub</title>
    <style>
        .row {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light border-bottom py-4 px-4 justify-content-center">
        <div class="d-flex align-items-center">
            <h2 class="fs-2 m-0">{{ $dates->name }}</h2>
            <!-- <h2 class="fs-2 m-0">Election Name</h2> -->
        </div>
    </nav>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row m-auto">
            <div class="text-center">
                <h1 style="font-size: 60px;">Thank you for using <span class="fw-bold" 
                style="font-family: 'Balsamiq Sans'; color:#2B4050; font-size: 60px;">votehub!</span></h1>
            </div>
            <div class="col-lg-12 text-center bg-primary text-white mb-4" style="--bs-bg-opacity: .8;">
                <p class="fs-5 my-auto p-3">This election is scheduled to start on {{ date('m/d/Y h:i a' ,strtotime($dates->startdate ?? '')) }}</p>
            </div>
            <div class="col-lg-12 d-flex justify-content-center">
               <a href="/logoutVoter" class="btn btn-primary btn-md shadow-sm" >Logout</a>
            </div>
        </div>
    </div>
</body>
</html>