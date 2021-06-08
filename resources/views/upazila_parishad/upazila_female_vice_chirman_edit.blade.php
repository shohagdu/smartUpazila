@extends("master")
@section('title_area')
    :: Admin  :: Female Vice Chairman Edit
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
                <h2>  Female Vice Chairman Edit </h2>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <form action="{{ route('upazila_parishad.female_vice_chairman_update', $chairman_data[0]->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                             <br><br>
                            <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Name <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="name" id="name" required
                                        value="{{$chairman_data[0]->name}}">
                                </div>

                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Mobile <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="mobile" id="mobile" required
                                    value="{{$chairman_data[0]->mobile}}">
                                </div>
                           </div><br>
                           <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Email <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="email" class="form-control form-control-alt" name="email" id="email" required
                                    value="{{$chairman_data[0]->email}}">
                                </div>

                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Image <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="file" class="form-control form-control-alt" name="image" id="image">
                                    <input name="pre_img" type="hidden" value="{{$chairman_data[0]->image}}">
                                </div>
                           </div><br>
                           
                           <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Period Start </label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control form-control-alt" name="period_start" id="period_start" value="{{$chairman_data[0]->period_start}}">
                                </div>

                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Period End </label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control form-control-alt" name="period_end" id="period_end" value="{{$chairman_data[0]->period_end}}">
                                </div>
                           </div><br>

                           <div class="form-group row">
                            <label for="name" class="col-md-1 form-control-label modalLabelText"> Status <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control form-control-alt" id="is_active" name="is_active" required>
                                    <option value=""> Select</option>
                                    <option value="1" <?php if($chairman_data[0]->is_active==1){ echo "selected";}?>> Active </option>
                                    <option value="2" <?php if($chairman_data[0]->is_active==2){ echo "selected";}?>> Inactive </option>
                                   
                                </select>
                            </div>
                            <label for="name" class="col-md-2 form-control-label modalLabelText"> View order <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="view_order" id="view_order" required
                                    value="{{$chairman_data[0]->view_order}}">
                                </div>
                           </div>
                           <div class="form-group row">
                             <label class="col-md-1"> &nbsp;&nbsp;&nbsp; Details </label>
                              <textarea  name="details"   class="form-control" id="summary-ckeditor" name="summary-ckeditor"> {{$chairman_data[0]->details}}</textarea><br>
                           </div>

                       <button style="float: right;" class="btn btn-sm btn-primary" type="submit"> Update </button><br><br>
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

</script>
@endsection

