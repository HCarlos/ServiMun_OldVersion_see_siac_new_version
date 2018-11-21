
<div class="form-group has-error row mb-3">
    <label for = "lstRegFis" class="col-md-2 col-form-label">RFC's</label>
    <div class="col-md-8">
        <select class="lstRegFis form-control select2" data-toggle="select2"  name="lstRegFis" id="lstRegFis" size="1">
            @foreach($lstRegFis as $t)
                <option value="{{$t->id}}">{{ $t->razon_social.' '.$t->rfc }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group has-error row mb-3">
    <label for = "predeterminado" class="col-md-2 col-form-label">Default?</label>
    <div class="col-md-8">
        <input type="checkbox" data-switch="warning" class="custom-control-input" id="predeterminado" name="predeterminado" value="false">
        <label for="predeterminado" data-on-label="Si" data-off-label="No" ></label>
    </div>
</div>

<input type="hidden" name="id" value="{{$item->id}}" >
