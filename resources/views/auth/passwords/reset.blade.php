@extends('layouts.app')

@section('content')
@section('styles')
    <link href="{{ asset('css/servimun.css') }}" rel="stylesheet"  type="text/css">
@endsection

<body class="auth-fluid-pages pb-0">

<div class="auth-fluid">
    <!--Auth fluid left content -->
    <div class="auth-fluid-form-box idebar-atemun-bg sidebar-left-bg">
        <div class="align-items-center d-flex h-100">
            <div class="card-body">

                @include('shared.code.__logo_guest')
                <!-- title-->
                <h4 class="mt-0">Restablecar Password</h4>
                <p class="text-muted mb-4">Ingresa tu email y tu nuevo password.</p>

                <!-- form -->
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control {{$errors->has('email')?'has-error form-error':''}}" type="email" id="email" name="email" value="" placeholder="Ingresa tu email">
                        @if ($errors->has('email'))
                            <span class="has-error">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control {{$errors->has('password')?'has-error form-error':''}}" required name="password" id="password" placeholder="Enter your password" type="password">
                        @if ($errors->has('password'))
                            <span class="has-error">
                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Re-Password</label>
                        <input class="form-control {{$errors->has('password_confirmation')?'has-error form-error':''}}" required name="password_confirmation" id="password_confirmation" placeholder="Enter your password" type="password">
                        @if ($errors->has('password_confirmation'))
                            <span class="has-error">
                                        <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-lock-reset"></i> Reset Password </button>
                    </div>

                </form>
                <!-- end form-->

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <a href="{{ route('login') }}" class="text-dark ml-1"><b>Regresar</b></a>
                </footer>

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
