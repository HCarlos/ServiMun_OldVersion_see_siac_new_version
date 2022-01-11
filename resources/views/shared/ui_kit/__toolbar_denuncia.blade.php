
<div class="button-list mt-md-2">
    @isset($newItem)
        <a href="{{route($newItem)}}" class="btn btn-outline-light btn-rounded btn-sm ml-3" data-toggle="tooltip" data-placement="top" data-original-title="Nueva Denuncia">
            <i class="fas fa-plus"></i>
        </a>
    @endisset
    @isset($showProcess1)
        <a href="{{ route($showProcess1)}} " class="btn btn-icon btn-outline-success btn-rounded btnGetItems" data-toggle="tooltip" data-placement="top" data-original-title="Exportar a MS Excel">
            <i class="fas fa-file-excel text-white"></i>
        </a>
    @endisset
    @isset($showModalSearchDenuncia)
        <span data-toggle="modal" data-target="#modalFull" >
            <a href="{{route($showModalSearchDenuncia)}}" id="{{$showModalSearchDenuncia}}" class="btn btn-icon btn-outline-light btn-rounded  btnFullModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Búsqueda Avanzada">
                <i class="fas fa-search"></i>
            </a>
        </span>
    @endisset

        <a href="" class="btn btn-icon btn-outline-info btn-rounded" data-toggle="tooltip" data-placement="top" data-original-title="Actualizar" onclick="window.location.reload(true);">
            <i class="fas fa-sync-alt text-white"></i>
        </a>

</div>
