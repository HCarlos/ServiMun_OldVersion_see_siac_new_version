<div class="form-group row mb-3">
    <label for = "familia" class="col-md-2 col-form-label">Familia</label>
    <div class="col-md-10">
        <input type="text" name="familia" id="familia" value="{{ old('familia',$items->familia) }}" class="form-control"  />
    </div>
</div>
<div class="form-group row mb-3">
    <label for = "emails" class="col-md-2 col-form-label">Emails</label>
    <div class="col-md-10">
        <input type="text" name="emails" id="emails" value="{{ old('emails',$items->emails) }}" class="form-control"  />
    </div>
</div>
<div class="form-group row mb-3">
    <label for = "ps_id" class="col-md-2 col-form-label">PS ID</label>
    <div class="col-md-10">
        <input type="text" name="ps_id" id="ps_id" value="{{ old('ps_id',$items->ps_id) }}" class="form-control"  />
    </div>
</div>

<input type="hidden" name="id" value="{{$items->id}}" >

<hr>
