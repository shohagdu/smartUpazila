@extends("master")
@section('title_area')
    :: Admin  :: Kormokorta Edit
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
                <h2> Kormokorta Edit </h2>
                <a href="{{ route('pourosova_related.pourosova_kormokorta')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-list"></i>  Kormokorta List </a>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <form action="{{ route('pourosova_related.pourosova_kormokorta_update', $kormokorta_data[0]->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                             <br><br>
                            <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Name <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="name" id="name" required
                                       value="{{$kormokorta_data[0]->name}}">
                                </div>

                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Mobile <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="mobile" id="mobile" required
                                    value="{{$kormokorta_data[0]->mobile}}">
                                </div>
                           </div><br>
                           <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Email <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="email" class="form-control form-control-alt" name="email" id="email" required
                                    value="{{$kormokorta_data[0]->email}}">
                                </div>

                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Designation <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="designation" id="designation" required
                                    value="{{$kormokorta_data[0]->designation}}">
                                </div>   
                           </div><br>
                        

                           <div class="form-group row">
                            <label for="name" class="col-md-1 form-control-label modalLabelText"> Status <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control form-control-alt" id="is_active" name="is_active" required>
                                    <option value=""> Select</option>
                                    <option value="1" <?php if($kormokorta_data[0]->is_active==1){ echo "selected";}?>> Active </option>
                                    <option value="2" <?php if($kormokorta_data[0]->is_active==2){ echo "selected";}?>> Inactive </option>
                                   
                                </select>
                            </div>

                           
                             <label for="name" class="col-md-2 form-control-label modalLabelText"> View order <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="view_order" id="view_order" required
                                    value="{{$kormokorta_data[0]->view_order}}">
                                </div>


                           </div>

                           <div class="form-group row">
                           
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                <label for="name" class="form-control-label"> Responsibilities</label>
                                   <textarea class="form-control" name="responsibilities" id="responsibilities"> {{$kormokorta_data[0]->responsibilities}}</textarea>
                                </div>

                           </div>

                       <button style="float: right;" class="btn btn-sm btn-primary" type="submit"> Update </button><br><br>
                       </form> <br>             

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection


