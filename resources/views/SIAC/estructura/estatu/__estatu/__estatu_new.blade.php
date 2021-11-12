<div class="form-group row mb-1">
    <label for = "estatus" class="col-md-3 col-form-label has-estatus">Status</label>
    <div class="col-md-9">
        <input type="text" name="estatus" id="estatus" value="{{ old('estatus') }}" class="form-control" />
        <span class="has-estatus">
            <strong class="text-danger"></strong>
        </span>
    </div>
</div>
<div class="form-group row mb-1">
    <label for = "dependencia_id" class="col-md-3 col-form-label has-dependencia_id">Dependencia</label>
    <div class="col-md-9">
        <select class="dependencia_id form-control select2" data-toggle="select2"  name="dependencia_id" id="dependencia_id" size="1">
            <option value="0" selected>Ninguna</option>
            @foreach($dependencia as $t)
                <option value="{{$t->id}}">{{ $t->dependencia }}</option>
            @endforeach
        </select>
        <span class="has-dependencia_id">
            <strong class="text-danger"></strong>
        </span>
    </div>
</div>
<div class="form-group row mb-1">
    <label for = "predeterminado" class="col-md-3 col-form-label">Predeterminado</label>
    <div class="col-md-9">
        <select class="predeterminado form-control select2" name="predeterminado" id="predeterminado" size="1">
            <option value="0" selected>No</option>
            <option value="1">Si</option>
        </select>
    </div>

</div>
<input type="hidden" name="id" value="0" >
