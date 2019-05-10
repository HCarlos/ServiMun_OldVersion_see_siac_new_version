@extends('home-ciudadano')

@section('container')

    @catalogo
    @slot('buttons')
        @include('shared.ui_kit.__menu_denuncia_ciudadana')
    @endslot
    @slot('body_catalogo')
        @include('shared.denuncia.denuncia_ciudadana.__denuncia_ciudadana_list')
    @endslot
    @endcatalogo

@endsection

