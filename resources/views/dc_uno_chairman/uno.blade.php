@extends("master")
@section('title_area')
    :: Admin  :: ইউএনও মহোদয়ের তথ্য
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
               <h2> ইউএনও মহোদয়ের তথ্য </h2>
                <button onclick="AddNew()"  class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-plus"></i> Add New </button>
            </header>
            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="row"><br>
                        <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <label>Division <span class="text-danger">*</span></label>
                                <select class="form-control form-control-alt" onchange="getDistrict(this.value, 'districtId')" id="divisionId" name="divisionId" required>
                                    <option value=""> Select</option>
                                    @foreach($division as $item )
                                    <option value="{{$item->id}}"> {{$item->bn_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>District </label>
                                <select class="form-control form-control-alt" onchange="getUpazila(this.value, 'upazilaId')" id="districtId" name="districtId" required>
                                    <option value=""> Select</option>
                                
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Upazila </label>
                                <select class="form-control form-control-alt" id="upazilaId" name="upazilaId" required>
                                    <option value=""> Select</option>
                                
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Status </label>
                                <select class="form-control form-control-alt" id="isActive" name="isActive" required>
                                    <option value=""> Select</option>
                                    <option value="1"> Active </option>
                                    <option value="2"> Inactive </option>
                                    
                                </select>
                            </div>

                        <div class="col-md-1">
                            <button class="btn btn-md btn-primary btn-block FilterResult" style="margin-top: 25px;"><i
                                    class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table class="table table-striped table-bordered" id="dc_uno_chairman_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Name</th>
                                    <th> Division</th>
                                    <th> District</th>
                                    <th> Upazila</th>
                                    <th> Mobile</th>
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

    <div id="DcUnoChairmanModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <div class="row">
                  <div class="col-md-4">  <h5 class="modal-title" id="myModalLabel"> ইউএনও মহোদয়ের তথ্য </h5></div>
                    <div class="col-md-8">  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div>
                  </div>
                
                </div>
                <form class="form-validation" enctype="multipart/form-data" id="union_setup_form"
                      action="javascript:void(0)">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 modalLabelText">Division <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control form-control-alt" onchange="getDistrict(this.value, 'district_id')" id="division_id" name="division_id" required>
                                    <option value=""> Select</option>
                                    @foreach($division as $item )
                                    <option value="{{$item->id}}"> {{$item->bn_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-md-2 modalLabelText">District <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control form-control-alt" onchange="getUpazila(this.value, 'upazila_id')" id="district_id" name="district_id" required>
                                    <option value=""> Select</option>
                                    @foreach($district as $item )
                                    <option value="{{$item->id}}"> {{$item->bn_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 modalLabelText">Upazila <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control form-control-alt" id="upazila_id" name="upazila_id" required>
                                    <option value=""> Select</option>
                                    @foreach($upazila as $item )
                                    <option value="{{$item->id}}"> {{$item->bn_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <h6 style="text-align: left; font-weight: bold;">Uno Information : </h6>
                        <div class="form-group row">
                            <label class="col-md-2 modalLabelText"> Name <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control form-control-alt" name="name" id="name"
                                       placeholder="Name" required>
                            </div>
                            <label class="col-md-2 modalLabelText">Mobile <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control form-control-alt" name="mobile" id="mobile"
                                       placeholder="Mobile" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 modalLabelText">Email </label>
                            <div class="col-md-4">
                                <input type="email" class="form-control form-control-alt" name="email" id="email"
                                       placeholder="Email" >
                            </div>
                            <label class="col-md-2 modalLabelText" > BCS Batch </label>
                            <div class="col-md-4">
                                <select class="form-control form-control-alt" id="bcs_batch" name="bcs_batch" >
                                    <option value=""> Select</option>
                                    @foreach($bcs_batch_data as $item )
                                    <option value="{{$item->id}}"> {{$item->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 modalLabelText">Address </label>
                            <div class="col-md-4">
                                <textarea name="address" id="address" class="form-control" placeholder="Address"></textarea>
                            </div>
                            <label class="col-md-2 modalLabelText">Comment </label>
                            <div class="col-md-4">
                                <textarea name="comment" id="comment" class="form-control" placeholder="Comment"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 modalLabelText">Status <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control form-control-alt" id="is_active" name="is_active" required>
                                    <option value=""> Select</option>
                                    <option value="1"> Active </option>
                                    <option value="2"> Inactive </option>
                                   
                                </select>
                            </div>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                    <input type="hidden" id="dc_uno_chairman_id" name="dc_uno_chairman_id">
                        <button type="submit" onclick="DcUnoChairmanSave()" id="union_setup_save_button"
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

<script src="{{ asset('js') }}/custom.js"></script>
<script>
    // datatable 
  $(document).ready(function(){
    let unionSetupTable = $("#dc_uno_chairman_table").DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
                url: '{{route("uno.uno_info")}}',
                data: function (e) {
                    (e.division_id = $("#divisionId").val() || 0);
                    (e.district_id = $("#districtId").val() || 0);
                    (e.upazila_id = $("#upazilaId").val() || 0);
                    (e.is_active = $("#isActive").val() || 0);
                },
            },
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data: 'name',name:'name'},
            {data: 'division_id',name:'division_id'},
            {data: 'district_id',name:'district_id'},
            {data: 'upazila_id',name:'upazila_id'},
            {data: 'mobile',name:'mobile'},
            {data: 'is_active',name:'is_active'},
            {data: 'action',name:'action'},
        ]
    });
});

function AddNew()
{

    var division_id        =  $('#division_id').val('');
    var district_id        =  $('#district_id').val('');
    var upazila_id         =  $('#upazila_id').val('');
    var name               =  $('#name').val('');
    var mobile             =  $('#mobile').val('');
    var email              =  $('#email').val('');
    var bcs_batch          =  $('#bcs_batch').val('');
    var address            =  $('#address').val('');
    var comment            =  $('#comment').val('');
    var is_active          =  $('#is_active').val('');
    var dc_uno_chairman_id = $('#dc_uno_chairman_id').val('');

    $("#DcUnoChairmanModal").modal('toggle');
   document.getElementById("SubmitbtnText").innerHTML = "Submit";
}

//  info save or update
function DcUnoChairmanSave(){
   
    var division_id        =  $('#division_id').val();
    var district_id        =  $('#district_id').val();
    var upazila_id         =  $('#upazila_id').val();
    var name               =  $('#name').val();
    var mobile             =  $('#mobile').val();
    var email              =  $('#email').val();
    var bcs_batch          =  $('#bcs_batch').val();
    var address            =  $('#address').val();
    var comment            =  $('#comment').val();
    var is_active          =  $('#is_active').val();
    var dc_uno_chairman_id = $('#dc_uno_chairman_id').val();

    if(division_id > 0 && name !=''){
        $.ajax({
                url:"{{route('uno.uno_store')}}",
                type:"POST",
                data:{
                    division_id: division_id,
                    district_id: district_id,
                    upazila_id: upazila_id,
                    name: name,
                    mobile: mobile,
                    email: email,
                    bcs_batch:bcs_batch,
                    address: address,
                    comment: comment,
                    is_active: is_active,
                    dc_uno_chairman_id:dc_uno_chairman_id,
                },
                success:function(responseText){
                    
                    if(responseText.status == 'success'){
                            swal("Success", responseText.msg, "success");
                            $("#dc_uno_chairman_table").DataTable().draw(true);
                            $("#DcUnoChairmanModal").modal('toggle');

                        }else{
                            swal("Something went wrong", responseText.msg, "error");
                        }
                }
            });
    }else{
        swal("Something went wrong", 'Information cannot be Empty', "error");
        }        
}

$(document).on("click",".DcUnoChairmanEdit",function(){
    let id = $(this).data('id');

    $.ajax({
        url:"{{route('uno.uno_edit')}}",
        type:"POST",
        data:{
            id: id
        },
        success:function(responseText){
            if(responseText.status == 'success'){
                let data = responseText.data;
                var division_id        =  $('#division_id').val(data.division_id);
                var district_id        =  $('#district_id').val(data.district_id);
                var upazila_id         =  $('#upazila_id').val(data.upazila_id);
                var name               =  $('#name').val(data.name);
                var mobile             =  $('#mobile').val(data.mobile);
                var email              =  $('#email').val(data.email);
                var bcs_batch          =  $('#bcs_batch').val(data.bcs_batch);
                var address            =  $('#address').val(data.address);
                var comment            =  $('#comment').val(data.comment);
                var is_active          =  $('#is_active').val(data.is_active);
                var dc_uno_chairman_id = $('#dc_uno_chairman_id').val(data.id);

                document.getElementById("SubmitbtnText").innerHTML = "Update";
                $("#DcUnoChairmanModal").modal('toggle');
            }
            else{
                swal("Sorry", responseText.msg, "error");
            }
        }
    })
});

//  delete 
$(document).on("click",".DcUnoChairmanDelete",function(){
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
                        url:"{{route('uno.uno_delete')}}",
                        type:"POST",
                        data:{
                            id: id
                        },
                        success:function(responseText){

                            if(responseText.status == 'success'){
                                swal("Success", responseText.msg, "success");
                                $("#dc_uno_chairman_table").DataTable().draw(true);
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

$(document).on("click", ".FilterResult", function () {
          
     $("#dc_uno_chairman_table").DataTable().draw(true);
});
</script>

@endsection