
    <div class="form-group has-error row mb-3">
        <label for = "lstUsers" class="col-md-2 col-form-label">Usuario</label>
        <div class="col-md-8">
        <select class="lstUsers form-control select2" data-toggle="select2" name="lstUsers" id="lstUsers" size="1">
            @foreach($lstUsers as $t)
                <option value="{{$t->id}}">{{ $t->ap_paterno.' '.$t->ap_materno.' '.$t->nombre.' '.$t->username }}</option>
            @endforeach
        </select>
        </div>
    </div>

    <div class="form-group has-error row mb-3">
        <label for = "lstParents" class="col-md-2 col-form-label">Parentesco</label>
        <div class="col-md-8">
        <select class="lstParents form-control select2" data-toggle="select2"  name="lstParents" id="lstParents" size="1">
            @foreach($lstParents as $t)
                <option value="{{$t->id}}">{{ $t->parentesco }}</option>
            @endforeach
        </select>
        </div>
    </div>


<input type="hidden" name="familia_id" value="{{$item->id}}" >
