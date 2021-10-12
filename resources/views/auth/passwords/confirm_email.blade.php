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

                <!-- email send icon with text-->
                <div class="text-center m-auto">
                    <h4 class="text-dark-50 text-center mt-4 font-weight-bold">Por favor checa tu email</h4>
                    <p class="text-primary-dark mb-4">
                        Se ha enviado un email a: <br><b>{{$email}}</b>.<br>
                        Ingrese a su cuenta de correo y <br>haga click en el enlace que aparece <br>en la parte de abajo para cambiar <br>su password.<br><br>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-block text-dark ml-1"><b>INGRESAR</b></a>
                    </p>
                </div>

                <!-- Footer-->

            </div> <!-- end .card-body -->
        </div> <!-- end .align-items-center.d-flex.h-100-->
    </div>
    <!-- end auth-fluid-form-box-->

    <!-- Auth fluid right content -->
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
