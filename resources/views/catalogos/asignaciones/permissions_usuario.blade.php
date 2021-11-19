@extends(Auth::user()->Home)

@section('container')

@component('components.asignacionesV2')

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
        {!! Form::text('search_autocomplete_user', $users->fullName.' - '.$users->curp, array('placeholder' => 'Buscar usuario...','class' => 'form-control search_autocomplete_user','id'=> $urlRegresa )) !!}
        <input type="hidden" id="listTarget" name="listTarget" class="listTarget" value="{{$users->id}}">
        <input type="hidden" id="getItems" name="getItems" class="getItems" value="{{$getItems}}">
    @endslot
    @slot('Asign0')
        @slot('titleAsign0') {{$titleAsign0}} @endslot
        {{ Form::select('lstAsigns', $lstAsigns0, '', ['multiple' => 'multiple', 'id' => 'lstAsigns', 'class'=>'lstAsigns form-control asign-lstAsigns0']) }}
    @endslot
    @slot('countAsign0') {{ $lstAsigns0->count() }} @endslot

@endcomponent

@endsection
