@extends('home')

@section('container')

@home
    @slot('titulo_catalogo',$titulo_catalogo)
    @slot('titulo_header','Folio: '. $items->id)
    @slot('contenido')
            @card
                @slot('title_card','')
                @slot('body_card')
                    @include('shared.code.__errors')
                    <form method="POST" action="{{ route('updateDenuncia') }}">
                        @csrf
                        {{method_field('PUT')}}
                        @include('shared.denuncia.denuncia.__denuncia_edit')
                        @buttonsFormDenuncia
                            @slot('msgLeft',' ')
                        @endbuttonsFormDenuncia
                    </form>
                @endslot
            @endcard
    @endslot
@endhome

@endsection
