@extends("master")
@section('title_area')
    :: Admin  :: Role Edit
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
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2> Role Edit </h2>
                <a href="{{ route('role.list')}}" class="btn btn-xs btn-info addNew"><i class="glyphicon glyphicon-list"></i>  Role List </a>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <form action="{{ route('role.role_store')}}" method="POST" enctype="multipart/form-data"><br>
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Role Name </label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-alt" name="role_name" id="role_name" 
                                        value="{{ $get_role_info->role_name}}" required>  
                                 </div>

                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Status </label>
                                <div class="col-md-3">
                                    <select class="form-control form-control-alt" id="is_active" name="is_active" required>
                                        <option value=""> Select</option>
                                        <option value="1" <?php if($get_role_info->is_active==1){ echo "selected";}?>> Active </option>
                                        <option value="2" <?php if($get_role_info->is_active==2){ echo "selected";}?>> Inactive </option>                
                                    </select>            
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-sm btn-success" type="submit"> Save </button>
                                </div>    
                           </div>
                           <hr>
                           <div class="form-group row">
                           <div class="col-md-1"></div>
                           <div class="col-md-4">
                           <p><label><input type="checkbox" id="checkAll"/> Check all</label></p>
                           </div>
                           </div>
                         <?php 

                        //{{ ( isset($role_data[$item->id]) ? 'checked' : '' ) }}
                         // echo "<pre>";
                        // print_r($role_info_data);exit;
                         ?>
                        
                            @foreach($get_menu_info as $item)
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <p>  <input type="checkbox"  name="role_info[{{$item->id}}]" id="role_info_{{$item->id}}" value="{{$item->id}}" > 
                                        <span style="margin-left: 10px; font-weight: bold"> {{$item->title}}  </span>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                            
                                    @if(!empty($item->mainChild))
                                        @foreach($item->mainChild as $childKey => $row)
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10">
                                            <p>  <input type="checkbox"  name="role_info[{{$item->id}}][{{$row->id}}]"  value="{{$row->id}}" > 
                                            <span style="margin-left: 10px;"> {{$row->title}} </span>
                                            </p>
                                        </div>
                                        @endforeach
                                    @endif
                           </div>
                            @endforeach
                            
                       </form> <br>             
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
@section('js')
<script>
    $("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});
</script>
@endsection
