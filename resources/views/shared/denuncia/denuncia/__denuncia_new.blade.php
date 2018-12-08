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
                <label for = "search_autocomplete" class="col-md-3 col-form-label">Buscar</label>
                <div class="col-md-9">
                    {!! Form::text('search_autocomplete', null, array('placeholder' => 'Buscar ubicación','class' => 'form-control','id'=>'search_autocomplete')) !!}
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "calle" class="col-md-3 col-form-label">Calle</label>
                <div class="col-md-9">
                    <input type="text" name="calle" id="calle" value="{{ old('calle') }}" class="form-control" disabled/>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "colonia" class="col-md-3 col-form-label">Colonia</label>
                <div class="col-md-9">
                    <input type="text" name="colonia" id="colonia" value="{{ old('colonia') }}" class="form-control" disabled/>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "localidad" class="col-md-3 col-form-label">Comunidad</label>
                <div class="col-md-9">
                    <input type="text" name="localidad" id="localidad" value="{{ old('localidad') }}" class="form-control" disabled/>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "ciudad" class="col-md-3 col-form-label">Ciudad</label>
                <div class="col-md-9">
                    <input type="text" name="ciudad" id="ciudad" value="{{ old('ciudad') }}" class="form-control" disabled/>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "municipio" class="col-md-3 col-form-label">Municipio</label>
                <div class="col-md-9">
                    <input type="text" name="municipio" id="municipio" value="{{ old('municipio') }}" class="form-control" disabled/>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "estado" class="col-md-3 col-form-label">Estado</label>
                <div class="col-md-9">
                    <input type="text" name="estado" id="estado" value="{{ old('estado') }}" class="form-control" disabled/>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for = "cp" class="col-md-3 col-form-label">CP</label>
                <div class="col-md-9">
                    <input type="text" name="cp" id="cp" value="{{ old('cp') }}" class="form-control" disabled/>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="id" value="0" >
<input type="hidden" name="ubicacion_id" id="ubicacion_id" value="0" >
<hr>
