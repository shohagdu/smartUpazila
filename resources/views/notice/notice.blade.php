@extends("master")
@section('title_area')
    :: Admin  ::  Notice
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
               <h2> Notice  </h2>
                <a href="{{ route('notice.create')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-plus"></i> Add New </a>
            </header>
            <!-- widget div-->
                    <div >
                        <div class="widget-body no-padding">
                            <div class="col-sm-12"><br>
                                <form action="{{ route('notice.search')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group row">
                                        <label for="name" class="col-md-1 form-control-label modalLabelText"> Type <span class="text-danger">*</span></label>
                                        <div class="col-md-3">
                                            <select class="form-control form-control-alt" id="type" name="type" required>
                                                <option value=""> Select</option>
                                                <option value="1"> Notice  </option>
                                                <option value="2"> Government Initiatives </option>
                                                <option value="3"> Scroll News </option>
                                    
                                                
                                            </select>
                                        </div>
                                        <label for="name" class="col-md-1 form-control-label modalLabelText"> Status <span class="text-danger">*</span></label>
                                        <div class="col-md-3">
                                            <select class="form-control form-control-alt" id="status" name="status">
                                                <option value=""> Select</option>
                                                <option value="1"> Active </option>
                                                <option value="2"> Inactive </option>
                                    
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                        <button style="background-color:#4d3b6b;" class="btn btn-sm btn-success" type="submit"> Search </button>
                                        </div>
                                    </div>
                                </form>
                        <div class="col-sm-12" style="margin-top:10px;"></div>
                        <table class="table table-striped table-bordered" id="InformationTable">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Title </th>
                                    <th> Description</th>
                                    <th> Document </th>
                                    <th> Status </th>
                                    <th style="width: 150px;"> Action</th>
                                </tr>
                                @php $i=1;  @endphp    
                                @foreach($get_notice as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{ $i++}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->description}}</td>
                                            <td>
                                                <img style="width: 150px; height: 100px;" src="{{ asset('img/attachment')}}/{{$item->attachment}}"/>
                                            </td>
                                            <td>
                                                @if($item->is_active == 1)
                                                   <span class="label label-info"> Active </span>             
                                                @elseif($item->is_active == 2)
                                                    <span class="label label-warning"> Inactive </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('notice.edit', $item->id)}}" class="btn btn-primary btn-xs"> <i class="glyphicon glyphicon-pencil"></i> Edit </a> &nbsp; &nbsp; 
                                                <a onclick="return confirm('Are you sure you want to delete?')" href="{{ route('notice.delete', $item->id)}}" class="btn btn-danger btn-xs "> <i class="glyphicon glyphicon-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach 
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
