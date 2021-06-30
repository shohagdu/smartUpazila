@extends("master")
@section('title_area')
    :: Admin  :: Menu Edit
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
                <h2> Menu Edit </h2>
                <a href="{{ route('menu.list')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-list"></i>  Menu List </a>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <form action="{{ route('menu.update', $menu_info->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                             <br><br>
                            <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Title <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="title" id="title" required
                                        value="{{$menu_info->title}}">
                                </div>

                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Link </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="link" id="link" value="{{$menu_info->link}}">
                                </div>
                           </div>
                           <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Menu  </label>
                                <div class="col-md-4">
                                <select class="form-control form-control-alt" id="parent_id" name="parent_id" >
                                        <option value="" > Root</option>
                                        @foreach($get_menu_info as $item)
                                        <option value="{{ $item->id}}" <?php if($menu_info->parent_id== $item->id){ echo "selected";}?>> {{$item->title}}</option>
                                        @endforeach
                                    
                                    </select>
                                </div>

                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Glyphicon Icon </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="glyphicon_icon" id="glyphicon_icon" value="{{$menu_info->glyphicon_icon}}">
                                </div>
                           </div>
                           
                           <div class="form-group row">
                            <label for="name" class="col-md-1 form-control-label modalLabelText"> Position </label>
                            <div class="col-md-4">
                               <input type="text" class="form-control form-control-alt" name="display_position" id="display_position"  value="{{$menu_info->display_position}}"> 
                            </div>

                            <label for="name" class="col-md-2 form-control-label modalLabelText"> Is main menu </label>
                            <div class="col-md-4">
                                <select class="form-control form-control-alt" id="is_main_menu" name="is_main_menu" required>
                                    <option value=""> Select</option>
                                    <option value="1" <?php if($menu_info->is_main_menu==1){ echo "selected";}?>> 1st Step  </option>
                                    <option value="2" <?php if($menu_info->is_main_menu==2){ echo "selected";}?>> 2nd Step  </option>      
                                    <option value="3" <?php if($menu_info->is_main_menu==3){ echo "selected";}?>> 3rd Step  </option>                             
                                </select>         
                            </div>

                           </div>
                                
                           <div class="form-group row">
                           <label for="name" class="col-md-1 form-control-label modalLabelText"> Status <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control form-control-alt" id="is_active" name="is_active" required>
                                    <option value=""> Select</option>
                                    <option value="1" <?php if($menu_info->is_active==1){ echo "selected";}?>> Active </option>
                                    <option value="2" <?php if($menu_info->is_active==2){ echo "selected";}?>> Inactive </option>                          
                                </select>                             
                            </div>
                           </div>
                           
                          <button style="float: right; margin-right: 95px;" class="btn btn-sm btn-info" type="submit"> Update </button><br><br>
                       </form> <br>             

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
