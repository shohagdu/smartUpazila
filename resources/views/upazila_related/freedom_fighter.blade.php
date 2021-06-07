@extends("master")
@section('title_area')
    :: Admin  :: Upazila Freedom Fighter
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
               <h2> Upazila Freedom Fighter </h2>
                <button onclick="AddNew()"  class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-plus"></i> Add New </button>
            </header>
            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table class="table table-striped table-bordered" id="freedom_fighter_table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Name </th>
                                    <th> Father Name</th>
                                    <th> Village </th>
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

    <div id="freedomFighterModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <div class="row">
                  <div class="col-md-4">  <h5 class="modal-title" id="myModalLabel"> Freedom Fighter </h5></div>
                    <div class="col-md-8">  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
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
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Father Name <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control form-control-alt" name="father_name" id="father_name"
                                       placeholder="Father Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Village <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control form-control-alt" name="village" id="village"
                                       placeholder="Village">
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
                    <input type="hidden" id="freedom_fighter_id" name="freedom_fighter_id">

                        <button type="submit" onclick="UpFreedomFighterUpdate()" id="union_setup_update_button" style="display: none;"
                                class="btn btn-info btn-sm waves-effect waves-light"> <i class="glyphicon glyphicon-send"></i> <span id="SubmitbtnText"> Submit </span>
                        </button>
                        <button type="submit" onclick="UpFreedomFighterUpdateSave()" id="union_setup_save_button"
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
    let unionSetupTable = $("#freedom_fighter_table").DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax:"{{route('upazila_related.freedom_fighter')}}",
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data: 'name',name:'name'},
            {data: 'father_name',name:'father_name'},
            {data: 'village',name:'village'},
            {data: 'is_active',name:'is_active'},
            {data: 'action',name:'action'},
        ]
    });
});

function AddNew()
{
    var name              =  $('#name').val('');
    var father_name       =  $('#father_name').val('');
    var village           =  $('#village').val('');
    var is_active         =  $('#is_active').val('');
    var freedom_fighter_id= $('#freedom_fighter_id').val('');

    $("#freedomFighterModal").modal('toggle');

    document.getElementById("SubmitbtnText").innerHTML = "Submit";
}

//  Freedom FighterUpdate  save
function UpFreedomFighterUpdateSave(){

var name          =  $('#name').val();
var father_name   =  $('#father_name').val();
var village       =  $('#village').val();
var is_active     =  $('#is_active').val();

if( name != '' && father_name != '' ){

    $.ajax({
            url:"{{route('freedom_fighter.store')}}",
            type:"POST",
            data:{
                name: name,
                father_name: father_name,
                village: village,
                is_active: is_active,
            },
            success:function(responseText){
                
                    if(responseText.status == 'success'){
                        swal("Success", responseText.msg, "success");
                        $("#freedom_fighter_table").DataTable().draw(true);
                        $("#freedomFighterModal").modal('toggle');

                    }else{
                        swal("Something went wrong", responseText.msg, "error");
                    }
            }
        });

    }else{

        swal("Something went wrong", "Fill in all the information", "error");
    }
}


$(document).on("click",".upFreedomFighterEdit",function(){
    let id = $(this).data('id');

    $.ajax({
        url:"{{route('freedom_fighter.edit')}}",
        type:"POST",
        data:{
            id: id
        },
        success:function(responseText){


            if(responseText.status == 'success'){
                let data = responseText.data[0];
                //console.log(data);

                var name        =  $('#name').val(data.name);
                var father_name =  $('#father_name').val(data.father_name);
                var village     =  $('#village').val(data.village);
                var is_active   =  $('#is_active').val(data.is_active);

                var freedom_fighter_id =  $('#freedom_fighter_id').val(data.id);

                $('#union_setup_update_button').show();
                $('#union_setup_save_button').hide();
                document.getElementById("SubmitbtnText").innerHTML = "Update";

                $("#freedomFighterModal").modal('toggle');
            }
            else{
                swal("Sorry", responseText.msg, "error");
            }
        }
    })
});


// Peprestative update
function UpFreedomFighterUpdate (){

var name          =  $('#name').val();
var father_name   =  $('#father_name').val();
var village       =  $('#village').val();
var is_active     =  $('#is_active').val();

var freedom_fighter_id  = $('#freedom_fighter_id').val();

$.ajax({
        url:"{{route('freedom_fighter.update')}}",
        type:"POST",
        data:{
                name: name,
                father_name: father_name,
                village: village,
                is_active: is_active,
                freedom_fighter_id:freedom_fighter_id,
        },
        success:function(responseText){

            
                if(responseText.status == 'success'){
                    swal("Success", responseText.msg, "success");
                    $("#freedom_fighter_table").DataTable().draw(true);
                    $("#freedomFighterModal").modal('toggle');


                }else{
                    swal("Something went wrong", responseText.msg, "error");
                }
        }
    });
}

// upazila Introduction delete 
$(document).on("click",".upFreedomFighterDelete",function(){
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
                        url:"{{route('freedom_fighter.delete')}}",
                        type:"POST",
                        data:{
                            id: id
                        },
                        success:function(responseText){

                            if(responseText.status == 'success'){
                                swal("Success", responseText.msg, "success");
                                $("#freedom_fighter_table").DataTable().draw(true);
                            }
                            else{
                                swal("Sorry", responseText.msg, "error");
                            }
                        }
                    });
                    } else {
                        
                        swal("Freedom fighter Introduction is safe!");
                    }

        });

});


</script>

@endsection
