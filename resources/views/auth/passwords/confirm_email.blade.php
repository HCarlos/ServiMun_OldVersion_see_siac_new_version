@extends('layouts.app')

@section('content')
<body class="auth-fluid-pages pb-0">

<div class="auth-fluid">
    <!--Auth fluid left content -->
    <div class="auth-fluid-form-box">
        <div class="align-items-center d-flex h-100">
            <div class="card-body">

                @include('shared.code.__logo_guest')
                <!-- email send icon with text-->
                <div class="text-center m-auto">
                    <h4 class="text-dark-50 text-center mt-4 font-weight-bold">Por favor checa tu email</h4>
                    <p class="text-muted mb-4">
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
    <div class="auth-fluid-right text-center">
        <div class="auth-user-testimonial">
            <h2 class="mb-3">{{env('NOMBRE_COLEGIO')}}</h2>
            <p class="lead"><i class="mdi mdi-format-quote-open"></i>{{env('LEMA_CAMPANA')}}<i class="mdi mdi-format-quote-close"></i>
            </p>
            <p>
                {{env('INFO_ONE')}}
            </p>
        </div> <!-- end auth-user-testimonial-->
    </div>
    <!-- end Auth fluid right content -->
</div>
<!-- end auth-fluid-->

<!-- App js -->
@include('partials/script_footer')

</body>
@endsection
