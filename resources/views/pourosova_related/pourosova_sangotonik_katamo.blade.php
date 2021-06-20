@extends("master")
@section('title_area')
    :: Admin  :: sangotonik katamo
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
               <h2> sangotonik katamo</h2>
                <button onclick="AddNew()"  class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-plus"></i> Add New </button>
            </header>
            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table class="table table-striped table-bordered" id="structure_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Structure Name </th>
                                    <th> Type </th>
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

    <div id="sangotonikKatamoeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <div class="row">
                  <div class="col-md-6">  <h5 class="modal-title" id="myModalLabel">  sangotonik katamo </h5></div>
                    <div class="col-md-6">  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
                  </div>
                
                </div>
                <form class="form-validation" enctype="multipart/form-data" id="union_setup_form"
                      action="javascript:void(0)">
                    <div class="modal-body">

                         <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Structure  <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <select class="form-control form-control-alt" id="parent_id" name="parent_id" required>
                                    <option value=""> Select</option>
                                    @foreach($get_structure as $item)
                                    <option value="{{ $item->id}}"> {{ $item->structure_name}}  </option>

                                    @endforeach
                                   
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Structure Name <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input class="form-control form-control-alt" id="structure_name" name="structure_name" required>
                                   
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Type <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <select class="form-control form-control-alt" id="type" name="type" required>
                                    <option value=""> Select</option>
                                    <option value="1"> উপজেলা সাংগঠনিক </option>
                                    <option value="2"> পৌরসভা  </option>
                                   
                                </select>
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
                    <input type="hidden" id="structure_id" name="structure_id">

                        <button type="submit" onclick="sangotonikKatamoUpdate()" id="union_setup_update_button" style="display: none;"
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
  $(document).ready(function(){
    let unionSetupTable = $("#structure_table").DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax:"{{route('pourosova_related.sangotonik_katamo')}}",
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data: 'structure_name',name:'structure_name'},
            {data: 'type',name:'type'},
            {data: 'is_active',name:'is_active'},
            {data: 'action',name:'action'},
        ]
    });
});

    
function AddNew()
{
    var parent_id        =  $('#parent_id').val('');
    var structure_name   =  $('#structure_name').val('');
    var type             =  $('#type').val('');
    var is_active        =  $('#is_active').val('');
    var structure_id     = $('#structure_id').val('');

    $("#sangotonikKatamoeModal").modal('toggle');

    document.getElementById("SubmitbtnText").innerHTML = "Submit";
}

// Sangotoni Katamo save
function UpIntroduceSave(){

var parent_id       =  $('#parent_id').val();
var structure_name  =  $('#structure_name').val();
var type            =  $('#type').val();
var is_active       =  $('#is_active').val();

$.ajax({
        url:"{{route('pourosova_related.sangotonik_katamo_store')}}",
        type:"POST",
        data:{
            parent_id: parent_id,
            structure_name: structure_name,
            type: type,
            is_active: is_active,
        },
        success:function(responseText){
            
                if(responseText.status == 'success'){
                    swal("Success", responseText.msg, "success");
                    $("#structure_table").DataTable().draw(true);
                    $("#sangotonikKatamoeModal").modal('toggle');

                    window.location.reload();


                }else{
                    swal("Something went wrong", responseText.msg, "error");
                }
        }
    });
}


$(document).on("click",".sangotonikKatamoEdit",function(){
    let id = $(this).data('id');

    $.ajax({
        url:"{{route('pourosova_related.sangotonik_katamo_edit')}}",
        type:"POST",
        data:{
            id: id
        },
        success:function(responseText){


            if(responseText.status == 'success'){
                let data = responseText.data;
                
                console.log(data.parent_id);

                var parent_id         =  $('#parent_id').val(data.parent_id);
                var structure_name    =  $('#structure_name').val(data.structure_name);
                var type              =  $('#type').val(data.type);
                var is_active         =  $('#is_active').val(data.is_active);
                var structure_id      = $('#structure_id').val(data.id);

                $('#union_setup_update_button').show();
                $('#union_setup_save_button').hide();
                document.getElementById("SubmitbtnText").innerHTML = "Update";

                $("#sangotonikKatamoeModal").modal('toggle');
            }
            else{
                swal("Sorry", responseText.msg, "error");
            }
        }
    })
});


// sangotonik-katamo update 
function sangotonikKatamoUpdate(){

var parent_id       =  $('#parent_id').val();
var structure_name  =  $('#structure_name').val();
var is_active       =  $('#is_active').val();
var type            =  $('#type').val();
var structure_id    = $('#structure_id').val();

$.ajax({
        url:"{{route('pourosova_related.sangotonik_katamo_update')}}",
        type:"POST",
        data:{
            parent_id: parent_id,
            structure_name: structure_name,
            is_active: is_active,
            type: type,
            structure_id:structure_id,
        },
        success:function(responseText){
            
                if(responseText.status == 'success'){
                    swal("Success", responseText.msg, "success");
                    $("#structure_table").DataTable().draw(true);
                    $("#sangotonikKatamoeModal").modal('toggle');

                }else{

                    swal("Something went wrong", responseText.msg, "error");
                }
        }
    });
}

// upazila parisadKajjaboliDelete  
$(document).on("click",".sangotonikKatamoDelete",function(){
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
                        url:"{{route('pourosova_related.sangotonik_katamo_delete')}}",
                        type:"POST",
                        data:{
                            id: id
                        },
                        success:function(responseText){

                            if(responseText.status == 'success'){
                                swal("Success", responseText.msg, "success");
                                $("#structure_table").DataTable().draw(true);
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
