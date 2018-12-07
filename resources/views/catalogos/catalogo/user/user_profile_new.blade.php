@extends('home')

@section('container')

@home
    @slot('titulo_catalogo',$titulo_catalogo)
    @slot('titulo_header','Usuario')
    @slot('contenido')
        <div class="col-md-4">
        </div> <!-- end col-->

        <div class="col-md-8">
            <!-- Chart-->
            @card
                @slot('title_card','')
                @slot('body_card')
                    @include('shared.code.__errors')
                    <form method="POST" action="{{ route('createUser') }}">
                        @csrf
                        @include('shared.catalogo.user.__user_new')
                        @include('shared.ui_kit.__button_form_normal')
                    </form>
                @endslot
            @endcard
        </div>
    @endslot
@endhome

@endsection
