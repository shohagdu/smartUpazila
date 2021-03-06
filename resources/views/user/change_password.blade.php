@extends("master")
@section('title_area')
    :: Admin  :: Change Password
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
                <h2> Change Password </h2>
                <!-- <a href="{{ route('user.list')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-list"></i>  User List </a> -->
            </header>

            <!-- widget div-->
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div><br>

                        <form action="{{ route('user.change_password_store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group row">
                                    <label for="password" class="col-md-2 col-form-label text-md-left">{{ __('Password') }}</label>

                                    <div class="col-md-4">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-2 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-4">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                   <div class="col-md-2"></div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-success">
                                            {{ __('Change') }}
                                        </button>
                                    </div>
                                </div>
                            
                       </form> <br>             

                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
