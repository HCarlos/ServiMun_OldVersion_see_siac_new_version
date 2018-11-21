@extends('home')

@section('container')

@home
    @slot('titulo_header',$tituloCat)
    @slot('contenido')
        <div class="col-md-8">
            <!-- Chart-->
            @card
                @slot('title_card','Nuevo')
                @slot('body_card')
                    @include('shared.code.__errors')
                    <form method="POST" action="{{ route($postNew) }}">
                        @csrf
                        @include('shared.'.$newCatShare)
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary float-right">Guardar</button>
                        </div>
                    </form>
                @endslot
            @endcard
        </div>
        <div class="col-md-4">
        </div> <!-- end col-->
    @endslot
@endhome

@endsection
