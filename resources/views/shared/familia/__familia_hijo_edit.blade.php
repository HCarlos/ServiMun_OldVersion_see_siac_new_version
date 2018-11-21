
<div class="form-group has-error row mb-3">
    <label for = "lstHijo" class="col-md-2 col-form-label">Alumnos</label>
    <div class="col-md-8">
        <select class="lstHijo form-control select2" data-toggle="select2"  name="lstHijo" id="lstHijo" size="1">
            @foreach($lstHijo as $t)
                <option value="{{$t->id}}">{{ $t->fullname.' '.$t->username }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group has-error row mb-3">
    <label for = "lstViveCon" class="col-md-2 col-form-label">Vive Con</label>
    <div class="col-md-8">
        <select class="lstViveCon form-control select2" data-toggle="select2"  name="lstViveCon" id="lstViveCon" size="1">
            @foreach($lstViveCon->padres as $t)
                <option value="{{$t->id}}">{{ $t->fullname.' '.$t->username }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group has-error row mb-3">
    <label for = "is_menor" class="col-md-2 col-form-label">Es el menor?</label>
    <div class="col-md-8">
        <div class="col-md-8">
            <input type="checkbox" data-switch="warning" class="custom-control-input" id="is_menor" name="is_menor" value="false">
            <label for="is_menor" data-on-label="Si" data-off-label="No" ></label>
        </div>
    </div>
</div>


<input type="hidden" name="id" value="{{$item->id}}" >
