@extends('layouts.app')

@section('content')
    <body class="auth-fluid-pages pb-0">

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box sidebar-atemun-bg" style="background-color: lightgrey !important;">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">
                    @include('shared.code.__logo_guest')
                    <!-- title-->
                    <h4 class="mt-4">Ingresar</h4>
                    <p class="text-muted mb-3"></p>
                    <!-- form -->
                    <form method="POST" action="{{ route('login') }}" class="mt-0">
                        @csrf
                        <div class="form-group">
                            <label for="username" class="{{$errors->has('username')?'text-danger':''}}">Nombre de Usuario</label>
                            <input class="form-control {{$errors->has('username')?'has-error form-error':''}}" type="text" id="username" name="username" value="{{ old('username') }}" required placeholder="Username">
                            @if ($errors->has('username'))
                                <span class="has-error">
                                        <strong class="text-danger">{{ $errors->first('username') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <a href="{{ route('password.request') }}" class="text-info float-right"><small>Olvidaste tu password</small></a>
                            <label for="password" class="{{$errors->has('password')?'text-danger':''}}">Password</label>
                            <input class="form-control {{$errors->has('password')?'has-error form-error':''}}" type="password" required="" id="password" name="password" placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="has-error">
                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkbox-signin">
                                <label class="custom-control-label" for="checkbox-signin">Recordar</label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-login"></i> Ingresar </button>
                        </div>
                    </form>
                    <!-- end form-->

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center sidebar-right-bg" >
            <div class="sidebar-right-image" >
                <img src="/images/bg-auth.png"   />
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->

    <!-- App js -->
    @include('partials/script_footer')

    </body>

@endsection
