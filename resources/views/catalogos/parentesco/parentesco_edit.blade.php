@extends('home')

@section('container')

@home
    @slot('titulo_header',$tituloCat)
    @slot('contenido')
        <div class="col-md-8">
            <!-- Chart-->
            @card
                @slot('title_card','Datos:')
                @slot('body_card')
                    @include('shared.code.__errors')
                    <form method="POST" action="{{ route($putEdit) }}">
                        @csrf
                        {{method_field('PUT')}}
                        @include("shared.".$editCatShare)
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary float-right">Guardar</button>
                        </div>
                    </form>
                @endslot
            @endcard
        </div>
        <div class="col-md-4">
            {{--@include('shared.user.__user_photo_header')--}}
        </div> <!-- end col-->

    @endslot
@endhome

@endsection
