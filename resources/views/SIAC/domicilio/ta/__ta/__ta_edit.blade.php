
<div class="form-group row mb-3">
    <label for = "tipoasentamiento" class="col-md-3 col-form-label has-tipoasentamiento">Tipo Asentamiento</label>
    <div class="col-md-7">
        <input type="text" name="tipoasentamiento" id="tipoasentamiento" value="{{ old('tipoasentamiento',$items->tipoasentamiento) }}" class="form-control" />
        <span class="has-tipoasentamiento">
            <strong class="text-danger"></strong>
        </span>
    </div>
</div>
<input type="hidden" name="id" value="{{$items->id}}" >
