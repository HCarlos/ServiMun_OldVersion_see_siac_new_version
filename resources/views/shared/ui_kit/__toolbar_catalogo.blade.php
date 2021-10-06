<div class="button-list mt-md-2">

    @isset($newItem)
        <a href="{{route($newItem)}}"  @isset($newWindow) @endisset class="btn btn-icon btn-rounded btn-outline-light"> <i class="fas fa-plus"></i> Nuevo</a>
    @endisset
    @isset($showProcess1)
        <a href="{{route($showProcess1)}}" @isset($newWindow)  @endisset class="btn btn-icon btn-rounded btn-outline-success btnFilters"> <i class="fas fa-file-excel text-white"></i> Exportar a Excel</a>
    @endisset
    @isset($exportModel)
            <a href="{{route('getModelListXlS',['model'=>$exportModel])}}" @isset($newWindow) @endisset class="btn btn-icon btn-rounded btn-outline-info btnFilters"> <i class="fas fa-file-excel text-white"></i> Exportar Modelo a Excel</a>
    @endisset

</div>
