<div class="form-group row mb-3">
    <label for = "username" class="col-md-3 col-form-label">Username</label>
    <div class="col-md-9">
        <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control" />
    </div>
    <label for = "email" class="col-md-3 col-form-label">Email</label>
    <div class="col-md-9">
        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" />
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "ap_paterno" class="col-md-3 col-form-label">Paterno</label>
    <div class="col-md-9">
        <input type="text" name="ap_paterno" id="ap_paterno" value="{{ old('ap_paterno') }}" class="form-control" />
    </div>
    <label for = "ap_materno" class="col-md-3 col-form-label">Materno</label>
    <div class="col-md-9">
        <input type="text" name="ap_materno" id="ap_materno" value="{{ old('ap_materno') }}" class="form-control" />
    </div>
    <label for = "nombre" class="col-md-3 col-form-label">Nombre</label>
    <div class="col-md-9">
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="form-control" />
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "curp" class="col-md-3 col-form-label">CURP</label>
    <div class="col-md-9">
        <input type="text" name="curp" id="curp" value="{{ old('curp') }}" class="form-control" pattern="^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$" />
    </div>
    <label for = "calle" class="col-md-3 col-form-label">Calle</label>
    <div class="col-md-9">
        <input type="text" name="calle" id="calle" value="{{ old('calle') }}" class="form-control" />
    </div>
    <label for = "num_ext" class="col-md-3 col-form-label">Num Ext</label>
    <div class="col-md-9">
        <input type="text" name="num_ext" id="num_ext" value="{{ old('num_ext') }}" class="form-control" />
    </div>
    <label for = "num_int" class="col-md-3 col-form-label">Num Int</label>
    <div class="col-md-9">
        <input type="text" name="num_int" id="num_int" value="{{ old('num_int') }}" class="form-control" />
    </div>
    <label for = "colonia" class="col-md-3 col-form-label">Colonia</label>
    <div class="col-md-9">
        <input type="text" name="colonia" id="colonia" value="{{ old('colonia') }}" class="form-control" />
    </div>
    <label for = "localidad" class="col-md-3 col-form-label">Localidad</label>
    <div class="col-md-9">
        <input type="text" name="localidad" id="localidad" value="{{ old('localidad') }}" class="form-control" />
    </div>
    <label for = "municipio" class="col-md-3 col-form-label">Municipio</label>
    <div class="col-md-9">
        <input type="text" name="municipio" id="municipio" value="{{ old('municipio') }}" class="form-control" />
    </div>
    <label for = "estado" class="col-md-3 col-form-label">Estado</label>
    <div class="col-md-9">
        <input type="text" name="estado" id="estado" value="{{ old('estado') }}" class="form-control" />
    </div>
    <label for = "pais" class="col-md-3 col-form-label">País</label>
    <div class="col-md-9">
        <input type="text" name="pais" id="pais" value="{{ old('pais') }}" class="form-control" />
    </div>
    <label for = "cp" class="col-md-3 col-form-label">CP</label>
    <div class="col-md-9">
        <input type="text" name="cp" id="cp" value="{{ old('cp') }}" class="form-control" />
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "emails" class="col-md-3 col-form-label">Emails</label>
    <div class="col-md-9">
        <input type="text" name="emails" id="emails" value="{{ old('emails') }}" class="form-control" />
    </div>
    <label for = "celulares" class="col-md-3 col-form-label">Celulares</label>
    <div class="col-md-9">
        <input type="text" name="celulares" id="celulares" value="{{ old('celulares') }}" class="form-control" />
    </div>
    <label for = "telefonos" class="col-md-3 col-form-label">Teléfonos</label>
    <div class="col-md-9">
        <input type="text" name="telefonos" id="telefonos" value="{{ old('telefonos') }}" class="form-control" />
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "lugar_nacimiento" class="col-md-3 col-form-label">Lugar Nacimiento</label>
    <div class="col-md-9">
        <input type="text" name="lugar_nacimiento" id="lugar_nacimiento" value="{{ old('lugar_nacimiento') }}" class="form-control" />
    </div>
    <label for = "fecha_nacimiento" class="col-md-3 col-form-label">Fecha Nacimiento</label>
    <div class="col-md-9">
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" class="form-control" />
    </div>
    <label for = "genero" class="col-md-3 col-form-label">Género</label>
    <div class="col-md-9">
        {{ Form::select('genero', array('1'=>'Hombre', '0'=>'Mujer'), 0, ['id' => 'genero','class' => 'form-control']) }}
    </div>
    <label for = "ocupacion" class="col-md-3 col-form-label">Ocupación</label>
    <div class="col-md-9">
        <input type="text" name="ocupacion" id="ocupacion" value="{{ old('ocupacion') }}" class="form-control" />
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "celular" class="col-md-3 col-form-label">Roles</label>
    <div class="col-md-9">
    </div>
</div>

<div class="form-group row mb-3">
    <label for = "celular" class="col-md-3 col-form-label">Permisos</label>
    <div class="col-md-9">
    </div>
</div>
<input type="hidden" name="id" value="0" >

<hr>
