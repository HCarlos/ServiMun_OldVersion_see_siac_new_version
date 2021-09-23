@extends(Auth::user()->Home)

@section('container')

@component('components.asignaciones')

    @slot('titulo_catalogo', $titulo_catalogo)
    @slot('titulo_header','')
    @slot('altoPanelIzq','asign-pnl-left')
    @slot('altoPanelCen','asign-pnl-center')
    @slot('altoPanelDer','asign-pnl-right')

    @slot('titleLeft0') {{$titleLeft0 }} @endslot
    @slot('urlAsigna') {{$urlAsigna}} @endslot
    @slot('urlElimina') {{$urlElimina}} @endslot
    @slot('urlRegresa') {{$urlRegresa}} @endslot

    @slot('list0')
        {{ Form::select('listEle', $listEle0, '', ['multiple' => 'multiple','class'=>'listEle form-control asign-lstEle0']) }}
    @endslot
    @slot('countListEle') {{ $listEle0->count() }} @endslot
    @slot('usuario0')
        @slot('titleUsuario0') {{$titleUsuario0}} @endslot
        <select class="listTarget form-control select2" data-toggle="select2" name="listTarget" id="{{$urlRegresa}}" size="1">
            @foreach($listTarget0 as $t)
                <option value="{{$t->id}}"{{$Id == $t->id ? ' selected':''}}>{{ $t->FullName.' '.$t->username }}</option>
            @endforeach
        </select>
    @endslot
    @slot('Asign0')
        @slot('titleAsign0') {{$titleAsign0}} @endslot
        {{ Form::select('lstAsigns', $lstAsigns0, '', ['multiple' => 'multiple', 'class'=>'lstAsigns form-control asign-lstAsigns0']) }}
    @endslot
    @slot('countAsign0') {{ $lstAsigns0->count() }} @endslot

@endcomponent

@endsection
