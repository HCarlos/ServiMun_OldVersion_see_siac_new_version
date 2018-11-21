@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        Corrije estos errores:
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
