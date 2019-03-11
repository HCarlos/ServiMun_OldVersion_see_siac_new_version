@extends('home')

@section('container')

    @formDropZone

@slot('metodo','POST')
@slot('action','saveImageneDen')
@slot('_csrf')
    @csrf
    {{--{{method_field('PUT')}}--}}
@endslot
@slot('titulo_dropzone',"Subir Imágenes")
@slot('body_full_modal')
    @include('shared.denuncia.images.__imagene_upload')
@endslot
    @slot('removeItem',$removeItem)
@endformDropZone

    @endsection
