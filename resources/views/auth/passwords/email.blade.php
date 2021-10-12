@extends('layouts.app')

@section('content')
@section('styles')
    <link href="{{ asset('css/servimun.css') }}" rel="stylesheet"  type="text/css">
    <style rel="stylesheet" type="text/css">
        .bg-registro-bg
        {
            background-image: url('{{asset("images/web/bg-registry.png")}}') no-repeat center !important;
        }
    </style>
@endsection

<body class="auth-fluid-pages bg-registry  pb-0 m-0" >

<div class="auth-fluid m-0 p-0">
    <!--Auth fluid left content -->
    <div class=" p-0 m-0 " style="background: url('../images/web/bg-registry.png')  no-repeat  !important;">
        <div class="d-flex h-15 " >
            @include('shared.code.__logo_guest')
        </div>
        <div class="align-items-center " >
            <div class="card-body">

                <!-- title-->
                <h4 class="mt-0">Reset Password</h4>
                <p class="text-muted mb-4">Ingresa tu cuenta de correo electrónico <br>y te enviaremos un email con las <br>indicaciones para resetear tu password.</p>

                <!-- form -->
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group mb-3 ">
                        <label for="email">Email</label>
                        <input class="form-control {{$errors->has('email')?'has-error form-error':''}}" type="email" id="email" name="email" value="" placeholder="Ingresa tu email">
                        @if ($errors->has('email'))
                            <span class="has-error">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-lock-reset"></i> Reset Password </button><br><br>
                        <a href="{{ route('login') }}" class="btn btn-secondary btn-block text-white ml-1"><b>INGRESAR</b></a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="auth-fluid-right  m-0 p-0" >
        <img src="/images/bg-auth.png" height="100%" width="100%"  />
    </div>
    <!-- end Auth fluid right content -->
</div>
<!-- end auth-fluid-->

<!-- App js -->
@include('partials/script_footer')

</body>
@endsection
