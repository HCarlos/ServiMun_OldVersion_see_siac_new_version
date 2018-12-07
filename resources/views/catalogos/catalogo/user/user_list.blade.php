@extends('home')

@section('container')

@catalogo
    @slot('buttons')
        @include('shared.ui_kit.__menu_catalogo')
    @endslot
    @slot('body_catalogo')
        <div class="col-md-12">
            @include('shared.denuncia.denuncia.__denuncia_list')
        </div>
    @endslot
@endcatalogo

@endsection
