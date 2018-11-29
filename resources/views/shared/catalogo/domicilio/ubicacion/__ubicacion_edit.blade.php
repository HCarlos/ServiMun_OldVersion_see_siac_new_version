
<div class="form-group row mb-3">
    <label for = "calle_id" class="col-md-3 col-form-label">Calle</label>
    <div class="col-md-9">
        <select class="calle_id form-control select2" data-toggle="select2"  name="calle_id" id="calle_id" size="1">
            @foreach($calles as $t)
                <option value="{{$t->id}}" @if($t->id == $items->calle_id) selected @endif>{{ $t->calle }}</option>
            @endforeach
        </select>
    </div>
    <label for = "num_ext" class="col-md-3 col-form-label">Núm. Exterior</label>
    <div class="col-md-9">
        <input type="text" name="num_ext" id="num_ext" value="{{ old('num_ext',$items->num_ext) }}" class="form-control" />
    </div>
    <label for = "num_int" class="col-md-3 col-form-label">Núm. Interior</label>
    <div class="col-md-9">
        <input type="text" name="num_int" id="num_int" value="{{ old('num_int',$items->num_int) }}" class="form-control" />
    </div>
    <label for = "colonia_id" class="col-md-3 col-form-label">Colonia</label>
    <div class="col-md-9">
        <select class="colonia_id form-control select2" data-toggle="select2"  name="colonia_id" id="colonia_id" size="1">
            @foreach($colonias as $t)
                <option value="{{$t->id}}" @if($t->id == $items->colonia_id) selected @endif>{{ $t->colonia }}</option>
            @endforeach
        </select>
    </div>
    <label for = "localidad_id" class="col-md-3 col-form-label">Localidad</label>
    <div class="col-md-9">
        <select class="localidad_id form-control select2" data-toggle="select2"  name="localidad_id" id="localidad_id" size="1">
            @foreach($localidades as $t)
                <option value="{{$t->id}}" @if($t->id == $items->localidad_id) selected @endif>{{ $t->localidad }}</option>
            @endforeach
        </select>
    </div>
    <label for = "ciudad_id" class="col-md-3 col-form-label">Ciudad</label>
    <div class="col-md-9">
        <select class="ciudad_id form-control select2" data-toggle="select2"  name="ciudad_id" id="ciudad_id" size="1">
            @foreach($ciudades as $t)
                <option value="{{$t->id}}" @if($t->id == $items->ciudad_id) selected @endif>{{ $t->ciudad }}</option>
            @endforeach
        </select>
    </div>
    <label for = "municipio_id" class="col-md-3 col-form-label">Municipio</label>
    <div class="col-md-9">
        <select class="municipio_id form-control select2" data-toggle="select2"  name="municipio_id" id="municipio_id" size="1">
            @foreach($municipios as $t)
                <option value="{{$t->id}}" @if($t->id == $items->municipio_id) selected @endif>{{ $t->municipio }}</option>
            @endforeach
        </select>
    </div>
    <label for = "estado_id" class="col-md-3 col-form-label">Estado</label>
    <div class="col-md-9">
        <select class="estado_id form-control select2" data-toggle="select2"  name="estado_id" id="estado_id" size="1">
            @foreach($estados as $t)
                <option value="{{$t->id}}" @if($t->id == $items->estado_id) selected @endif>{{ $t->estado }}</option>
            @endforeach
        </select>
    </div>
    <label for = "codigopostal_id" class="col-md-3 col-form-label">CP</label>
    <div class="col-md-9">
        <select class="codigopostal_id form-control select2" data-toggle="select2"  name="codigopostal_id" id="codigopostal_id" size="1">
            @foreach($codigospostales as $t)
                <option value="{{$t->id}}" @if($t->id == $items->codigopostal_id) selected @endif>{{ $t->cp }}</option>
            @endforeach
        </select>
    </div>
    <label for = "latitud" class="col-md-3 col-form-label">Latitud</label>
    <div class="col-md-9">
        <input type="text" name="latitud" id="latitud" value="{{ old('latitud',$items->latitud) }}" class="form-control" pattern="^-?\d{1,3}\.\d+"/>
    </div>
    <label for = "longitud" class="col-md-3 col-form-label">Longitud</label>
    <div class="col-md-9">
        <input type="text" name="longitud" id="longitud" value="{{ old('longitud',$items->longitud) }}" class="form-control" pattern="^-?\d{1,3}\.\d+$"/>
    </div>
</div>

<input type="hidden" name="id" value="{{$items->id}}" >

<hr>
