@extends("master")
@section('title_area')
    :: Admin  :: Acl Role List
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
               <h2> Acl Role list </h2>
                <a href="{{ route('role.role_create')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-plus"></i> Add New </a>
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
                                    <th> Role Name </th>
                                    <th> Status </th>
                                    <th> Action</th>
                                </tr>
                           
                            </thead>
                            @php $i=1;  @endphp    
                                @foreach($role_info as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{ $i++}}</td>
                                            <td>{{$item->role_name}}</td>
                                         
                                            <td>
                                                @if($item->is_active == 1)
                                                   <span class="label label-info"> Active </span>             
                                                @elseif($item->is_active == 2)
                                                    <span class="label label-warning"> Inactive </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('role.role_edit', $item->id)}}" class="btn btn-primary btn-xs"> <i class="glyphicon glyphicon-pencil"></i> Edit </a> &nbsp; &nbsp; 
                                                <a onclick="return confirm('Are you sure you want to delete?')" href="{{ route('role.role_delete', $item->id)}}" class="btn btn-danger btn-xs "> <i class="glyphicon glyphicon-trash"></i> Delete</a>
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

<script src="{{ asset('js') }}/custom.js"></script>

@endsection
