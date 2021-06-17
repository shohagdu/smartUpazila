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
            <div >
                <div class="widget-body no-padding"><br><br>
                    <div class="row">
                        <div class="col-md-2"> </div>
                        <div class="col-md-8">
                         <a href="{{ route('footer_area.privacy_policy')}}" class="btn btn-sm btn-success"> Privacy Policy </a> &nbsp;&nbsp;
                         <a href="{{ route('footer_area.terms_of_use')}}" class="btn btn-sm btn-success"> Terms of use </a>  &nbsp;&nbsp;
                         <a href="{{ route('footer_area.in_overall_cooperation')}}" class="btn btn-sm btn-success"> In overall cooperation </a>  &nbsp;&nbsp;
                         <a href="{{ route('footer_area.sitemap')}}" class="btn btn-sm btn-success"> Sitemap </a>  &nbsp;&nbsp;
                         <a href="{{ route('footer_area.commonly_asked')}}" class="btn btn-sm btn-success"> Commonly asked </a>  &nbsp;&nbsp;

                         </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

