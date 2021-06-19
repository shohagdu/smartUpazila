@extends("master")
@section('title_area')
    :: Admin  :: People add
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
                <h2> People Add </h2>
                <a href="{{ route('people.index')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-list"></i>  People List </a>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <form action="{{ route('people.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                             <br><br>
                            <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Name <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="name" id="name" required
                                        placeholder="Name">
                                </div>

                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Mobile <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="mobile" id="mobile" required
                                        placeholder="Mobile">
                                </div>
                           </div>
                           <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Email <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="email" class="form-control form-control-alt" name="email" id="email" required
                                        placeholder="Email">
                                </div>

                                <label for="name" class="col-md-2 form-control-label modalLabelText"> type <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <select class="form-control form-control-alt" id="type" name="type" required>
                                        <option value=""> Select</option>
                                        <option value="1"> উপজেলা নির্বাহী অফিসার, </option>
                                        <option value="2"> উপজেলা কর্মকর্তাগণ </option>
                                        <option value="3"> ডাক্তার তালিকা </option>
                                    
                                    </select>
                                </div>   
                           </div>

                           <div class="form-group row">
                               
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Address </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt " name="address" id="address" placeholder="address">
                                </div>
                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Period start </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt datepicker" name="period_start" id="period_start">
                                </div>
                           </div>
                           
                           <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Status <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <select class="form-control form-control-alt" id="is_active" name="is_active" required>
                                        <option value=""> Select</option>
                                        <option value="1"> Active </option>
                                        <option value="2"> Inactive </option>
                                    
                                    </select>
                                </div>
                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Period end </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt datepicker" name="period_end" id="period_end">
                                </div>
                           </div>
            
                           <div class="form-group row">
                            <label for="name" class="col-md-1 form-control-label modalLabelText"> Image </label>
                            <div class="col-md-4">
                                    <input type="file" class="form-control form-control-alt " name="image" id="image">
                            </div>

                             <label for="name" class="col-md-2 form-control-label modalLabelText"> View order <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="view_order" id="view_order" required
                                        placeholder="View Order">
                                </div>

                           </div>
                           
                           <div class="form-group row">
                           
                                <label for="name" class="col-md-1 form-control-label modalLabelText">Details</label>
                                <div class="col-md-4">
                                   <textarea rows="5" class="form-control" name="details" id="details"> </textarea>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <img src="{{ asset('img')}}/deafult.jpg" id="img_preview" style="width: 100%; height: 100px;"/>
                                </div>

                           </div>

                       <button style="float: right; margin-right: 100px;" class="btn btn-sm btn-success " type="submit"> Save </button><br><br>
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

