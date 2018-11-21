@extends('home')

@section('container')

@home
    @slot('titulo_header','Ver mi perfil')
    @slot('contenido')
        <div class="col-md-4">
            @include('shared.user.__user_photo_header')
        </div> <!-- end col-->

        <div class="col-md-8">
            <!-- Chart-->
            @card
                @slot('title_card',Auth::user()->FullName)
                @slot('body_card')
                    @include('shared.code.__errors')
                    <form method="POST" action="#">
                        @include('shared.user.__user_solo_lectura')
                    </form>
                @endslot
            @endcard
        </div>
    @endslot
@endhome

@endsection
