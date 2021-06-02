@extends("master")
@section('title_area')
    :: Home  :: Upazila Introduction
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
@section('main_content_area')
    <article>
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="  col-sm-12 col-md-12 col-lg-12 jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>Upazila Introduction </h2>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div><br>

                    <form class="form-validation" enctype="multipart/form-data" id=""
                      action="javascript:void(0)"><br>
                   
                        <div class="row" id="UpIntroduce_1">
                    
                            <div class="col-md-4 form-group">
                                <label for="name" class=" form-control-label modalLabelText"> Title <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-alt" id="upazila_id" name="upazila_id" required>
                                        <option value=""> Select</option>
                                        @foreach($all_type_info as $item)
                                        <option value="{{ $item->id}}"> {{$item->title}}</option>
                                        @endforeach
                                    
                                    </select>
                                
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="name" class=" form-control-label modalLabelText"> Status <span class="text-danger">*</span></label>
                                <select class="form-control form-control-alt is_active" id="is_active" name="is_active" required>
                                    <option value=""> Select</option>
                                    <option value="1"> Active </option>
                                    <option value="2"> Inactive </option>
                                   
                                </select>
                                
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="name" class=" form-control-label modalLabelText"> Display Position <span class="text-danger">*</span></label>
                                <input class="form-control" name="display_position" id="display_position">
                                
                            </div>
                            <div class="col-md-1 form-group">
                            <label> &nbsp; </label><br>
                                <button type="button" class="btn btn-sm btn-success" id="AddNewupIntroduce"> 
                                <i class="fa fa-plus"></i> 
                                </button>
                            </div>

                            <div class="col-md-6"></div>    
                            <div class="col-md-5 form-group">

                                <label for="name" class="form-control-label modalLabelText"> Description <span class="text-danger">*</span></label>
                              
                                <textarea class="form-control"></textarea>

                            </div>
                        </div><br>

                        <div class="picture_inputs"></div>

                        <div class="row">
                            <div class="col-md-9"></div>
                                <div class="col-md-1">

                                <button type="submit" onclick="unionSetupSave()" id="union_setup_save_button"
                                class="btn btn-primary btn-xs waves-effect waves-light"> <i class="glyphicon glyphicon-send"></i> <span id="SubmitbtnText"> Submit </span>
                               </button>

                                 </div>
                                 <div class="col-md-1">
                                <button  type="button" class="btn btn-danger btn-xs waves-effect"
                                        data-dismiss="modal"> <i class="glyphicon glyphicon-remove"></i> Cancel 
                                </button>
                                 </div>
                         </div> <br>
                            
                     </form>

                    </div><br>
                </div>
            </div>
        </div>
    </article>
@endsection


