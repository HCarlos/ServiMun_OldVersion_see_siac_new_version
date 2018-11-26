
<div class="form-group row mb-3">
    <label for = "servicio" class="col-md-3 col-form-label">Servicio</label>
    <div class="col-md-9">
        <input type="text" name="servicio" id="servicio" value="{{ old('servicio') }}" class="form-control" />
    </div>
    <label for = "habilitado" class="col-md-3 col-form-label">Habilitado</label>
    <div class="col-md-9">
        {{ Form::select('habilitado', array('1'=>'Si', '0'=>'No'), old('habilitado'), ['id' => 'habilitado','class' => 'form-control']) }}
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "medida_id" class="col-md-3 col-form-label">Medida</label>
    <div class="col-md-9">
        <select class="medida_id form-control select2" data-toggle="select2"  name="medida_id" id="medida_id" size="1">
            @foreach($medidas as $t)
                <option value="{{$t->id}}">{{ $t->medida }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "subarea_id" class="col-md-3 col-form-label">Subarea</label>
    <div class="col-md-9">
        <select class="subarea_id form-control select2" data-toggle="select2"  name="subarea_id" id="subarea_id" size="1">
            @foreach($subareas as $t)
                <option value="{{$t->id}}">{{ $t->subarea }}</option>
            @endforeach
        </select>
    </div>
</div>

<input type="hidden" name="id" value="0" >

<hr>
