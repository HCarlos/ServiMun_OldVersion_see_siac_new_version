
<div class="form-group row mb-3">
    <label for = "comunidad" class="col-md-3 col-form-label">Comunidad</label>
    <div class="col-md-9">
        <input type="text" name="comunidad" id="comunidad" value="{{ old('comunidad',$items->comunidad) }}" class="form-control" />
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "delegado_id" class="col-md-3 col-form-label">Delegado</label>
    <div class="col-md-9">
        <select class="delegado_id form-control select2" data-toggle="select2"  name="delegado_id" id="delegado_id" size="1">
            @foreach($delegados as $t)
                <option value="{{$t->id}}" @if($t->id == $items->delegado_id) selected @endif>{{ $t->fullName }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "tipocomunidad_id" class="col-md-3 col-form-label">Tipo Comunidad</label>
    <div class="col-md-9">
        <select class="tipocomunidad_id form-control select2" data-toggle="select2"  name="tipocomunidad_id" id="tipocomunidad_id" size="1">
            @foreach($tipocomunidades as $t)
                <option value="{{$t->id}}" @if($t->id == $items->tipocomunidad_id) selected @endif>{{ $t->tipocomunidad }}</option>
            @endforeach
        </select>
    </div>
</div>

<input type="hidden" name="id" value="{{$items->id}}" >

<hr>
