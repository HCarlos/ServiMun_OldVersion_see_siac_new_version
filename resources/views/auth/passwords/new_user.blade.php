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
                <div class="text-left m-auto">
                    <h4 class="text-dark-50 text-center mt-4 font-weight-bold">Felicidades!</h4>
                    <p class="text-primary-dark mb-4">
                        Se ha creado tu cuenta satisfactoriamente, estos son tus datos:<br><br>
                        - Email: <b>{{$email}}</b>.<br>
                        - Username: <b>{{$username}}</b>.<br>
                        - Password: <b>{{$username}}</b>.<br><br>
                        Resguarda bien estos datos.<br><br><br><br>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-block text-white ml-1"><b>INGRESAR</b></a>
                    </p>
                </div>

            </div> <!-- end .card-body -->
        </div>
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
