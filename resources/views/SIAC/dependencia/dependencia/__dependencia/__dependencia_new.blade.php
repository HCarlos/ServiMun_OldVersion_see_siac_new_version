
<div class="form-group row mb-1">
    <label for = "dependencia" class="col-md-3 col-form-label has-dependencia">Dependencia</label>
    <div class="col-md-9">
        <input type="text" name="dependencia" id="dependencia" value="{{ old('dependencia') }}" class="form-control" />
        <span class="has-dependencia">
            <strong class="text-danger"></strong>
        </span>
    </div>
</div>
<div class="form-group row mb-1">
    <label for = "abreviatura" class="col-md-3 col-form-label has-abreviatura">Abreviatura</label>
    <div class="col-md-9">
        <input type="text" name="abreviatura" id="abreviatura" value="{{ old('abreviatura') }}" class="form-control" />
        <span class="has-abreviatura">
            <strong class="text-danger"></strong>
        </span>
    </div>
</div>
<div class="form-group row mb-1">
    <label for = "class_css" class="col-md-3 col-form-label">Clase CSS</label>
    <div class="col-md-9">
        <input type="text" name="class_css" id="class_css" value="{{ old('class_css') }}" class="form-control" />
    </div>
</div>
<div class="form-group row mb-1">
    <label for = "visible_internet" class="col-md-3 col-form-label">Visible en Internet</label>
    <div class="col-md-9">
        {{ Form::select('visible_internet', array('1'=>'Si', '0'=>'No'), old('visible_internet'), ['id' => 'visible_internet','class' => 'form-control']) }}
    </div>
</div>
<div class="form-group row mb-1">
    <label for = "is_areas" class="col-md-3 col-form-label">Es un Área</label>
    <div class="col-md-9">
        {{ Form::select('is_areas', array('1'=>'SI', '0'=>'NO'), old('is_areas'), ['id' => 'is_areas','class' => 'form-control']) }}
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "jefe_id" class="col-md-3 col-form-label">Jefe</label>
    <div class="col-md-9">
        <select class="jefe_id form-control select2" data-toggle="select2"  name="jefe_id" id="jefe_id" size="1">
            @foreach($jefes as $t)
                <option value="{{$t->id}}">{{ $t->fullname.' '.$t->username }}</option>
            @endforeach
        </select>
    </div>
</div>

<input type="hidden" name="id" value="0" >

<hr>
