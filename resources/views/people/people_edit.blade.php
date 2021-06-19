@extends("master")
@section('title_area')
    :: Admin  :: People Edit
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
                <h2> People Edit </h2>
                <a href="{{ route('people.index')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-list"></i>  People List </a>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <form action="{{ route('people.update', $info->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                             <br><br>
                            <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Name <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="name" id="name" required
                                        value="{{$info->name}}">
                                </div>

                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Mobile <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="mobile" id="mobile" required
                                    value="{{$info->mobile}}">
                                </div>
                           </div>
                           <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Email <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="email" class="form-control form-control-alt" name="email" id="email" required
                                    value="{{$info->email}}">
                                </div>

                                <label for="name" class="col-md-2 form-control-label modalLabelText"> type <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <select class="form-control form-control-alt" id="type" name="type" required>
                                        <option value=""> Select</option>
                                        <option value="1" <?php if($info->type==1){ echo "selected";}?>> উপজেলা নির্বাহী অফিসার, </option>
                                        <option value="2" <?php if($info->type==2){ echo "selected";}?>> উপজেলা কর্মকর্তাগণ </option>
                                        <option value="3" <?php if($info->type==3){ echo "selected";}?>> ডাক্তার তালিকা </option>
                                    
                                    </select>
                                </div>   
                           </div>

                           <div class="form-group row">
                               
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Address </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt " name="address" id="address"  value="{{$info->address}}">
                                </div>
                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Period start </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt datepicker" name="period_start" id="period_start"  value="{{ date('d-m-Y', strtotime($info->period_start))}}">
                                </div>
                           </div>
                           
                           <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Status <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <select class="form-control form-control-alt" id="is_active" name="is_active" required>
                                        <option value=""> Select</option>
                                        <option value="1" <?php if($info->is_active==1){ echo "selected";}?>> Active </option>
                                        <option value="2" <?php if($info->is_active==2){ echo "selected";}?>> Inactive </option>
                                    
                                    </select>
                                </div>
                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Period end </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt datepicker" name="period_end" id="period_end"  value="{{ date('d-m-Y', strtotime($info->period_end))}}">
                                </div>
                           </div>
            
                           <div class="form-group row">
                            <label for="name" class="col-md-1 form-control-label modalLabelText"> Image </label>
                            <div class="col-md-4">
                                    <input type="file" class="form-control form-control-alt " name="image" id="image">
                                    <input type="hidden" class="form-control form-control-alt " name="pre_image" id="pre_image" value="{{$info->image}}">
                            </div>

                             <label for="name" class="col-md-2 form-control-label modalLabelText"> View order <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="view_order" id="view_order" required
                                        value="{{$info->view_order}}">
                                </div>

                           </div>
                           
                           <div class="form-group row">
                           
                                <label for="name" class="col-md-1 form-control-label modalLabelText">Details</label>
                                <div class="col-md-4">
                                   <textarea rows="5" class="form-control" name="details" id="details"> {{$info->details}}</textarea>
                                </div>

                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    @if(!empty($info->image))
                                      <img src="{{ asset('img/people')}}/{{$info->image}}" id="img_preview" style="width: 100%; height: 100px;"/>
                                    @else

                                    <img src="{{ asset('img')}}/deafult.jpg" id="img_preview" style="width: 100%; height: 100px;"/>

                                    @endif
                                </div>

                           </div>

                       <button style="float: right; margin-right: 100px;" class="btn btn-sm btn-info " type="submit"> Update </button><br><br>
                       </form> <br>             

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection


@section('js')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
</script>

<script>
    image.onchange = evt => {
    const [file] = image.files
    if (file) {
        img_preview.src = URL.createObjectURL(file)
    }
    }
</script>
@endsection

