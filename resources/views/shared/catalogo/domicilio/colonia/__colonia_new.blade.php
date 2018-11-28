
<div class="form-group row mb-3">
    <label for = "colonia" class="col-md-3 col-form-label">Colonia</label>
    <div class="col-md-9">
        <input type="text" name="colonia" id="colonia" value="{{ old('colonia') }}" class="form-control" />
    </div>
    <label for = "latitud" class="col-md-3 col-form-label">Latitud</label>
    <div class="col-md-9">
        <input type="text" name="latitud" id="latitud" value="{{ old('latitud') }}" class="form-control" pattern="^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$"/>
    </div>
    <label for = "longitud" class="col-md-3 col-form-label">Longitud</label>
    <div class="col-md-9">
        <input type="text" name="longitud" id="longitud" value="{{ old('longitud') }}" class="form-control" pattern="^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$"/>
    </div>
    <label for = "altitud" class="col-md-3 col-form-label">Altitud</label>
    <div class="col-md-9">
        <input type="text" name="altitud" id="altitud" value="{{ old('altitud') }}" class="form-control" pattern="^[-+]?[0-9]*[.,]?[0-9]+$"/>
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "codigopostal_id" class="col-md-3 col-form-label">CP</label>
    <div class="col-md-9">
        <select class="codigopostal_id form-control select2" data-toggle="select2"  name="codigopostal_id" id="codigopostal_id" size="1">
            @foreach($codigospostales as $t)
                <option value="{{$t->id}}" {{ old('codigopostal_id') == $t->id ? ' selected ':''}} >{{ $t->cp }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "comunidad_id" class="col-md-3 col-form-label">Comunidad</label>
    <div class="col-md-9">
        <select class="comunidad_id form-control select2" data-toggle="select2"  name="comunidad_id" id="comunidad_id" size="1">
            @foreach($comunidades as $t)
                <option value="{{$t->id}}" {{ old('comunidad_id') == $t->id ? ' selected ':''}} >{{ $t->comunidad }}</option>
            @endforeach
        </select>
    </div>
</div>

<input type="hidden" name="id" value="0" >

<hr>
