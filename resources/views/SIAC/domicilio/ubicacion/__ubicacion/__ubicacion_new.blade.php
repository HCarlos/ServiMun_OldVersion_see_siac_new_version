
<div class="form-group row mb-1">
    <label for = "calle_id" class="col-md-3 col-form-label">Calle</label>
    <div class="col-md-7">
        <select class="calle_id form-control select2" data-toggle="select2"  name="calle_id" id="calle_id" size="1">
            @foreach($calles as $t)
                <option value="{{$t->id}}" {{ old('calle_id') == $t->id ? ' selected ':''}}>{{ $t->calle }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <a href="{{route("newCalle")}}" target="_blank" class="btn btn-icon btn-info " > <i class="mdi mdi-plus"></i></a>
{{--        <a href="{{ route("newCalleV2") }}" id="{{ route("newCalleV2") }}" class="btn btn-icon btn-info btnFullModal" data-toggle="modal" data-target="#modalFull" title="Agregar Calle" >--}}
{{--            <i class="mdi mdi-plus"></i>--}}
{{--        </a>--}}

    </div>
</div>
<div class="form-group row mb-1">
    <label for = "num_ext" class="col-md-3 col-form-label has-num_ext">Núm. Exterior</label>
    <div class="col-md-7">
        <input type="text" name="num_ext" id="num_ext" value="{{ old('num_ext') }}" class="form-control" />
        <span class="has-num_ext">
            <strong class="text-danger"></strong>
        </span>
    </div>
</div>
<div class="form-group row mb-1">
    <label for = "num_int" class="col-md-3 col-form-label">Núm. Interior</label>
    <div class="col-md-7">
        <input type="text" name="num_int" id="num_int" value="{{ old('num_int') }}" class="form-control" />
    </div>
</div>
<div class="form-group row mb-1">
    <label for = "colonia_id" class="col-md-3 col-form-label">Colonia</label>
    <div class="col-md-7">
        <select class="colonia_id form-control select2" data-toggle="select2" name="colonia_id" id="colonia_id" size="1">
            @foreach($colonias as $t)
                <option value="{{$t->id}}" {{ old('colonia_id') == $t->id ? ' selected ':''}}>{{ $t->colonia }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <a href="{{route("newColonia")}}" target="_blank" class="btn btn-icon btn-info " > <i class="mdi mdi-plus"></i></a>
    </div>

</div>
{{--<div class="form-group row mb-1">--}}
    {{--<label for = "comunidad_id" class="col-md-3 col-form-label">Comunidad</label>--}}
    {{--<div class="col-md-7">--}}
        {{--<select class="comunidad_id form-control " name="comunidad_id" id="comunidad_id" size="1">--}}
            {{--@foreach($comunidades as $t)--}}
                {{--<option value="{{$t->id}}" {{ old('comunidad_id') == $t->id ? ' selected ':''}}>{{ $t->comunidad }}</option>--}}
            {{--@endforeach--}}
        {{--</select>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group row mb-1">--}}
    {{--<label for = "codigopostal_id" class="col-md-3 col-form-label">CP</label>--}}
    {{--<div class="col-md-7">--}}
        {{--<select class="codigopostal_id form-control " name="codigopostal_id" id="codigopostal_id" size="1">--}}
            {{--@foreach($codigospostales as $t)--}}
                {{--<option value="{{$t->id}}" {{ old('codigopostal_id') == $t->id ? ' selected ':''}}>{{ $t->cp }}</option>--}}
            {{--@endforeach--}}
        {{--</select>--}}
    {{--</div>--}}
    {{--<div class="col-md-2">--}}
        {{--<a href="{{route("newCodigopostal")}}" target="_blank" class="btn btn-icon btn-info " > <i class="mdi mdi-plus"></i></a>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group row mb-1">--}}
    {{--<label for = "latitud" class="col-md-3 col-form-label">Latitud</label>--}}
    {{--<div class="col-md-9">--}}
        {{--<input type="text" name="latitud" id="latitud" value="{{ old('latitud') }}" class="form-control" pattern="^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$"/>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group row mb-1">--}}
    {{--<label for = "longitud" class="col-md-3 col-form-label">Longitud</label>--}}
    {{--<div class="col-md-9">--}}
        {{--<input type="text" name="longitud" id="longitud" value="{{ old('longitud') }}" class="form-control" pattern="^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$"/>--}}
    {{--</div>--}}
{{--</div>--}}
<input type="hidden" name="id" value="0" >
<input type="hidden" name="comun_id" id="comun_id" value="0" >

<hr>
