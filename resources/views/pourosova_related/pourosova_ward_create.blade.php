@extends("master")
@section('title_area')
    :: Admin  :: Ward add
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
                <h2> Ward Add </h2>
                <a href="{{ route('pourosova_related.pourosova_ward')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-list"></i>  Ward List </a>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <form action="{{ route('pourosova_related.pourosova_ward_store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                             <br><br>
                           
                          
                    
                           <div class="form-group row">
                            <label for="name" class="col-md-1 form-control-label modalLabelText"> Ward No <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                            <input type="text" class="form-control form-control-alt" name="ward_no" id="ward_no" required
                                        placeholder="ward no">
                            </div>

                           
                             <label for="name" class="col-md-2 form-control-label modalLabelText"> View order <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="view_order" id="view_order" required
                                        placeholder="View Order">
                                </div>


                           </div><br>

                           <div class="form-group row">
                           

                           <label for="name" class="col-md-1 form-control-label modalLabelText"> Status <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control form-control-alt" id="is_active" name="is_active" required>
                                    <option value=""> Select</option>
                                    <option value="1"> Active </option>
                                    <option value="2"> Inactive </option>
                                   
                                </select>
                            </div>

                            <label for="name" class=" col-md-2 form-control-label modalLabelText">Village</label>
                                <div class="col-md-4">
                               
                                   <textarea class="form-control" name="village" id="village"> </textarea>
                                </div>

                           </div>

                       <button style="float: right;" class="btn btn-sm btn-success" type="submit"> Save </button><br><br>
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

