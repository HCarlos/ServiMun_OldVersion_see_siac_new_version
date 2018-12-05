@extends('home')

@section('container')

@home
    @slot('titulo_catalogo',$titulo_catalogo)
    @slot('titulo_header','Perfil')
    @slot('contenido')
        <div class="col-md-4">
            @include('shared.catalogo.user.__user_photo_header')
        </div> <!-- end col-->

        <div class="col-md-8">
            <!-- Chart-->
            @card
                @slot('title_card',$user->FullName)
                @slot('body_card')
                    @include('shared.code.__errors')
                    <form method="POST" action="{{ route('EditUser') }}">
                        @csrf
                        {{method_field('PUT')}}
                        @include('shared.catalogo.user.__user_edit')
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary float-right">Guardar</button>
                        </div>
                    </form>
                @endslot
            @endcard
        </div>
    @endslot
@endhome

@endsection
