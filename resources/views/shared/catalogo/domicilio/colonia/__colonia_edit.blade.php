
<div class="form-group row mb-1">
    <label for = "colonia" class="col-md-3 col-form-label">Colonia</label>
    <div class="col-md-9">
        <input type="text" name="colonia" id="colonia" value="{{ old('colonia',$items->colonia) }}" class="form-control" />
    </div>
</div>
<div class="form-group row mb-1">
    <label for = "latitud" class="col-md-3 col-form-label">Latitud</label>
    <div class="col-md-7">
        <input type="text" name="latitud" id="latitud" value="{{ old('latitud',$items->latitud) }}" class="form-control" pattern="^-?\d{1,3}\.\d+"/>
    </div>
    <label for = "longitud" class="col-md-3 col-form-label">Longitud</label>
    <div class="col-md-7">
        <input type="text" name="longitud" id="longitud" value="{{ old('longitud',$items->longitud) }}" class="form-control" pattern="^-?\d{1,3}\.\d+$"/>
    </div>
    <label for = "altitud" class="col-md-3 col-form-label">Altitud</label>
    <div class="col-md-7">
        <input type="text" name="altitud" id="altitud" value="{{ old('altitud',$items->altitud) }}" class="form-control" pattern="^[-+]?[0-9]*[.,]?[0-9]+$"/>
    </div>
</div>

<div class="form-group row mb-1">
    <label for = "codigo" class="col-md-3 col-form-label">Zona Postal</label>
    <div class="col-md-7">
        <input type="text" name="codigo" id="codigo" value="{{ old('codigo',$items->codigoPostal->codigo) }}" class="form-control" disabled/>
    </div>
    <label for = "codigopostal_id" class="col-md-3 col-form-label">CP</label>
    <div class="col-md-7">
        <select class="codigopostal_id form-control select2" data-toggle="select2"  name="codigopostal_id" id="codigopostal_id" size="1">
            @foreach($codigospostales as $t)
                <option value="{{$t->id}}" @if($t->id == $items->codigopostal_id) selected @endif>{{ $t->cp }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <a href="{{route("newCodigopostal")}}" target="_blank" class="btn btn-icon btn-info " > <i class="mdi mdi-plus"></i></a>
    </div>

</div>

<div class="form-group row mb-3">
    <label for = "tipocomunidad" class="col-md-3 col-form-label">Tipo Comunidad</label>
    <div class="col-md-7">
        <input type="text" name="tipocomunidad" id="tipocomunidad" value="{{ old('tipocomunidad',$items->comunidad->tipoComunidad->tipocomunidad) }}" class="form-control" disabled/>
    </div>
    <label for = "comunidad_id" class="col-md-3 col-form-label">Comunidad</label>
    <div class="col-md-7">
        <select class="comunidad_id form-control select2" data-toggle="select2"  name="comunidad_id" id="comunidad_id" size="1">
            @foreach($comunidades as $t)
                <option value="{{$t->id}}" @if($t->id == $items->comunidad_id) selected @endif>{{ $t->comunidad }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <a href="{{route("newComunidad")}}" target="_blank" class="btn btn-icon btn-info " > <i class="mdi mdi-plus"></i></a>
    </div>
    <label for = "delegado" class="col-md-3 col-form-label">Delegado</label>
    <div class="col-md-7">
        <input type="text" name="delegado" id="delegado" value="{{ old('delegado',$items->comunidad->delegado->fullName) }}" class="form-control" disabled/>
    </div>
</div>

<input type="hidden" name="id" value="{{$items->id}}" >

<hr>
