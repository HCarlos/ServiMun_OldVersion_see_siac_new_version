
<div class="button-list mt-md-2">
    @isset($newItem)
        <a href="{{route($newItem)}}"  @isset($newWindow) target="_blank" @endisset class="btn btn-icon btn-outline-light btn-rounded" data-toggle="tooltip" data-placement="top" data-original-title="Nueva Denuncia">
            <i class="fas fa-plus"></i>
        </a>
    @endisset
    @isset($showProcess1)
        <a href="{{ route($showProcess1)}} " @isset($newWindow) target="_blank" @endisset class="btn btn-icon btn-outline-success btn-rounded btnFilters" data-toggle="tooltip" data-placement="top" data-original-title="Exportar a XLSX">
            <i class="fas fa-file-excel text-white"></i>
        </a>
    @endisset
    @isset($showModalSearchDenuncia)
        <a href="{{route($showModalSearchDenuncia)}}" id="{{$showModalSearchDenuncia}}" class="btn btn-icon btn-outline-purple btn-rounded  btnFullModal" data-toggle="modal" data-target="#modalFull" data-placement="top" title="Búsqueda avanzada" data-original-title="Búsqueda avanzada">
            <i class="fas fa-search text-white"></i>
        </a>
    @endisset

        <a class="btn btn-icon btn-outline-success btn-rounded float-right" data-toggle="tooltip" data-placement="top" data-original-title="Actualizar" onclick="window.location.reload(true);">
            <i class="fas fa-sync-alt text-white"></i>
        </a>

</div>
