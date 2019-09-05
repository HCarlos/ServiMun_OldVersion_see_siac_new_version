@extends(Auth::user()->Home)

@section('container')

@denunciaContainer
    @slot('contenido')
            @card
                @slot('title_card','')
                @slot('body_card')
                    @include('shared.code.__errors')
                    <form method="POST" action="{{ route($postNew) }}">
                        @csrf
                        @include('shared.denuncia.denuncia_dependencia_servicio.__denuncia_dependencia_servicio_edit')
                        @buttonsFormDenuncia
                            @slot('msgLeft',' ')
                        @endbuttonsFormDenuncia
                    </form>
                @endslot
            @endcard
    @endslot
@enddenunciaContainer

@endsection
