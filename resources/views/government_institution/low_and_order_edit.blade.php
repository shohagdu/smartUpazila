@extends("master")
@section('title_area')
    :: Admin  :: low and order Edit
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
                <h2> low and order Edit </h2>
                <a href="{{ route('pourosova_related.low_and_order')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-list"></i>  low and order  List </a>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <form action="{{ route('government_institution.low_and_order_update', $low_and_order_info->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                             <br><br>
                            <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Name <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="name" id="name" required
                                       value="{{$low_and_order_info->name}}">
                                </div>

                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Mobile <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="mobile" id="mobile" required
                                    value="{{$low_and_order_info->mobile}}">
                                </div>
                           </div><br>
                           <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Email <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="email" class="form-control form-control-alt" name="email" id="email" required
                                    value="{{$low_and_order_info->email}}">
                                </div>

                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Designation<span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="designation" id="designation" required
                                    value="{{$low_and_order_info->designation}}">
                                </div>   
                           </div><br>
                           
                           <div class="form-group row">

                           
                            <label for="name" class="col-md-1 form-control-label modalLabelText"> Title <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control form-control-alt" id="title" name="title" required>
                                    <option value=""> Select</option>
                                    @foreach($type_info as $item)
                                    <option value="{{ $item->id}}" <?php if($low_and_order_info->title==$item->id){ echo "selected";}?>> {{$item->title}}</option>
                                    @endforeach
                                   
                                </select>
                                
                            </div>

                            <label for="name" class="col-md-2 form-control-label modalLabelText"> View order <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" class="form-control form-control-alt" name="view_order" id="view_order" required
                                value="{{$low_and_order_info->view_order}}">
                            </div>
                           </div><br>

                           
                                
                           <div class="form-group row">
                           <label for="name" class="col-md-1 form-control-label modalLabelText"> Status <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control form-control-alt" id="is_active" name="is_active" required>
                                    <option value=""> Select</option>
                                    <option value="1" <?php if($low_and_order_info->is_active==1){ echo "selected";}?>> Active </option>
                                    <option value="2" <?php if($low_and_order_info->is_active==2){ echo "selected";}?>> Inactive </option>
                                   
                                </select>
                                
                            </div>
                    
                            <label for="name" class="col-md-2 form-control-label modalLabelText"> Image </label>
                            <div class="col-md-4">
                                    <input type="file" class="form-control form-control-alt" name="image" id="image">
                                    <input type="hidden" name="pre_image" id="pre_image" value="{{$low_and_order_info->image}}">
                            </div>

                           </div>
                           
                       <button style="float: right;" class="btn btn-sm btn-info" type="submit"> Update </button><br><br>
                       </form> <br>             

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
