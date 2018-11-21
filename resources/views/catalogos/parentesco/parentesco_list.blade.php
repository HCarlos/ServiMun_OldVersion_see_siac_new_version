@extends('home')

@section('container')

@catalogo
    @slot('buttons')
        @include('shared.ui_kit.__menu_catalogo')
    @endslot
    @slot('body_catalogo')
        <div class="col-md-12">
            @include('shared.'.$catListShare)
        </div>
    @endslot
@endcatalogo

@endsection
