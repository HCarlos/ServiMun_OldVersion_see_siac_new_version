@extends('home')

@section('container')

@denunciaContainer
    @slot('titulo_catalogo',$titulo_catalogo)
    @slot('titulo_header','Nueva')
    @slot('contenido')
            @card
                @slot('title_card','')
                @slot('body_card')
                    @include('shared.code.__errors')
                    @include('shared.search.__search_denuncia_adress_list')
                    <form method="POST" action="{{ route('createUbicacion') }}">
                        @csrf
                        @include('shared.denuncia.denuncia.__denuncia_new')
                        @buttonsFormDenuncia
                            @slot('msgLeft',' ')
                        @endbuttonsFormDenuncia
                    </form>
                @endslot
            @endcard
    @endslot
@enddenunciaContainer

@endsection
