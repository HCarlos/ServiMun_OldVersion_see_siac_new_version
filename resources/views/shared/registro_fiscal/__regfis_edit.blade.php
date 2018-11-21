<div class="form-group row mb-3">
    <label for = "razon_social" class="col-md-3 col-form-label">Razón Social</label>
    <div class="col-md-9">
        <input type="text" name="razon_social" id="razon_social" value="{{ old('razon_social',$items->razon_social) }}" class="form-control" required />
    </div>
</div>
<div class="form-group row mb-3">
    <label for = "rfc" class="col-md-3 col-form-label">RFC</label>
    <div class="col-md-9">
        <input type="text" name="rfc" id="rfc" value="{{ old('rfc',$items->rfc) }}" class="form-control" pattern="^[A-ZÑ&]{3,4}\d{6}(?:[A-Z\d]{3})?$" required />
    </div>
</div>    
<div class="form-group row mb-3">
    <label for = "calle" class="col-md-3 col-form-label">Calle</label>
    <div class="col-md-9">
        <input type="text" name="calle" id="calle" value="{{ old('calle',$items->calle) }}" class="form-control" />
    </div>
    <label for = "num_ext" class="col-md-3 col-form-label">Num Ext</label>
    <div class="col-md-9">
        <input type="text" name="num_ext" id="num_ext" value="{{ old('num_ext',$items->num_ext) }}" class="form-control" />
    </div>
    <label for = "num_int" class="col-md-3 col-form-label">Num Int</label>
    <div class="col-md-9">
        <input type="text" name="num_int" id="num_int" value="{{ old('num_int',$items->num_int) }}" class="form-control" />
    </div>
    <label for = "colonia" class="col-md-3 col-form-label">Colonia</label>
    <div class="col-md-9">
        <input type="text" name="colonia" id="colonia" value="{{ old('colonia',$items->colonia) }}" class="form-control" />
    </div>
    <label for = "localidad" class="col-md-3 col-form-label">Localidad</label>
    <div class="col-md-9">
        <input type="text" name="localidad" id="localidad" value="{{ old('localidad',$items->localidad) }}" class="form-control" />
    </div>
    <label for = "municipio" class="col-md-3 col-form-label">Municipio</label>
    <div class="col-md-9">
        <input type="text" name="municipio" id="municipio" value="{{ old('municipio',$items->municipio) }}" class="form-control" />
    </div>
    <label for = "estado" class="col-md-3 col-form-label">Estado</label>
    <div class="col-md-9">
        <input type="text" name="estado" id="estado" value="{{ old('estado',$items->estado) }}" class="form-control" />
    </div>
    <label for = "pais" class="col-md-3 col-form-label">País</label>
    <div class="col-md-9">
        <input type="text" name="pais" id="pais" value="{{ old('pais',$items->pais) }}" class="form-control" />
    </div>
    <label for = "cp" class="col-md-3 col-form-label">CP</label>
    <div class="col-md-9">
        <input type="text" name="cp" id="cp" value="{{ old('cp',$items->cp) }}" class="form-control" />
    </div>
    <label for = "emails" class="col-md-3 col-form-label">Emails</label>
    <div class="col-md-9">
        <input type="text" name="emails" id="emails" value="{{ old('emails',$items->emails) }}" class="form-control" />
    </div>
    <label for = "ps_id" class="col-md-3 col-form-label">PS ID</label>
    <div class="col-md-9">
        <input type="text" name="ps_id" id="ps_id" value="{{ old('ps_id',$items->ps_id) }}" class="form-control" />
    </div>
</div>

<input type="hidden" name="id" value="{{$items->id}}" >
<hr>
