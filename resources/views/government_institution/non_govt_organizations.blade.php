@extends("master")
@section('title_area')
    :: Admin  ::non govt organizations
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
    <article class="">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
               <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
               <h2> Non govt organizations </h2>
                <a href="{{ route('government_institution.non_govt_organizations_create')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-plus"></i> Add New </a>
            </header>
            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table class="table table-striped table-bordered" id="">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Name </th>
                                    <th> Address </th>
                                    <th> Mobile</th>
                                    <th> Email </th>
                                    <th> Status </th>
                                    <th> Action</th>
                                </tr>
                           
                            </thead>
                            @php $i=1;  @endphp    
                                @foreach($non_govt_organizations as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{ $i++}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->address}}</td>
                                            <td>{{$item->mobile}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>
                                                @if($item->is_active == 1)
                                                   <span class="label label-info"> Active </span>             
                                                @elseif($item->is_active == 2)
                                                    <span class="label label-warning"> Inactive </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('government_institution.non_govt_organizations_edit', $item->id)}}" class="btn btn-primary btn-xs"> <i class="glyphicon glyphicon-pencil"></i> Edit </a> &nbsp; &nbsp; 
                                                <a onclick="return confirm('Are you sure you want to delete?')" href="{{ route('government_institution.non_govt_organizations_delete', $item->id)}}" class="btn btn-danger btn-xs "> <i class="glyphicon glyphicon-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                        
                       </table>
                    </div>
                </div>
            </div>
        </div>
    </article>

    
@endsection

@section('js')

<!-- <script src="{{ asset('js') }}/union_setup.js"></script> -->

@endsection
