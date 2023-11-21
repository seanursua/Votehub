@extends('layout.master')

@section('positions','active')

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
    <link rel="stylesheet" href="css/org/positions-style.css"/>
@stop

@section('title', 'Positions')

@section('contents')
<div class="container-fluid py-4 w-75">
    <div class="row">
        <div class="row-lg-12 text-dark justify-content-between" id="headerBar">
            <div class="col-lg-12 mb-3">
                <div class="d-flex align-items-center">
                    <h3 class="col-auto fs-4 m-0 text-dark flex-grow-1">Running Positions</h3>
                    @if($checker == true)
                        @if(count($date) < 1)
                            <button type="submit" 
                            class="btn btn-primary rounded-pill btn-sm shadow-sm border-0" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalManual">
                            <i class="fas fa-plus"></i> Add Position</button>
                        @endif
                    @endif
                        <div class="modal fade" id="modalManual">
                            <div class="modal-dialog">
                                <div class="modal-dialog">
                                    <form id="addPosition">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Add Position</h5>
                                                <button type="button" class="btn-close shadow-sm fs-6" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="mb-3">
                                                        <button type="submit" 
                                                        class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#modalRep">
                                                        Representative Position</button>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label required text-dark fs-6">Position Name</label>
                                                        <span class="text-danger fs-6" id="positionErrorMsg"></span>
                                                        <input type="text" id="position" name="position" class="form-control" list="listposition" pattern="[A-Za-z0-9,.'\s]+" oninvalid="InvalidMsgLetterNumber(this);" oninput="InvalidMsgLetterNumber(this);" required>
                                                        <datalist id="listposition">
                                                            <option value="President">
                                                            <option value="Vice President">
                                                            <option value="Secretary">
                                                            <option value="Public Relation Officer">
                                                            <option value="Business Manager">
                                                            <option value="Sergeant at Arms">
                                                            <option value="Muse">
                                                            <option value="Escort">
                                                        </datalist>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="form-label required text-dark fs-6">Voting Weight</label>
                                                        <span class="text-danger fs-6" id="maxWeightErrorMsg"></span>
                                                            <div class="col-md-6"> 
                                                                <input type="number" min="1" name="maxWeight" id="maxWeight" placeholder="Maximum" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "2" class="form-control" required>
                                                            </div>
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
                        <div class="modal fade" id="modalRep">
                            <div class="modal-dialog">
                                <div class="modal-dialog">
                                    <!-- Add another form -->
                                    <form id="addRepresentative">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Representative Position</h5>
                                                <button type="button" class="btn-close shadow-sm fs-6" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <button type="submit" 
                                                    class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#modalManual">
                                                    Regular Position</button>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label required text-dark fs-6">Representative Name</label>
                                                    <a href="#" class="fs-6 text-secondary decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" title="*Do not include the representative word at the end of the name.">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                    <div>
                                                        <span class="text-danger fs-6" id="representativeErrorMsg"></span>
                                                    </div>
                                                    <input type="text" id="representative" name="representative" class="form-control" 
                                                    data-toggle="tooltip" data-bs-placement="right" 
                                                    pattern="[A-Za-z0-9,.'\s]+" oninvalid="InvalidMsgLetterNumber(this);" oninput="InvalidMsgLetterNumber(this);" 
                                                    title="*Do not include the representative word at the end of the name." 
                                                    required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label required text-dark fs-6">Voting Weight</label>
                                                    <a href="#" class="fs-6 text-secondary decoration-none" data-bs-toggle="tooltip" data-bs-placement="bottom" title="*Representative positions only generates one winner.">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                    <div class="col-md-6"> 
                                                        <input type="text" value="1" type="number" name="max" id="max" placeholder="Maximum" disabled>
                                                    </div>
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
                                    <th class="py-1 px-2" scope="col">Position</th>
                                    <th class="py-1 px-2" scope="col">Voting Weight</th>
                                    <th class="py-1 px-2" scope="col">Total Candidates</th>
                                    <th class="py-1 px-2" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="row_position">

                            @if($checker == true)
                            @foreach($positions as $position)
                                <tr>         
                                    <td class="py-1 px-2">{{ $position->position ?? '' }}</td>
                                    <td class="py-1 px-2">{{ $position->maxWeight ?? '' }}</td>
                                    <td class="py-1 px-2">{{ $position->Total ?? '' }}</td>  
                                    <td class="py-1 px-2" width=25>
                                    @if(count($date) < 1)
                                        <button type="button" id="btnDelete" class="btnDel btn-danger text-white btn-sm rounded-3 border-0 shadow-sm mb-1"
                                        data-bs-toggle="modal" data-bs-target="#modalDelete" data-role="delete" data-userid="{{$position->position}}">
                                        <i class="fas fa-trash-alt fs-6"></i></button>
                                    @endif
                                        <div class="modal fade" id="modalDelete">
                                            <div class="modal-dialog">
                                                <form id="deletePositionForm">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title">Delete Position</h5>
                                                            <button type="button" class="btn-close shadow-sm fs-6" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <p>
                                                                    <span class="fw-bold text-danger">Warning: </span>Are you sure you want to delete this Position?
                                                                    <br>
                                                                    <span id="positionDisplay" style="font-weight:bolder; font-size:25px"></span>
                                                                </p>
                                                                <input type="hidden" id="positionName" name="positionName">
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
    $('#addPosition').on('submit',function(e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type:"POST",
            url: "/createPosition",
            data:formData,
            contentType: false,
            processData: false,
            success:function(response){
                location.reload();
            },
            error: function(response) {
                $('#positionErrorMsg').text(response.responseJSON.errors.position);
                $('#maxWeightErrorMsg').text(response.responseJSON.errors.maxWeight);
            },
        });
    });
</script>
<script type="text/javascript">
    $('#addRepresentative').on('submit',function(e){
        e.preventDefault();
        var representative = $('#representative').val() + ' Representative';        
        $.ajax({
            url: "/createRepresentative",
            type:"POST",
            data:{"_token": "{{ csrf_token() }}",
                    representative:representative,},
            success:function(response){
                location.reload();
            },
            error: function(response) {
                $('#representativeErrorMsg').text(response.responseJSON.errors.representative);
            },
        });
    });
</script>
<script>
    $(document).on('click','.btnDel',function(){
        var userID=$(this).attr('data-userid');
        $('#positionName').val(userID); 
        $('#positionDisplay').text(userID); 
    });
</script>
<script type="text/javascript"> 
    $('#deletePositionForm').on('submit',function(e){
        e.preventDefault();
        let formData = new FormData(this); 
        $.ajax({
            type:"POST",
            url: "{{ route('delete.position') }}",
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