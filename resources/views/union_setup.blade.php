@extends("master")
@section('title_area')
    :: Admin  :: Union  Setup
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
               <h2>Union Setup </h2>
                <button onclick="AddNew()"  class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-plus"></i> Add New </button>
            </header>
            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table class="table table-striped table-bordered" id="union_setup_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Upazila</th>
                                    <th> Union Name</th>
                                    <th> Union Code</th>
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

    <div id="unionSetupModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <div class="row">
                  <div class="col-md-4">  <h5 class="modal-title" id="myModalLabel"> Union Setup </h5></div>
                    <div class="col-md-8">  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
                  </div>
                
                </div>
                <form class="form-validation" enctype="multipart/form-data" id="union_setup_form"
                      action="javascript:void(0)">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Upazila Name <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <select class="form-control form-control-alt" id="upazila_id" name="upazila_id" required>
                                    <option value=""> Select</option>
                                    @foreach($upazila as $item)
                                    <option value="{{ $item->id}}"> {{$item->name}}</option>
                                    @endforeach
                                   
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText">Union Name <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="name" class="form-control form-control-alt" name="union_name" id="union_name"
                                       placeholder="Union Name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText">Union Code <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="name" class="form-control form-control-alt" name="union_code" id="union_code"
                                       placeholder="Union Code">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 form-control-label modalLabelText"> Web url <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input type="name" class="form-control form-control-alt" name="web_url" id="web_url"
                                       placeholder="www.exampleup.com">
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
                    <input type="hidden" id="union_info_id" name="union_info_id">
                        <button type="submit" onclick="unionSetupSave()" id="union_setup_save_button"
                                class="btn btn-primary btn-xs waves-effect waves-light"> <i class="glyphicon glyphicon-send"></i> <span id="SubmitbtnText"> Submit </span>
                        </button>
                        <button  type="button" class="btn btn-danger btn-xs waves-effect"
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
    let unionSetupTable = $("#union_setup_table").DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax:"{{route('union_setup.unionSetup')}}",
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data: 'upazila_id',name:'upazila_id'},
            {data: 'union_name',name:'union_name'},
            {data: 'union_code',name:'union_code'},
            {data: 'is_active',name:'is_active'},
            {data: 'action',name:'action'},
        ]
    });
});

function AddNew()
{
$("#unionSetupModal").modal('toggle');
document.getElementById("SubmitbtnText").innerHTML = "Submit";
}

// union info save
function unionSetupSave(){
   
var upazila_id =  $('#upazila_id').val();
var union_name =  $('#union_name').val();
var union_code =  $('#union_code').val();
var web_url    =  $('#web_url').val();
var is_active  =  $('#is_active').val();
var union_info_id = $('#union_info_id').val();

$.ajax({
        url:"{{route('union_setup.store')}}",
        type:"POST",
        data:{
            upazila_id: upazila_id,
            union_name: union_name,
            union_code: union_code,
            web_url: web_url,
            is_active: is_active,
            union_info_id:union_info_id,
        },
        success:function(responseText){
            
            if(responseText.status == 'success'){
                    swal("Success", responseText.msg, "success");
                    $("#union_setup_table").DataTable().draw(true);
                    $("#unionSetupModal").modal('toggle');


                }else{
                    swal("Something went wrong", responseText.msg, "error");
                }
        }
    });
}

// union info delete 
$(document).on("click",".UnionSetupDelete",function(){
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
                        url:"{{route('union_setup.delete')}}",
                        type:"POST",
                        data:{
                            id: id
                        },
                        success:function(responseText){

                            if(responseText.status == 'success'){
                                swal("Success", responseText.msg, "success");
                                $("#union_setup_table").DataTable().draw(true);
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

$(document).on("click",".UnionSetupEdit",function(){
    let id = $(this).data('id');

    $.ajax({
        url:"{{route('union_setup.edit')}}",
        type:"POST",
        data:{
            id: id
        },
        success:function(responseText){
            if(responseText.status == 'success'){
                let data = responseText.data;
                var union_info_id =  $('#union_info_id').val(data.id);
                var upazila_id    =  $('#upazila_id').val(data.upazila_id);
                var union_name    =  $('#union_name').val(data.union_name);
                var union_code    =  $('#union_code').val(data.union_code);
                var web_url       =  $('#web_url').val(data.web_url);
                var is_active     =  $('#is_active').val(data.is_active);

                document.getElementById("SubmitbtnText").innerHTML = "Update";

                $("#unionSetupModal").modal('toggle');
            }
            else{
                swal("দুঃখিত", responseText.msg, "error");
            }
        }
    })
});
</script>

@endsection