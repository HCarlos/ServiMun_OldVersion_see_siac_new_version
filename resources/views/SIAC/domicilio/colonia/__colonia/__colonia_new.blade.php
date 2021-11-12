
<div class="form-group row mb-1">
    <label for = "colonia" class="col-md-3 col-form-label has-colonia">Colonia</label>
    <div class="col-md-9">
        <input type="text" name="colonia" id="colonia" value="{{ old('colonia') }}" class="form-control" />
        <span class="has-colonia">
            <strong class="text-danger"></strong>
        </span>
    </div>
</div>
<div class="form-group row mb-3">
    <label for = "latitud" class="col-md-3 col-form-label">Latitud</label>
    <div class="col-md-7">
        <input type="text" name="latitud" id="latitud" value="{{ old('latitud') }}" class="form-control" pattern="^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$"/>
    </div>
    <label for = "longitud" class="col-md-3 col-form-label">Longitud</label>
    <div class="col-md-7">
        <input type="text" name="longitud" id="longitud" value="{{ old('longitud') }}" class="form-control" pattern="^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$"/>
    </div>
    <label for = "altitud" class="col-md-3 col-form-label">Altitud</label>
    <div class="col-md-7">
        <input type="text" name="altitud" id="altitud" value="{{ old('altitud') }}" class="form-control" pattern="^[-+]?[0-9]*[.,]?[0-9]+$"/>
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "codigopostal_id" class="col-md-3 col-form-label has-codigopostal_id">CP</label>
    <div class="col-md-7">
        <select class="codigopostal_id form-control select2" data-toggle="select2"  name="codigopostal_id" id="codigopostal_id" size="1">
            @foreach($codigospostales as $t)
                <option value="{{$t->id}}" {{ old('codigopostal_id') == $t->id ? ' selected ':''}} >{{ $t->cp }}</option>
            @endforeach
        </select>
        <span class="has-codigopostal_id">
            <strong class="text-danger"></strong>
        </span>
    </div>
    <div class="col-md-2">
{{--        <a href="{{route("newCodigopostal")}}" target="_blank" class="btn btn-icon btn-info " > <i class="mdi mdi-plus"></i></a>--}}
        <a href="{{ route("newCodigopostalV2") }}" id="{{ route("newCodigopostalV2") }}" class="btn btn-icon btn-info btnFullModal" data-toggle="modal" data-target="#modalFull" title="Agregar Comunidad" >
            <i class="mdi mdi-plus"></i>
        </a>
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "comunidad_id" class="col-md-3 col-form-label has-comunidad_id">Comunidad</label>
    <div class="col-md-7">
        <select class="comunidad_id form-control select2" data-toggle="select2"  name="comunidad_id" id="comunidad_id" size="1">
            @foreach($comunidades as $t)
                <option value="{{$t->id}}" {{ old('comunidad_id') == $t->id ? ' selected ':''}} >{{ $t->comunidad }}</option>
            @endforeach
        </select>
        <span class="has-comunidad_id">
            <strong class="text-danger"></strong>
        </span>
    </div>
    <div class="col-md-2">
{{--        <a href="{{route("newComunidad")}}" target="_blank" class="btn btn-icon btn-info " > <i class="mdi mdi-plus"></i></a>--}}
        <a href="{{ route("newComunidadV2") }}" id="{{ route("newComunidadV2") }}" class="btn btn-icon btn-info btnFullModal" data-toggle="modal" data-target="#modalFull" title="Agregar Comunidad" >
            <i class="mdi mdi-plus"></i>
        </a>
    </div>
</div>

<input type="hidden" name="id" value="0" >

<hr>
