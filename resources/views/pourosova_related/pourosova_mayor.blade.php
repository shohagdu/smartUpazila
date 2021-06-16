@extends("master")
@section('title_area')
    :: Admin  ::  Mayor
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css') }}/custom.css">
@endsection
@section('main_content_area')
    <article class="">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
                style="margin-bottom:10px; ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('message') }}
            </div>
        @endif
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
               <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
               <h2> Mayor  </h2>
                <a href="{{ route('pourosova_related.pourosova_mayor_create')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-plus"></i> Add New </a>
            </header>
            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table class="table table-striped table-bordered" id="InformationTable">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Name </th>
                                    <th> Mobile</th>
                                    <th> Email </th>
                                    <th> Status </th>
                                    <th> Action</th>
                                </tr>
                               
                            </thead>
                       </table>
                    </div>
                </div>
            </div>
        </div>
    </article>

    
@endsection

@section('js')

<script src="{{ asset('js') }}/custom.js"></script>

@endsection
