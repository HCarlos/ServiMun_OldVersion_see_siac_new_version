@isset($searchAluBeca)
    <form method="get" action="{{ route($searchAluBeca) }}" class="form-inline frmSearchInList">
        <div class="app-search">
            <div class="input-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="becas" id="beca_none" value="beca_none" {{request('becas')=='beca_none'?'checked':''}}>
                    <label class="form-check-label" for="beca_none">Nunguna</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="becas" id="beca_sep" value="beca_sep" {{request('becas')=='beca_sep'?'checked':''}}>
                    <label class="form-check-label" for="beca_sep">SEP</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="becas" id="beca_arji" value="beca_arji" {{request('becas')=='beca_arji'?'checked':''}}>
                    <label class="form-check-label" for="beca_arji">Arjí</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="becas" id="beca_spf" value="beca_spf" {{request('becas')=='beca_spf'?'checked':''}}>
                    <label class="form-check-label" for="beca_spf">SPF</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="becas" id="beca_bach" value="beca_bach" {{request('becas')=='beca_bach'?'checked':''}}>
                    <label class="form-check-label" for="beca_bach">COBATAB</label>
                </div>
            </div>
            <div class="input-group">
                <input type="search" name="search" id="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar...">
                <span class="mdi mdi-magnify"></span>
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" type="submit">Buscar</button>
                </div>
            </div>
            <input type="hidden" name="role_user" id="role_user" value="{{$role_user}}"/>
        </div>
    </form>
@endisset
