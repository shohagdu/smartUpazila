@extends("master")
@section('title_area')
    :: Admin  :: User Edit
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
                <h2> User Edit </h2>
                <a href="{{ route('user.list')}}" class="btn btn-xs btn-success addNew"><i class="glyphicon glyphicon-list"></i>  User List </a>
            </header>

            <!-- widget div-->
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <form action="{{ route('user.update',  $user_info->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf

                               <div class="form-group row">
                                    <label for="name" class="col-md-2 col-form-label text-md-left">{{ __('Name') }}</label>
                                    <div class="col-md-4">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user_info->name}}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-2 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-4">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user_info->email }}" required autocomplete="email" readonly>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role_id" class="col-md-2 col-form-label text-md-left">{{ __('Role') }}</label>
                                    <div class="col-md-4">
                                        <select  class="form-control @error('role_id') is-invalid @enderror" name="role_id" value="{{ old('role_id') }}" >
                                            <option value=""> Select </option>
                                            @foreach($role_info as $item)
                                                <option value="{{$item->id}}" <?php if($user_info->role_id== $item->id){ echo "selected";}?>> {{$item->role_name}} </option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_active" class="col-md-2 col-form-label text-md-left">{{ __('Status') }}</label>
                                    <div class="col-md-4">
                                    
                                        <select  class="form-control @error('is_active') is-invalid @enderror" name="is_active" value="{{ old('is_active') }}" >
                                            <option value="">Select</option>
                                            <option value="1" <?php if($user_info->is_active==1){ echo "selected";}?>> Active </option>
                                            <option value="2" <?php if($user_info->is_active==2){ echo "selected";}?>> Inactive </option>         
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-2 col-form-label text-md-left">{{ __('Password') }}</label>
                                    <div class="col-md-4">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                         <input type="hidden" name="pre_password" value="{{$user_info->password}}">   
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
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                   <div class="col-md-2"></div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-info">
                                            {{ __('Update') }}
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
