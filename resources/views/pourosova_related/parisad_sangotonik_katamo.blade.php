@extends("master")
@section('title_area')
    :: Admin  :: Parisad sangotonik katamo
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
               <h2>Parisad sangotonik katamo</h2>
                <button onclick="AddNew()"  class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-plus"></i> Add New </button>
            </header>
            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table class="table table-striped table-bordered" id="parisad_kajjaboli_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Structure Name</th>
                                    <th> Sub Structure</th>
                                    <th> Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                       </table>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <div id="UpIntroduceModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <div class="row">
                  <div class="col-md-6">  <h5 class="modal-title" id="myModalLabel"> Parisad sangotonik katamo </h5></div>
                    <div class="col-md-6">  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
                  </div>
                
                </div>
                <form class="form-validation" enctype="multipart/form-data" id="union_setup_form"
                      action="javascript:void(0)">
                    <div class="modal-body">

                         <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Structure Name <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <select class="form-control form-control-alt" id="structure" name="structure" required>
                                    <option value=""> Select</option>
                                    <option value="1"> মেয়র  </option>
                                   
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText">Sub  Structure  <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input class="form-control form-control-alt" id="sub_structure " name="sub_structure" required>
                                   
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
                    <input type="hidden" id="kajjaboli_id" name="kajjaboli_id">

                        <button type="submit" onclick="UpIntroduceUpdate()" id="union_setup_update_button" style="display: none;"
                                class="btn btn-info btn-sm waves-effect waves-light"> <i class="glyphicon glyphicon-send"></i> <span id="SubmitbtnText"> Submit </span>
                        </button>
                        <button type="submit" onclick="UpIntroduceSave()" id="union_setup_save_button"
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
    
function AddNew()
{
    var office        =  $('#office').val('');
    var message       =  $('#message').val('');
    var display_position  =  $('#display_position').val('');
    var is_active         =  $('#is_active').val('');
    var kajjaboli_id      = $('#kajjaboli_id').val('');

    $("#UpIntroduceModal").modal('toggle');

    document.getElementById("SubmitbtnText").innerHTML = "Submit";
}

// union info save
function UpIntroduceSave(){

var office       =  $('#office').val();
var message      =  $('#message').val();
var display_position =  $('#display_position').val();
var is_active        =  $('#is_active').val();

$.ajax({
        url:"{{route('upazila_parishad.parisad_kajjoboli_store')}}",
        type:"POST",
        data:{
            office: office,
            message: message,
            display_position: display_position,
            is_active: is_active,
        },
        success:function(responseText){
            
                if(responseText.status == 'success'){
                    swal("Success", responseText.msg, "success");
                    $("#parisad_kajjaboli_table").DataTable().draw(true);
                    $("#UpIntroduceModal").modal('toggle');


                }else{
                    swal("Something went wrong", responseText.msg, "error");
                }
        }
    });
}


$(document).on("click",".parsadKajjaboliEdit",function(){
    let id = $(this).data('id');

    $.ajax({
        url:"{{route('upazila_parishad.parisad_kajjoboli_edit')}}",
        type:"POST",
        data:{
            id: id
        },
        success:function(responseText){


            if(responseText.status == 'success'){
                let data = responseText.data[0];
                //console.log(data);
                var office            =  $('#office').val(data.office);
                var message           =  $('#message').val(data.message);
                var display_position  =  $('#display_position').val(data.display_position);
                var is_active         =  $('#is_active').val(data.is_active);
                var kajjaboli_id      = $('#kajjaboli_id').val(data.id);

                $('#union_setup_update_button').show();
                $('#union_setup_save_button').hide();
                document.getElementById("SubmitbtnText").innerHTML = "Update";

                $("#UpIntroduceModal").modal('toggle');
            }
            else{
                swal("Sorry", responseText.msg, "error");
            }
        }
    })
});


// parisad_kajjoboli_update 
function UpIntroduceUpdate(){

var office           =  $('#office').val();
var message          =  $('#message').val();
var display_position =  $('#display_position').val();
var is_active        =  $('#is_active').val();
var kajjaboli_id     = $('#kajjaboli_id').val();

$.ajax({
        url:"{{route('upazila_parishad.parisad_kajjoboli_update')}}",
        type:"POST",
        data:{
            office: office,
            message: message,
            display_position: display_position,
            is_active: is_active,
            kajjaboli_id:kajjaboli_id,
        },
        success:function(responseText){
            
                if(responseText.status == 'success'){
                    swal("Success", responseText.msg, "success");
                    $("#parisad_kajjaboli_table").DataTable().draw(true);
                    $("#UpIntroduceModal").modal('toggle');

                }else{

                    swal("Something went wrong", responseText.msg, "error");
                }
        }
    });
}

// upazila parisadKajjaboliDelete  
$(document).on("click",".parisadKajjaboliDelete",function(){
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
                        url:"{{route('upazila_parishad.parisad_kajjoboli_destroy')}}",
                        type:"POST",
                        data:{
                            id: id
                        },
                        success:function(responseText){

                            if(responseText.status == 'success'){
                                swal("Success", responseText.msg, "success");
                                $("#parisad_kajjaboli_table").DataTable().draw(true);
                            }
                            else{
                                swal("Sorry", responseText.msg, "error");
                            }
                        }
                    });
                    } else {
                        
                        swal("Information is safe!");
                    }

        });

});


</script>

@endsection
