<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{$titulo_catalogo}} <small>{{$titulo_header}}</small></h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    {{$contenido}}
</div>

@include('shared.code.__submit_form')

