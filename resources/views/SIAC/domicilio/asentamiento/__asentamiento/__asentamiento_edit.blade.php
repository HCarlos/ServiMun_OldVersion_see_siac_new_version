
<div class="form-group row mb-3">
    <label for = "asentamiento" class="col-md-3 col-form-label has-asentamiento">Asentamiento</label>
    <div class="col-md-7">
        <input type="text" name="asentamiento" id="asentamiento" value="{{ old('asentamiento',$items->asentamiento) }}" class="form-control" />
        <span class="has-asentamiento">
            <strong class="text-danger"></strong>
        </span>
    </div>
</div>
<input type="hidden" name="id" value="{{$items->id}}" >
