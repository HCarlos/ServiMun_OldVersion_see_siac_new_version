
<div class="form-group row mb-3">
    <label for = "estatus" class="col-md-3 col-form-label">Status</label>
    <div class="col-md-9">
        <input type="text" name="estatus" id="estatus" value="{{ old('estatus') }}" class="form-control" />
    </div>

    <label for = "dependencia_id" class="col-md-3 col-form-label">Dependencia</label>
    <div class="col-md-9">
        <select class="dependencia_id form-control select2" data-toggle="select2"  name="dependencia_id" id="dependencia_id" size="1">
            <option value="0" selected>Ninguna</option>
            @foreach($dependencia as $t)
                <option value="{{$t->id}}">{{ $t->dependencia }}</option>
            @endforeach
        </select>
    </div>

</div>


<input type="hidden" name="id" value="0" >

<hr>
