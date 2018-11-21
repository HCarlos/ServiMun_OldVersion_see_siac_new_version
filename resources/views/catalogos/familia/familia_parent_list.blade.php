@extends('home')

@section('container')

    @details
    @slot('buttons')
        @include('shared.ui_kit.__menu_button_modal')
    @endslot
    @slot('titleCategory',"Miembros de la Familia")
    @slot('titleDescribe')
        @isset($item)
            {{$item->familia}}
        @endisset
    @endslot
    @slot('body_catalogo')
        <div class="col-md-12">
            @include('shared.'.$catListShare)
        </div>
    @endslot
    @enddetails

@endsection
