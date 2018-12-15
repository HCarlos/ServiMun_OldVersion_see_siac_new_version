@isset($searchInListDenuncia)
    <form method="get" action="{{ route($searchInListDenuncia) }}" class="form-inline frmSearchInList">
            <div class="input-group">
                <input type="search" id="search" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar...">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" type="submit">Buscar</button>
                </div>
            </div>
        <div class="input-group">
            <input type="datetime" name="fecha1" id="fecha1" />
            <input type="datetime" name="fecha2" id="fecha2" />
        </div>

        {{--@include('shared.ui_kit.___popup_roles')--}}

    </form>
@endisset
