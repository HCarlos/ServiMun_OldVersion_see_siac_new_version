@extends('home')

@section('container')

@home
    @slot('titulo_header','Nuev(@)')
    @slot('contenido')
        <div class="col-md-8">
            @card
                @slot('title_card','')
                @slot('body_card')
                    @include('shared.code.__errors')
                    <form method="POST" action="{{ route('createUbicacion') }}">
                        @csrf
                        @include('shared.catalogo.domicilio.ubicacion.__ubicacion_new')
                        @include('shared.ui_kit.__button_form_normal')
                    </form>
                @endslot
            @endcard
        </div>
    @endslot
@endhome

@endsection
