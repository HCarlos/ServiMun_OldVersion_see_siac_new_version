<div class="form-group row mb-3">
    <label for = "parentesco" class="col-md-3 col-form-label">Parentesco</label>
    <div class="col-md-9">
        <input type="text" name="parentesco" id="parentesco" value="{{ old('parentesco',$items->parentesco) }}" class="form-control"  />
    </div>
</div>
<input type="hidden" name="id" value="{{$items->id}}" >

<hr>
