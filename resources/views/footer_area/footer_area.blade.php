@extends("master")
@section('title_area')
    :: Home  :: Footer Area
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
                <h2> Footer Area </h2>
            </header>

            <!-- widget div-->
            </div>
                <div class="widget-body no-padding">
                    <div class="row">
                    <div class="col-md-1"> </div>
                    <!-- <div class="col-md-10"> 
                        <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#PrivacyPolicy"> Privacy Policy </a></li>
                        <li><a data-toggle="tab" href="#TermsOfUse">Terms of use</a></li>
                        <li><a data-toggle="tab" href="#Inoverallcooperation">In overall cooperation</a></li>
                        <li><a data-toggle="tab" href="#Sitemap">Sitemap</a></li>
                        <li><a data-toggle="tab" href="#Commonlyasked">Commonly asked</a></li>
                        </ul>

                    </div> -->
                        <div class="col-md-10">
                         <a href="{{ route('footer_area.privacy_policy')}}" class="btn btn-sm btn-success"> Privacy Policy </a> &nbsp;&nbsp;
                         <a href="{{ route('footer_area.terms_of_use')}}" class="btn btn-sm btn-success"> Terms of use </a>  &nbsp;&nbsp;
                         <a href="{{ route('footer_area.in_overall_cooperation')}}" class="btn btn-sm btn-success"> In overall cooperation </a>  &nbsp;&nbsp;
                         <a href="{{ route('footer_area.sitemap')}}" class="btn btn-sm btn-success"> Sitemap </a>  &nbsp;&nbsp;
                         <a href="{{ route('footer_area.commonly_asked')}}" class="btn btn-sm btn-success"> Commonly asked </a>  &nbsp;&nbsp;

                         </div>
                    </div>
                </div>

               <!--<div class="tab-content">
                <div id="PrivacyPolicy" class="tab-pane fade in active">
                    <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                            <h2> Privacy policy </h2>
                            <a href="{{ route('footer_area.index')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-list"></i>  Footer Area </a>
                        </header>

                 
                        <div >
                            <div class="widget-body no-padding">
                                <div class="col-sm-12">
                                    <div class="col-sm-12" style="margin-top:10px;"></div>

                                    <form action="{{ route('footer_area.privacy_policy_store')}}" method="POST">
                                        @csrf
                                    
                                    <textarea style="height: 700px;"  class="form-control" id="summary-ckeditor" name="privacy_policy">{{ $info }}</textarea><br>

                                <button style="float: right;" class="btn btn-sm btn-success" type="submit"> Save </button><br><br>
                                </form> <br>             

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="TermsOfUse" class="tab-pane fade">
                  <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                        <h2> Terms of use </h2>
                        <a href="{{ route('footer_area.index')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-list"></i>  Footer Area </a>
                    </header>
                     
                        <div >
                            <div class="widget-body no-padding">
                                <div class="col-sm-12">
                                    <div class="col-sm-12" style="margin-top:10px;"></div>

                                    <form action="{{ route('footer_area.terms_of_use_store')}}" method="POST">
                                        @csrf
                                    
                                    <textarea style="height: 700px;"  class="form-control" id="summary-ckeditor" name="terms_of_use">{{ $info }}</textarea><br>

                                    <button style="float: right;" class="btn btn-sm btn-success" type="submit"> Save </button><br><br>
                                </form> <br>             

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Inoverallcooperation" class="tab-pane fade">
                    <h3>Menu 2</h3>
                    <p>Some content in menu 2.</p>
                </div>
                <div id="Sitemap" class="tab-pane fade">
                    <h3>Sitemap</h3>
                    <p>Some content in menu 2.</p>
                </div>
                <div id="Commonlyasked" class="tab-pane fade">
                    <h3>Commonlyasked</h3>
                    <p>Some content in menu 2.</p>
                </div>
                </div>-->
            </div>
        </div>
    </article>
@endsection
@section('js')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor' );
</script>
@endsection

