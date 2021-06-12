@extends("master")
@section('title_area')
    :: Admin  :: All Type Title
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
               <h2>All Type Title </h2>
                <button onclick="AddNew()"  class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-plus"></i> Add New </button>
            </header>
            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table class="table table-striped table-bordered" id="all_type_title_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Title</th>
                                    <th> Display Position</th>
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

    <div id="allTypeTitlepModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <div class="row">
                  <div class="col-md-4">  <h5 class="modal-title" id="myModalLabel"> All Type Title </h5></div>
                    <div class="col-md-8">  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
                  </div>
                
                </div>
                <form class="form-validation" enctype="multipart/form-data" id="union_setup_form"
                      action="javascript:void(0)">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText">Title <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="name" class="form-control form-control-alt" name="title" id="title"
                                       placeholder="Title" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Display Position <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="name" class="form-control form-control-alt" name="display_position" id="display_position"
                                       placeholder="Display Position">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Type <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <select class="form-control form-control-alt" id="type" name="type" required>
                                    <option value=""> Select</option>
                                    <option value="1"> উপজেলা পরিচিতি  </option>
                                    <option value="2"> এক নজরে পৌরসভা </option>
                                    <option value="3"> সিটিজেন চার্টার </option>
                                    <option value="4"> আইন-শৃঙ্খলা বিষয়ক </option>
                                    <option value="5"> স্বাস্থ্য বিষয়ক</option>
                                    <option value="6"> কৃষি ও খাদ্য বিষয়ক</option> 
                                    <option value="7"> ভূমি বিষয়ক </option>
                                    <option value="8"> প্রকৌশল ও যোগাযোগ </option>
                                    <option value="9"> ভূমি বিষয়ক  </option>
                                    <option value="10">  প্রকৌশল ও যোগাযোগ  </option>
                                    <option value="11">  শিক্ষা প্রতিষ্ঠান  </option>
                                    <option value="12">  বেসরকারি প্রতিষ্ঠান  </option>
                                    <option value="13">  ধর্মীয় প্রতিষ্ঠান  </option>
                                   
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
                    <input type="hidden" id="all_type_title_id" name="all_type_title_id">
                        <button type="submit" onclick="allTypeTitleSave()" id="union_setup_save_button"
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
    let unionSetupTable = $("#all_type_title_table").DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax:"{{route('setup.all_type_title')}}",
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data: 'title',name:'title'},
            {data: 'display_position',name:'display_position'},
            {data: 'is_active',name:'is_active'},
            {data: 'action',name:'action'},
        ]
    });
});

function AddNew()
{

    var title             =  $('#title').val('');
    var display_position  =  $('#display_position').val('');
    var type             =  $('#type').val('');
    var is_active         =  $('#is_active').val('');
    var all_type_title_id = $('#all_type_title_id').val('');
    $("#allTypeTitlepModal").modal('toggle');
document.getElementById("SubmitbtnText").innerHTML = "Submit";
}

// all Type Title info save
function allTypeTitleSave(){
   
var title             =  $('#title').val();
var display_position  =  $('#display_position').val();
var type             =  $('#type').val();
var is_active         =  $('#is_active').val();
var all_type_title_id = $('#all_type_title_id').val();

$.ajax({
        url:"{{route('all_type_title.store')}}",
        type:"POST",
        data:{
            title: title,
            display_position: display_position,
            type: type,
            is_active: is_active,
            all_type_title_id:all_type_title_id,
        },
        success:function(responseText){
            
            if(responseText.status == 'success'){
                    swal("Success", responseText.msg, "success");
                    $("#all_type_title_table").DataTable().draw(true);
                    $("#allTypeTitlepModal").modal('toggle');


                }else{
                    swal("Something went wrong", responseText.msg, "error");
                }
        }
    });
}

// all type title delete 
$(document).on("click",".AllTypeTitleDelete",function(){
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
                        url:"{{route('all_type_title.delete')}}",
                        type:"POST",
                        data:{
                            id: id
                        },
                        success:function(responseText){

                            if(responseText.status == 'success'){
                                swal("Success", responseText.msg, "success");
                                $("#all_type_title_table").DataTable().draw(true);
                            }
                            else{
                                swal("Sorry", responseText.msg, "error");
                            }
                        }
                    });
                    } else {
                        
                        swal("Union Setup information is safe!");
                    }

        });

});

$(document).on("click",".AllTypeTitleEdit",function(){
    let id = $(this).data('id');

    $.ajax({
        url:"{{route('all_type_title.edit')}}",
        type:"POST",
        data:{
            id: id
        },
        success:function(responseText){
            if(responseText.status == 'success'){
                let data = responseText.data;
                var title             =  $('#title').val(data.title);
                var display_position  =  $('#display_position').val(data.display_position);
                var type              =  $('#type').val(data.type);
                var is_active         =  $('#is_active').val(data.is_active);
                var all_type_title_id = $('#all_type_title_id').val(data.id);


                document.getElementById("SubmitbtnText").innerHTML = "Update";

                $("#allTypeTitlepModal").modal('toggle');
            }
            else{
                swal("Sorry", responseText.msg, "error");
            }
        }
    })
});
</script>

@endsection