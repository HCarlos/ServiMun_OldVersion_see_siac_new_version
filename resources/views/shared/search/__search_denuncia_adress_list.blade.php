
@isset($searchAdressDenuncia)
<form method="get" action="{{ route($searchAdressDenuncia) }}" class="form-inline frmGetItems">
    <div class="app-search">
        <div class="input-group">
            <input type="search" name="search" id="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar...">
            <span class="mdi mdi-magnify"></span>
            <div class="input-group-append">
                <button class="btn btn-sm btn-primary" type="submit">Buscar</button>
            </div>
        </div>
    </div>
    {{--{!! Form::hidden('items', json_encode($items)) !!}--}}
</form>
@endisset
