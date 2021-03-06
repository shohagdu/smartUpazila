@extends("master")
@section('title_area')
    :: Admin  :: Upazila Peprestative
@endsection
@section('show_message')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
             style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </div>
    @endif
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css') }}/custom.css">
@endsection
@section('main_content_area')
    <article class="">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
               <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
               <h2> Upazila Peprestative </h2>
                <button onclick="AddNew()"  class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-plus"></i> Add New </button>
            </header>
            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table class="table table-striped table-bordered" id="up_Peprestative_table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Name </th>
                                    <th> Mobile</th>
                                    <th> Email </th>
                                    <th> Designation </th>
                                    <th> Address </th>
                                    <th> Status </th>
                                    <th> Action</th>
                                </tr>
                            </thead>
                       </table>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <div id="UpPeprestativeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <div class="row">
                  <div class="col-md-4">  <h5 class="modal-title" id="myModalLabel"> Upazila Peprestative </h5></div>
                    <div class="col-md-8">  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button></div>
                  </div>
                
                </div>
                <form class="form-validation" enctype="multipart/form-data" id="union_setup_form"
                      action="javascript:void(0)">
                    <div class="modal-body">

                       <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Name <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control form-control-alt" name="name" id="name" required
                                       placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Mobile <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control form-control-alt" name="mobile" id="mobile"
                                       placeholder="Mobile">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Email <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="email" class="form-control form-control-alt" name="email" id="email"
                                       placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Designation <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control form-control-alt" name="designation" id="designation"
                                       placeholder="Designation">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Address <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                            <textarea name="address" id="address" colspan="10" class="form-control"></textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Status <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <select class="form-control form-control-alt" id="is_active" name="is_active" required>
                                    <option value=""> Select</option>
                                    <option value="1"> Active </option>
                                    <option value="2"> Inactive </option>
                                   
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                    <input type="hidden" id="peprestative_id" name="peprestative_id">

                        <button type="submit" onclick="UpPeprestativeUpdate()" id="union_setup_update_button" style="display: none;"
                                class="btn btn-info btn-sm waves-effect waves-light"> <i class="glyphicon glyphicon-send"></i> <span id="SubmitbtnText"> Submit </span>
                        </button>
                        <button type="submit" onclick="UpPeprestativeSave()" id="union_setup_save_button"
                                class="btn btn-primary btn-sm waves-effect waves-light"> <i class="glyphicon glyphicon-send"></i> <span id="SubmitbtnText"> Submit </span>
                        </button>
                        <button  type="button" class="btn btn-danger btn-sm waves-effect"
                                data-dismiss="modal"> <i class="glyphicon glyphicon-remove"></i> Cancel 
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->
    
@endsection

@section('js')

<!-- <script src="{{ asset('js') }}/union_setup.js"></script> -->
<script>
    // datatable 
  $(document).ready(function(){
    let unionSetupTable = $("#up_Peprestative_table").DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax:"{{route('upazila_related.upPublicPeprestative')}}",
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data: 'name',name:'name'},
            {data: 'mobile',name:'mobile'},
            {data: 'email',name:'email'},
            {data: 'designation',name:'designation'},
            {data: 'address',name:'address'},
            {data: 'is_active',name:'is_active'},
            {data: 'action',name:'action'},
        ]
    });
});

function AddNew()
{
    var name              =  $('#name').val('');
    var mobile            =  $('#mobile').val('');
    var email             =  $('#email').val('');
    var designation       =  $('#designation').val('');
    var address           =  $('#address').val('');
    var is_active         =  $('#is_active').val('');
    var peprestative_id   = $('#peprestative_id').val('');

    $("#UpPeprestativeModal").modal('toggle');

    document.getElementById("SubmitbtnText").innerHTML = "Submit";
}

//  UpPeprestativeSave save
function UpPeprestativeSave(){

var name        =  $('#name').val();
var mobile      =  $('#mobile').val();
var email       =  $('#email').val();
var designation =  $('#designation').val();
var address     =  $('#address').val();
var is_active   =  $('#is_active').val();

if( name != '' && mobile > 0 ){

    $.ajax({
            url:"{{route('upPublicPeprestative.store')}}",
            type:"POST",
            data:{
                name: name,
                mobile: mobile,
                email: email,
                designation: designation,
                address: address,
                is_active: is_active,
            },
            success:function(responseText){
                
                    if(responseText.status == 'success'){
                        swal("Success", responseText.msg, "success");
                        $("#up_Peprestative_table").DataTable().draw(true);
                        $("#UpPeprestativeModal").modal('toggle');


                    }else{
                        swal("Something went wrong", responseText.msg, "error");
                    }
            }
        });

    }else{

        swal("Something went wrong", "Fill in all the information", "error");
    }
}


$(document).on("click",".upPeprestativeEdit",function(){
    let id = $(this).data('id');

    $.ajax({
        url:"{{route('upPublicPeprestative.edit')}}",
        type:"POST",
        data:{
            id: id
        },
        success:function(responseText){


            if(responseText.status == 'success'){
                let data = responseText.data[0];
                //console.log(data);

                var name        =  $('#name').val(data.name);
                var mobile      =  $('#mobile').val(data.mobile);
                var email       =  $('#email').val(data.email);
                var designation =  $('#designation').val(data.designation);
                var address     =  $('#address').val(data.address);
                var is_active   =  $('#is_active').val(data.is_active);

                var peprestative_id =  $('#peprestative_id').val(data.id);

                $('#union_setup_update_button').show();
                $('#union_setup_save_button').hide();
                document.getElementById("SubmitbtnText").innerHTML = "Update";

                $("#UpPeprestativeModal").modal('toggle');
            }
            else{
                swal("Sorry", responseText.msg, "error");
            }
        }
    })
});


// Peprestative update
function UpPeprestativeUpdate(){

var name        =  $('#name').val();
var mobile      =  $('#mobile').val();
var email       =  $('#email').val();
var designation =  $('#designation').val();
var address     =  $('#address').val();
var is_active   =  $('#is_active').val();
var peprestative_id  = $('#peprestative_id').val();

$.ajax({
        url:"{{route('upPublicPeprestative.update')}}",
        type:"POST",
        data:{
                name: name,
                mobile: mobile,
                email: email,
                designation: designation,
                address: address,
                is_active: is_active,
                peprestative_id:peprestative_id,
        },
        success:function(responseText){

            
                if(responseText.status == 'success'){
                    swal("Success", responseText.msg, "success");
                    $("#up_Peprestative_table").DataTable().draw(true);
                    $("#UpPeprestativeModal").modal('toggle');


                }else{
                    swal("Something went wrong", responseText.msg, "error");
                }
        }
    });
}

// upazila Introduction delete 
$(document).on("click",".upPeprestativeDelete",function(){
    let id = $(this).data('id');

    swal({
        title: "Are you sure?",
        text: "You want to Delete!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {

             if (willDelete) {
                   
                    $.ajax({
                        url:"{{route('upPublicPeprestative.delete')}}",
                        type:"POST",
                        data:{
                            id: id
                        },
                        success:function(responseText){

                            if(responseText.status == 'success'){
                                swal("Success", responseText.msg, "success");
                                $("#up_Peprestative_table").DataTable().draw(true);
                            }
                            else{
                                swal("Sorry", responseText.msg, "error");
                            }
                        }
                    });
                    } else {
                        
                        swal("Peprestative Introduction is safe!");
                    }

        });

});


</script>

@endsection
