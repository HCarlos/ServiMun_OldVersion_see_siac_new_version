<div class="form-row mb-1">
    <label for = "curp" class="col-md-2 col-form-label">CURP</label>
    <div class="col-md-10">
        <input type="text" name="curp" id="curp" value="{{ old('curp') }}" class="form-control" />
    </div>
</div>

<div class="form-row mb-1">
    <label for = "ciudadano" class="col-md-2 col-form-label">Nombre Completo</label>
    <div class="col-md-10">
        <input type="text" name="ciudadano" id="ciudadano" value="{{ old('ciudadano') }}" class="form-control" />
    </div>
</div>

<div class="form-row mb-1">
    <label for = "id" class="col-md-2 col-form-label">Folio / ID </label>
    <div class="col-md-10">
        <input type="text" name="id" id="id" value="{{ old('id') }}" class="form-control" />
    </div>
</div>

<div class="form-row mb-1">
        <label for="desde" class="col-md-2 col-form-label">Desde</label>
        <div class="col-md-4">
            {{ Form::date('desde', \Carbon\Carbon::now(), ['id'=>'desde','class'=>'form-control']) }}
        </div>
        <label for="hasta" class="col-md-1 col-form-label">Hasta</label>
        <div class="col-md-3">
            {{ Form::date('hasta', \Carbon\Carbon::now(), ['id'=>'hasta','class'=>'form-control']) }}
        </div>
        <div class="col-md-1 ">
            <div class="custom-control custom-checkbox mt-1 float-left">
                <input type="checkbox" class="custom-control-input" id="incluirFecha" name="incluirFecha">
                <label class="custom-control-label" for="incluirFecha">Incluir</label>
            </div>
        </div>
</div>

<div class="form-row mb-1">
    <label for = "dependencia_id" class="col-md-2 col-form-label">Dependencia</label>
    <div class="col-md-8">
        <select id="dependencia_id" name="dependencia_id" class="form-control" size="1">
            <option value="0" selected >Seleccione una Dependencia</option>
            @foreach($dependencias as $id => $valor)
                <option value="{{ $id }}">{{ $valor }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2 ">
        <div class="custom-control custom-checkbox mt-1 float-left">
            <input type="checkbox" class="custom-control-input" id="conRespuesta" name="conRespuesta">
            <label class="custom-control-label" for="conRespuesta">Con Respuesta</label>
        </div>
    </div>
</div>

<div class="form-row mb-1">
    <label for = "servicio_id" class="col-md-2 col-form-label">Servicio</label>
    <div class="col-md-10">
        <select id="servicio_id" name="servicio_id" class="form-control" size="1">
            <option value="0" selected >Seleccione un Servicio</option>
            @foreach($servicios as $id => $valor)
                <option value="{{ $id }}">{{ $valor }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row mb-1">
    <label for = "origen_id" class="col-md-2 col-form-label">Origen</label>
    <div class="col-md-10">
        <select id="origen_id" name="estatus_id" class="form-control" size="1">
            <option value="0" selected >Seleccione un Origen</option>
            @foreach($origenes as $t)
                <option value="{{ $t->id }}">{{ $t->origen }} </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row mb-1">
    <label for = "estatus_id" class="col-md-2 col-form-label">Estatus</label>
    <div class="col-md-10">
        <select id="estatus_id" name="estatus_id" class="form-control" size="1">
            <option value="0" selected >Seleccione un Estatus</option>
            @foreach($estatus as $t)
                <option value="{{ $t->id }}">{{ $t->estatus }} </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row mb-1">
    <label for = "creadopor_id" class="col-md-2 col-form-label">Creado Por:</label>
    <div class="col-md-10">
        <select id="creadopor_id" name="creadopor_id" class="form-control" size="1">
            <option value="0" selected >Seleccione un Usuario</option>
            @foreach($capturistas as $id => $valor)
                <option value="{{ $id }}">{{ $valor }}</option>
            @endforeach
        </select>
    </div>
</div>
