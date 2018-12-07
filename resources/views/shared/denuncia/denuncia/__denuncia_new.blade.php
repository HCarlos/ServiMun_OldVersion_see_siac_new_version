<div class="row">
    <div class="col-md-6 ">
        <div class="grid-container">
            <div class="form-row mb-1">
                <label for = "fecha_ingreso" class="col-md-2 col-form-label">Fecha </label>
                <div class="col-md-4">
                    {{ Form::date('fecha_ingreso', \Carbon\Carbon::now(), ['id'=>'fecha_ingreso','class'=>'form-control','readonly'=>'readonly']) }}
                </div>
                <label for = "fecha_oficio_dependencia" class="col-md-2 col-form-label">F. Oficio </label>
                <div class="col-md-4">
                    {{ Form::date('fecha_oficio_dependencia', \Carbon\Carbon::now(), ['id'=>'fecha_oficio_dependencia','class'=>'form-control']) }}
                </div>
            </div>
            <div class="form-row mb-1">
                <label for = "fecha_limite" class="col-md-2 col-form-label">F. Límite </label>
                <div class="col-md-4">
                    {{ Form::date('fecha_limite', \Carbon\Carbon::now(), ['id'=>'fecha_limite','class'=>'form-control','readonly'=>'readonly']) }}
                </div>
                <label for = "fecha_ejecucion" class="col-md-2 col-form-label">F. Ejec. </label>
                <div class="col-md-4">
                    {{ Form::date('fecha_ejecucion', \Carbon\Carbon::now(), ['id'=>'fecha_ejecucion','class'=>'form-control','readonly'=>'readonly']) }}
                </div>
            </div>
            <div class="form-row mb-1">
                <label for = "oficio_envio" class="col-md-2 col-form-label">Oficio E. </label>
                <div class="col-md-10">
                    <input type="text" name="oficio_envio" id="oficio_envio" value="{{ old('oficio_envio') }}" class="form-control" />
                </div>
            </div>
            <div class="form-row mb-1">
                <label for = "descripcion" class="col-md-2 col-form-label">Denuncia </label>
                <div class="col-md-10">
                    <textarea name="descripcion" id="descripcion" value="{{ old('descripcion') }}" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-row mb-1">
                <label for = "referencia" class="col-md-2 col-form-label">Referencia </label>
                <div class="col-md-10">
                    <textarea name="referencia" id="referencia" value="{{ old('referencia') }}" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "latitud" class="col-md-2 col-form-label">Lat.</label>
                <div class="col-md-4">
                    <input type="text" name="latitud" id="latitud" value="{{ old('latitud') }}" class="form-control" />
                </div>
                <label for = "longitud" class="col-md-2 col-form-label">Long.</label>
                <div class="col-md-4">
                    <input type="text" name="longitud" id="longitud" value="{{ old('longitud') }}" class="form-control" />
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-6 ">
        <div class="grid-container">
            <div class="form-group row mb-1">
                <label for = "calle_id" class="col-md-3 col-form-label">Calle</label>
                <div class="col-md-9">
                    <select class="calle_id form-control select2" data-toggle="select2"  name="calle_id" id="calle_id" size="1">
                        @foreach($calles as $t)
                            <option value="{{$t->id}}" {{ old('calle_id') == $t->id ? ' selected ':''}}>{{ $t->calle }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "num_ext" class="col-md-3 col-form-label">Núm. Exterior</label>
                <div class="col-md-9">
                    <input type="text" name="num_ext" id="num_ext" value="{{ old('num_ext') }}" class="form-control" />
                </div>
                <label for = "num_int" class="col-md-3 col-form-label">Núm. Interior</label>
                <div class="col-md-9">
                    <input type="text" name="num_int" id="num_int" value="{{ old('num_int') }}" class="form-control" />
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "colonia_id" class="col-md-3 col-form-label">Colonia</label>
                <div class="col-md-9">
                    <select class="colonia_id form-control " name="colonia_id" id="colonia_id" size="1">
                        @foreach($colonias as $t)
                            <option value="{{$t->id}}" {{ old('colonia_id') == $t->id ? ' selected ':''}}>{{ $t->colonia }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "localidad_id" class="col-md-3 col-form-label">Localidad</label>
                <div class="col-md-9">
                    <select class="localidad_id form-control " name="localidad_id" id="localidad_id" size="1">
                        @foreach($localidades as $t)
                            <option value="{{$t->id}}" {{ old('localidad_id') == $t->id ? ' selected ':''}}>{{ $t->localidad }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "ciudad_id" class="col-md-3 col-form-label">Ciudad</label>
                <div class="col-md-9">
                    <select class="ciudad_id form-control " name="ciudad_id" id="ciudad_id" size="1">
                        @foreach($ciudades as $t)
                            <option value="{{$t->id}}" {{ old('ciudad_id') == $t->id ? ' selected ':''}}>{{ $t->ciudad }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "municipio_id" class="col-md-3 col-form-label">Municipio</label>
                <div class="col-md-9">
                    <select class="municipio_id form-control " name="municipio_id" id="municipio_id" size="1">
                        @foreach($municipios as $t)
                            <option value="{{$t->id}}" {{ old('municipio_id') == $t->id ? ' selected ':''}}>{{ $t->municipio }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "estado_id" class="col-md-3 col-form-label">Estado</label>
                <div class="col-md-9">
                    <select class="estado_id form-control " name="estado_id" id="estado_id" size="1">
                        @foreach($estados as $t)
                            <option value="{{$t->id}}" {{ old('estado_id') == $t->id ? ' selected ':''}}>{{ $t->estado }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "codigopostal_id" class="col-md-3 col-form-label">CP</label>
                <div class="col-md-9">
                    <select class="codigopostal_id form-control " name="codigopostal_id" id="codigopostal_id" size="1">
                        @foreach($codigospostales as $t)
                            <option value="{{$t->id}}" {{ old('codigopostal_id') == $t->id ? ' selected ':''}}>{{ $t->cp }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "latitud" class="col-md-3 col-form-label">Latitud</label>
                <div class="col-md-9">
                    <input type="text" name="latitud" id="latitud" value="{{ old('latitud') }}" class="form-control" pattern="^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$"/>
                </div>
                <label for = "longitud" class="col-md-3 col-form-label">Longitud</label>
                <div class="col-md-9">
                    <input type="text" name="longitud" id="longitud" value="{{ old('longitud') }}" class="form-control" pattern="^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$"/>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="id" value="0" >
<hr>
