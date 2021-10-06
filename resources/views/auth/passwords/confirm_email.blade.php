@extends('layouts.app')

@section('content')

@section('styles')
    <link href="{{ asset('css/servimun.css') }}" rel="stylesheet"  type="text/css">
@endsection


<body class="auth-fluid-pages pb-0">

<div class="auth-fluid">
    <!--Auth fluid left content -->
    <div class="auth-fluid-form-box  sidebar-atemun-bg sidebar-left-bg" >
        <div class="align-items-center d-flex h-100">
            <div class="card-body">

                @include('shared.code.__logo_guest')
                <!-- email send icon with text-->
                <div class="text-center m-auto">
                    <h4 class="text-dark-50 text-center mt-4 font-weight-bold">Por favor checa tu email</h4>
                    <p class="text-primary-dark mb-4">
                        Se ha enviado un email a <b>{{$email}}</b>.
                        Ingrese a su cuenta de correo y haga click en el enlace que aparece en la parte de abajo para cambiar su password.
                    </p>
                </div>

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
