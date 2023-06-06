@extends('layouts.app')

@section('content')

    @section('styles')
        <link href="{{ asset('css/ace.css') }}" rel="stylesheet">
        <link href="{{ asset('js/@page-style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/ace-themes.css') }}" rel="stylesheet">
    @endsection

    <body id="dashboard-home">
        <div class="wrapper">
            @include('partials/left-sidebar')
            <div class="content-page">
                <div class="content">
                    @include('partials/topbar')
                    <div class="container-fluid home">

                        <div class="row px-2 mt-3">
                            <div class="col-12 col-sm-6 col-lg-3 px-2 mb-2 mb-lg-0">

                                <div class="bcard h-100 d-flex align-items-center p-3">

                                    <div>
                                        <span class="d-inline-block bgc-green-d1 p-3 radius-round text-center border-4 brc-green-l2">
                                             <i class="fa fa-id-card text-white text-170 w-4 h-4"></i>
                                         </span>
                                    </div>

                                    <div class="ml-3 flex-grow-1">
                                        <div class="pos-rel">
                                            <span class="text-dark-tp3 text-180">
                                                {{ $DenunciasHoy }}
                                            </span>
                                            <span class="@if($porc > 0) text-blue-m1 @else text-danger-m1 @endif  text-600 text-90 ml-15 text-nowrap">
                                                 {{ $porc }} %
                                                @if($porc > 0)
                                                     <i class="fa fa-arrow-up"></i>
                                                @else
                                                    <i class="fa fa-arrow-down"></i>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="text-dark-tp4 text-110">
                                            Solicitudes de Hoy
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3 px-2 mb-2 mb-lg-0">
                                <div class="bcard h-100 d-flex align-items-center p-3">
                                    <div>
                                        <span class="d-inline-block bgc-warning-d1 p-3 radius-round text-center border-4 brc-warning-l2">
                                            <i class="fa fa-id-card text-white text-170 w-4 h-4"></i>
                                        </span>
                                    </div>
                                    <div class="ml-3 flex-grow-1">
                                        <div class="pos-rel">
                                            <span class="text-dark-tp3 text-180">
                                                {{ $DenunciasAyer }}
                                            </span>
                                        </div>
                                        <div class="text-dark-tp4 text-110">
                                            Solicitudes de Ayer
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3 px-2 mb-2 mb-lg-0">
                                <div class="bcard h-100 d-flex align-items-center p-3">
                                    <div>
                                        <span class="d-inline-block bgc-coral-d1 p-3 radius-round text-center border-4 brc-coral-l2">
                                            <i class="fa fa-id-card text-white text-170 w-4 h-4"></i>
                                        </span>
                                    </div>
                                    <div class="ml-3 flex-grow-1">
                                        <div class="pos-rel">
                                            <span class="text-dark-tp3 text-180">
                                                {{ $DenunciasUltimaHora }}
                                            </span>
                                        </div>
                                        <div class="text-dark-tp4 text-110">
                                            En la última hora
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3 px-2 mb-2 mb-lg-0">
                                <div class="bcard h-100 d-flex align-items-center p-3">
                                    <div>
                                        <span class="d-inline-block bgc-info-d1 p-3 radius-round text-center border-4 brc-info-l2">
                                            <i class="fa fa-id-card text-white text-170 w-4 h-4"></i>
                                        </span>
                                    </div>
                                    <div class="ml-3 flex-grow-1">
                                        <div class="pos-rel">
                                            <span class="text-dark-tp3 text-180">
                                                {{ $DenunciasMesActual }}
                                            </span>
                                        </div>
                                        <div class="text-dark-tp4 text-110">
                                            En el mes
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <!-- content -->
            @include('partials/footer')
        </div>

    @include('partials.full_modal')

    @section('script')
        <script src="{{asset('js/ace.js')}}"></script>
        <script src="{{asset('js/@page-script.js')}}"></script>
    @endsection

    @include('partials/script_footer')

    </body>

@endsection
