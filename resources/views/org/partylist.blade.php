@extends('layout.master')

@section('HeaderScripts')
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <link href="css-icons/css/all.css" rel="stylesheet">
    <link rel="icon" href="img/votehub-icon.png">
    <link rel="stylesheet" href="css/org/partylist-style.css"/>  
@stop

@section('partylist', 'active')

@section('title', 'Party List')

@section('contents')
<div class="container-fluid py-4 w-75">
    <div class="row">
        <div class="row-lg-12 text-dark justify-content-between" id="headerBar">
            <div class="col-lg-12 mb-3">
                <div class="d-flex align-items-center">
                    <h3 class="col-auto fs-4 m-0 text-dark flex-grow-1">List of Party</h3>
                    @if($checker == true)
                        @if(count($date) < 1)
                            <button type="submit" 
                            class="btn btn-primary rounded-pill btn-sm shadow-sm border-0" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalManual">
                            <i class="fas fa-plus"></i> Add Party</button>
                        @endif
                    @endif
                    <div class="modal fade" id="modalManual">
                        <div class="modal-dialog">
                            <div class="modal-dialog">
                                <form id="addParty">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Add a Party</h5>
                                            <button type="button" class="btn-close shadow-sm fs-6" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label required fs-6 text-dark">Name of Party</label>
                                                    <span class="text-danger fs-6" id="partyNameErrorMsg"></span>
                                                    <input type="text" class="form-control" id="partyName" name="partyName" pattern="[A-Za-z,.'\s]+" oninvalid="InvalidMsgLetterNumber(this);" oninput="InvalidMsgLetterNumber(this);"
                                                    required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label required fs-6 text-dark">Abbreviation</label>
                                                    <span class="text-danger fs-6" id="abbreviateErrorMsg"></span>
                                                    <input type="text" class="form-control" id="abbreviate" name="abbreviate" pattern="[A-Za-z\s]+" oninvalid="InvalidMsgLetterNumber(this);" oninput="InvalidMsgLetterNumber(this);"
                                                    required>
                                                </div>
                                            </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button id="cancel" name="cancel" data-bs-dismiss="modal" class="btn btn-danger shadow-sm">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        <hr>
        </div>
        <div class="col">
            <div class="card">
                <div class="table-responsive">
                    <div class="card-body">
                        <table class="table bg-white table-hover" id="positionsTable">
                            <thead>
                                <tr>
                                    <th class="py-1 px-2" scope="col">Name of Party</th>
                                    <th class="py-1 px-2" scope="col">Abbreviation</th>
                                    <th class="py-1 px-2" scope="col">Total Candidates</th>
                                    <th class="py-1 px-2" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="row_position">  
                            @if($checker == true)  
                                @foreach($partylists as $partylist)                 
                                    <tr id="" >   
                                        <td class="py-1 px-2">{{ $partylist->partyName }}</td>
                                        <td class="index py-1 px-2">{{ $partylist->abbreviate }}</td>
                                        <td class="py-1 px-2">{{ $partylist->Total }}</td>
                                        <td class="py-1 px-2" width=25>
                                        @if(count($date) < 1)        
                                            <button type="button" id="btnDelete" class="btnDel btn-danger text-white btn-sm rounded-3 border-0 shadow-sm mb-1"
                                            data-bs-toggle="modal" data-bs-target="#modalDelete"  data-role="delete" data-id="{{ $partylist->id}}" data-name="{{ $partylist->partyName }}">
                                            <i class="fas fa-trash-alt fs-6"></i></button>
                                        @endif
                                            <div class="modal fade" id="modalDelete">
                                                <div class="modal-dialog">
                                                    <form id="deletePartyForm">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title">Delete Party</h5>
                                                                <button type="button" class="btn-close shadow-sm fs-6" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <p><span class="fw-bold text-danger">Warning: </span>Are you sure you want to delete this Party?
                                                                        <br>
                                                                        <span id="partyDisplay" style="font-weight:bolder; font-size:25px"></span>
                                                                    </p>
                                                                    <input type="hidden" id="partyID" name="partyID">
                                                                    <label class="form-label required fs-6">Enter your password to confirm</label>
                                                                    <span id="passwordErrorText" class="text-danger"></span> 
                                                                    <input type="Password" id="password" name="password" class="form-control" placeholder="Your password" required>
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
                            @endif   
                            </tbody>
                        </table>
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
    <script>
        $(document).ready(function(){
            $('#positionsTable').dataTable();
        });
    </script>
    <script>
    function InvalidMsgLetterNumber(textbox) {

        if(textbox.validity.patternMismatch){
            textbox.setCustomValidity('Letters and numbers only, no special characters.');
        }    
        else {
            textbox.setCustomValidity('');
        }
        return true;
    }
    </script>
    <script type="text/javascript">
        $('#addParty').on('submit',function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type:"POST",
                url: "/addParty",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response){
                    location.reload();
                },
                error: function(response) {
                    $('#partyNameErrorMsg').text(response.responseJSON.errors.partyName);
                    $('#abbreviateErrorMsg').text(response.responseJSON.errors.abbreviate);
                },
            });
        });
    </script>
    <script>
        $(document).on('click','.btnDel',function(){
            var partyID=$(this).attr('data-id');
            var partyName=$(this).attr('data-name');
            $('#partyID').val(partyID); 
            $('#partyDisplay').text(partyName); 
        });
    </script>
    <script type="text/javascript"> 
        $('#deletePartyForm').on('submit',function(e){
            e.preventDefault();
            let formData = new FormData(this); 
            $.ajax({
                type:"POST",
                url: "{{ route('delete.party') }}",
                data:formData,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.status===true){
                        location.reload();
                    }
                    if(response.status===false){  
                        $('#passwordErrorText').text(response.msg);
                        document.getElementById('password').value = ''                 
                    }
                },
                    error: function(response) { 
                },
            });
        });
    </script>
@stop
