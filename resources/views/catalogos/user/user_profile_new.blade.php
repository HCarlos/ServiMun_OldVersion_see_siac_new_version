@extends('home')

@section('container')

@home
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
                        @include('shared.user.__user_new')
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
