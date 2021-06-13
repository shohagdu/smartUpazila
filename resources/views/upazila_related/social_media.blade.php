@extends("master")
@section('title_area')
    :: Home  :: Socila Media
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
                <h2> Socila Media </h2>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <form action="{{ route('upazila_related.social_media_store')}}" method="POST"><br>
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Facebook link <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-alt" name="facebook_link" id="facebook_link" required
                                       value="{{ $social_media->facebook_link}}">
                                </div>
                           </div>
                           <div class="form-group row">
                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Youtube link <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-alt" name="youtube_link" id="youtube_link" required
                                    value="{{ $social_media->youtube_link}}">
                                </div>
                           </div>
                           <div class="form-group row">
                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Twitter link <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-alt" name="twitter_link" id="twitter_link" required
                                    value="{{ $social_media->twitter_link}}">
                                </div>
                           </div>
                           <div class="form-group row">
                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Instagram  link <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-alt" name="instagram_link" id="instagram _link" required
                                    value="{{ $social_media->instagram_link}}">
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

