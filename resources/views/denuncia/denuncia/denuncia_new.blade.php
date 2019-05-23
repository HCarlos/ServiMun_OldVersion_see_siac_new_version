@extends(Auth::user()->Home)

@section('container')

@denunciaContainer
    @slot('contenido')
            @card
                @slot('title_card','')
                @slot('body_card')
                    @include('shared.code.__errors')
                    <form method="POST" action="{{ route('createDenuncia') }}">
                        @csrf
                        @include('shared.denuncia.denuncia.__denuncia_new')
                        @buttonsFormDenuncia
                            @slot('msgLeft',' ')
                        @endbuttonsFormDenuncia
                    </form>
                @endslot
            @endcard
    @endslot
@enddenunciaContainer

@endsection
