@extends(Auth::user()->Home)

@section('container')

    @component('components.catalogo_mobile')
        {{--        @slot('buttons')--}}
        {{--            @include('shared.ui_kit.__menu_denuncia')--}}
        {{--        @endslot--}}
        @slot('body_catalogo')
            @include('SIAC.denuncia.denuncia.__denuncia.__denuncia_mobile_list')
        @endslot
    @endcomponent

@endsection

