@extends("master")
@section('title_area')
    :: Admin  :: land matters add
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
                <h2> land matter add </h2>
                <a href="{{ route('government_institution.land_matters')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-list"></i>  land matter List </a>
            </header>

            <!-- widget div-->
            <div >
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <form action="{{ route('government_institution.land_matters_store')}}" method="POST" enctype="multipart/form-data">
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
                           </div><br>
                           <div class="form-group row">
                                <label for="name" class="col-md-1 form-control-label modalLabelText"> Email <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="email" class="form-control form-control-alt" name="email" id="email" required
                                        placeholder="Email">
                                </div>

                                <label for="name" class="col-md-2 form-control-label modalLabelText"> Designation<span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-alt" name="designation" id="designation" required
                                        placeholder="Designation">
                                </div>   
                           </div><br>
                           
                           <div class="form-group row">

                           
                            <label for="name" class="col-md-1 form-control-label modalLabelText"> Title <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <select class="form-control form-control-alt" id="title" name="title" required>
                                    <option value=""> Select</option>
                                    @foreach($type_info as $item)
                                    <option value="{{ $item->id}}"> {{$item->title}}</option>
                                    @endforeach
                                   
                                </select>
                                
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

                            <label for="name" class="col-md-2 form-control-label modalLabelText"> Image </label>
                            <div class="col-md-4">
                                    <input type="file" class="form-control form-control-alt" name="image" id="image">
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