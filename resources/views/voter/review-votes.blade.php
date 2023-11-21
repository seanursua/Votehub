<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/votehub-icon.png') }}">
    <link href="{{ asset('css-icons/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/voter/review-votes-style.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Review Votes | votehub</title>
</head>
<body>
<form id="submitForm" action="{{ route('submit.form') }}">   
    <div class="d-flex" id="wrapper">
        <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light border-bottom py-4 px-4">
                    <div class="d-flex align-items-center">
                        <h2 class="fs-2 m-0"></h2>
                    </div>
                </nav>
            <div class="container-fluid px-4 w-100">
                <div class="row my-5 justify-content-center">
                    <!-- Vote Summary -->
                    <div class="col-lg-7">
                        <div class="row mb-3 text-center">
                            <h2>Vote Summary</h2>
                            <h6 class="text-muted">Review your casted votes before submitting</h6>
                        </div>
                        <div class="card border-0">
                            <div class="card-body shadow-sm">
                                <div class="col border-bottom mb-3">
                                    <div class="table-responsive">
                                        <table class="table bg-white rounded table-hover">
                                            <div class="table-head d-flex bg-primary text-white px-1">
                                                <h5 class="ms-1 mt-1">Your candidates</h5>
                                            </div>
                                            <thead>
                                                <tr>
                                                    <th class="py-1 px-2" scope="col">Avatar</th>
                                                    <th class="py-1 px-2" scope="col">Position</th>
                                                    <th class="py-1 px-2" scope="col">Candidate Name</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                            @foreach($candidates as $candidate)    
                                                <tr>
                                                    <td class="py-1 px-2"><img src="" alt="user icon" onerror="this.onerror=null; this.src='img/user-icon.png'" width="75" height="75"></td>
                                                    <th  class="py-1 px-2">{{ $candidate->position }}</th>
                                                    <th  class="py-1 px-2">{{ $candidate->name }}</th>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>   
                                <div class="d-flex justify-content-end">
                                    <!-- Back Button -->
                                        <a onclick="history.back();" class="btn btn-outline-danger w-25 btn-md shadow-sm text-uppercase mx-1">Go Back</a>
                                    <!-- Submit Button -->
                                        <button type="button" class="btn btn-primary w-25 btn-md shadow-sm text-uppercase" data-bs-toggle="modal" data-bs-target="#modalSubmit">
                                        <i class="fas fa-paper-plane"></i> Submit Vote</button>
                                </div>
                                <div class="modal fade" id="modalSubmit">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success text-white">
                                                <h5 class="modal-title">Are you sure you want to submit your votes?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Note: You are only allowed to vote once. Make sure to double check your ballot before you submit.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary shadow-sm">Yes</button>
                                                <button id="cancel" name="cancel" data-bs-dismiss="modal" class="btn btn-danger shadow-sm">No</button> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 d-flex justify-content-end position-fixed">
                    <button type="button" class="btn btn-outline-primary btn-floating btn-lg shadow-sm" id="btn-back-to-top">
                    <i class="fas fa-angle-up"></i></button>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $('#submitForm').on('submit',function(e){
            $(this).find(':button[type=submit]').prop('disabled', true);
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