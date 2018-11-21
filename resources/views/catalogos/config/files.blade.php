@extends('home')

@section('container')

    @home
    @slot('titulo_header','Archivos de Configuración')
    @slot('contenido')
        <div class="col-md-4">
            <p class="text-success">Listado de archivos base:</p>
            <ul>
                @foreach($archivos as $archivo)
                    <li>
                        <a href="{{ asset('storage/externo/'.$archivo)  }}" target="_blank">{{$archivo}}</a>
                        <a href="{{ route('quitarArchivoBase/', array('driver' => 'externo','archivo'=>$archivo)) }}" title="Eliminar archivo">
                            <i class="fa fa-trash red"></i>
                        </a>
                    </li>
                @endforeach
            </ul>

        </div> <!-- end col-->

        <div class="col-md-8">
            <!-- Chart-->
            @card
            @slot('title_card','Subir Archivo')
            @slot('body_card')

                <div class="card card-platsource">
                    <div class="card-body">
                        <form method="post" action="{{ action('Storage\StorageExternalFilesController@subirArchivoBase') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="categ_file" class=" control-label {{$errors->has('categ_file')?'text-danger':''}}">Categoría de Archivo</label>
                                <select class="form-control select2 {{$errors->has('categ_file')?' text-danger is-invalid border-danger':''}}" data-toggle="select2" name="categ_file" id="categ_file" size="1">
                                    <option value="">Formatos XLSX</option>
                                    @foreach(config('platsource.archivos') as $item => $value)
                                        <option value="{{$value}}">{{ $item  }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="base_file" class=" control-label {{$errors->has('base_file')?'text-danger':''}}">Nuevo Archivo</label>
                                <div class="input-group">
                                    <input type="file" name="base_file" class="form-control {{ $errors->has('base_file') ? ' is-invalid' : '' }} "  value="{{ old('base_file') }}" style="padding-top: 0px; padding-left: 0px;" >
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-mini btn-primary">Subir</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            @endslot
            @endcard
        </div>
    @endslot
    @endhome

@endsection
