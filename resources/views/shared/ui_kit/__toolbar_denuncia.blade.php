<div class="button-list mt-md-2">
    @isset($newItem)
        <a href="{{route($newItem)}}"  @isset($newWindow) target="_blank" @endisset class="btn btn-icon btn-outline-light btn-rounded" data-toggle="tooltip" data-placement="top" title="" data-original-title="Nueva Denuncia">
            <i class="fas fa-plus"></i>
        </a>
    @endisset
    @isset($showProcess1)
        <a href="{{route($showProcess1)}}" @isset($newWindow) target="_blank" @endisset class="btn btn-icon btn-outline-success btn-rounded btnFilters" data-toggle="tooltip" data-placement="top" title="" data-original-title="Exportar a XLSX">
            <i class="fas fa-file-excel text-white"></i>
        </a>
    @endisset
</div>
