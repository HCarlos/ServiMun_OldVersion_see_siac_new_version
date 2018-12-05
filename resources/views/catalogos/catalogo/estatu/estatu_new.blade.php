@extends('home')

@section('container')

@home
    @slot('titulo_catalogo',$titulo_catalogo)
    @slot('titulo_header','Nuevo')
    @slot('contenido')
        <div class="col-md-8">
            @card
                @slot('title_card','')
                @slot('body_card')
                    @include('shared.code.__errors')
                    <form method="POST" action="{{ route('createEstatu') }}">
                        @csrf
                        @include('shared.catalogo.estatu.__estatu_new')
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
