@extends("master")
@section('title_area')
    :: Admin  :: citizen charter
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
               <h2>Citizen charter</h2>
                <button onclick="AddNew()"  class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-plus"></i> Add New </button>
            </header>
            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table class="table table-striped table-bordered" id="citizen_charter_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Service</th>
                                    <th> Service Process</th>
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

    <div id="ServicepModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <div class="row">
                  <div class="col-md-4">  <h5 class="modal-title" id="myModalLabel"> Citizen charter </h5></div>
                    <div class="col-md-8">  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
                  </div>
                
                </div>
                <form class="form-validation" enctype="multipart/form-data" id="union_setup_form"
                      action="javascript:void(0)">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="name" class="col-md-3 form-control-label modalLabelText"> Service <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="name" class="form-control form-control-alt" name="services" id="services"
                                       placeholder="Service" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-3 form-control-label modalLabelText"> Service Process <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="name" class="form-control form-control-alt" name="services_process" id="services_process"
                                       placeholder="Service Process">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-3 form-control-label modalLabelText"> Service Price <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="name" class="form-control form-control-alt" name="services_price" id="services_price"
                                       placeholder="Service Price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-3 form-control-label modalLabelText"> Service Time <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="name" class="form-control form-control-alt" name="services_time" id="services_time"
                                       placeholder="Service Time">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-3 form-control-label modalLabelText"> Type <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select class="form-control form-control-alt" id="type" name="type" required>
                                    <option value=""> Select</option>
                                    @foreach($all_type_info as $item)
                                    <option value="{{ $item->id}}"> {{$item->title}}</option>
                                    @endforeach
                                   
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-3 form-control-label modalLabelText"> Status <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select class="form-control form-control-alt" id="is_active" name="is_active" required>
                                    <option value=""> Select</option>
                                    <option value="1"> Active </option>
                                    <option value="2"> Inactive </option>
                                   
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                    <input type="hidden" id="citizen_charter_id" name="citizen_charter_id">
                    <button type="submit" onclick="ServiceUpdate()" id="union_setup_update_button" style="display: none;"
                                class="btn btn-info btn-sm waves-effect waves-light"> <i class="glyphicon glyphicon-send"></i> <span id="SubmitbtnText"> Submit </span>
                        </button>
                        <button type="submit" onclick="ServiceSave()" id="union_setup_save_button"
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
    let unionSetupTable = $("#citizen_charter_table").DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax:"{{route('pourosova_related.citizen_charter')}}",
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data: 'services',name:'services'},
            {data: 'services_process',name:'services_process'},
            {data: 'is_active',name:'is_active'},
            {data: 'action',name:'action'},
        ]
    });
});

function AddNew()
{

var services          =  $('#services').val('');
   var services_process  =  $('#services_process').val('');
   var services_price    =  $('#services_price').val('');
   var services_time     =  $('#services_time').val('');
   var type              =  $('#type').val('');
   var is_active         =  $('#is_active').val('');
   var citizen_charter_id = $('#citizen_charter_id').val('');
$("#ServicepModal").modal('toggle');
document.getElementById("SubmitbtnText").innerHTML = "Submit";
}

//  Service save
function ServiceSave(){
   
var services          =  $('#services').val();
var services_process  =  $('#services_process').val();
var services_price    =  $('#services_price').val();
var services_time     =  $('#services_time').val();
var type              =  $('#type').val();
var is_active         =  $('#is_active').val();
var citizen_charter_id = $('#citizen_charter_id').val();

$.ajax({
        url:"{{route('pourosova_related.citizen_charter_store')}}",
        type:"POST",
        data:{
            services: services,
            services_process: services_process,
            services_price: services_price,
            services_time: services_time,
            type: type,
            is_active: is_active,
            citizen_charter_id:citizen_charter_id,
        },
        success:function(responseText){
            
            if(responseText.status == 'success'){
                    swal("Success", responseText.msg, "success");
                    $("#citizen_charter_table").DataTable().draw(true);
                    $("#ServicepModal").modal('toggle');


                }else{
                    swal("Something went wrong", responseText.msg, "error");
                }
        }
    });
}

// all type title delete 
$(document).on("click",".citizenCharterDelete",function(){
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
                        url:"{{route('pourosova_related.citizen_charter_destroy')}}",
                        type:"POST",
                        data:{
                            id: id
                        },
                        success:function(responseText){

                            if(responseText.status == 'success'){
                                swal("Success", responseText.msg, "success");
                                $("#citizen_charter_table").DataTable().draw(true);
                            }
                            else{
                                swal("Sorry", responseText.msg, "error");
                            }
                        }
                    });
                    } else {
                        
                        swal("citizen charter information is safe!");
                    }

        });

});

$(document).on("click",".citizenCharterEdit",function(){
    let id = $(this).data('id');

    $.ajax({
        url:"{{route('pourosova_related.citizen_charter_edit')}}",
        type:"POST",
        data:{
            id: id
        },
        success:function(responseText){
            if(responseText.status == 'success'){
                let data = responseText.data[0];
                var services          =  $('#services').val(data.services);
                var services_process  =  $('#services_process').val(data.services_process);
                var services_price    =  $('#services_price').val(data.services_price);
                var services_time     =  $('#services_time').val(data.services_time);
                var type              =  $('#type').val(data.type);
                var is_active         =  $('#is_active').val(data.is_active);
                var citizen_charter_id = $('#citizen_charter_id').val(data.id);

                $('#union_setup_update_button').show();
                $('#union_setup_save_button').hide();
                document.getElementById("SubmitbtnText").innerHTML = "Update";

                $("#ServicepModal").modal('toggle');
            }
            else{
                swal("Sorry", responseText.msg, "error");
            }
        }
    })
});

//  Service update
function ServiceUpdate(){
   
   var services          =  $('#services').val();
   var services_process  =  $('#services_process').val();
   var services_price    =  $('#services_price').val();
   var services_time     =  $('#services_time').val();
   var type              =  $('#type').val();
   var is_active         =  $('#is_active').val();
   var citizen_charter_id = $('#citizen_charter_id').val();
   
   $.ajax({
           url:"{{route('pourosova_related.citizen_charter_update')}}",
           type:"POST",
           data:{
               services: services,
               services_process: services_process,
               services_price: services_price,
               services_time: services_time,
               type: type,
               is_active: is_active,
               citizen_charter_id:citizen_charter_id,
           },
           success:function(responseText){
               
               if(responseText.status == 'success'){
                       swal("Success", responseText.msg, "success");
                       $("#citizen_charter_table").DataTable().draw(true);
                       $("#ServicepModal").modal('toggle');
   
   
                   }else{
                       swal("Something went wrong", responseText.msg, "error");
                   }
           }
       });
   }
</script>

@endsection