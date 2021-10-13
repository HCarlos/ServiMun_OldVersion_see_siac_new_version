@extends(Auth::user()->Home)

@section('container')

@component('components.home')
    @slot('titulo_catalogo',$titulo_catalogo)
    @slot('titulo_header','Cambiar mi password')
    @slot('contenido')
        <div class="col-md-4">
            @include('shared.catalogo.user.__user_photo_header')
        </div> <!-- end col-->

        <div class="col-md-8">
            <!-- Chart-->
            @component('components.card-sin-fondo')
                @slot('title_card',Auth::user()->FullName)
                @slot('body_card')
                    @include('shared.code.__errors')
                    <form method="POST" action="{{ route('changePasswordUser/') }}">
                        @csrf
                        {{method_field('PUT')}}
                        @include('shared.catalogo.user.__user_password_edit')
                        <div class="form-group row mb-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                @endslot
            @endcomponent
        </div>
    @endslot
@endcomponent
@endsection


