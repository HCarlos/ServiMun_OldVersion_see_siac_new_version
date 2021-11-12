<div class="button-list mt-md-2">
    @php $IsModal = $IsModal ?? false @endphp
    @php $IsModalNew = $IsModalNew ?? false @endphp
    @if( !$IsModal && !$IsModalNew )
        @isset($newItem)
            <a href="{{route($newItem)}}"  @isset($newWindow) @endisset class="btn btn-icon btn-rounded btn-outline-light"> <i class="fas fa-plus"></i> Nuevo</a>
        @endisset
    @else
        @isset($newItem)
            <a href="{{route($newItem)}}"  @isset($newWindow) @endisset id="{{route($newItem)}}" class="btn btn-icon btn-rounded btn-outline-light btnFullModal" data-toggle="modal" data-target="#modalFull"> <i class="fas fa-plus"></i> Nuevo</a>
        @endisset
    @endisset
    @isset($showProcess1)
        <a href="{{route($showProcess1)}}" @isset($newWindow)  @endisset class="btn btn-icon btn-rounded btn-outline-success btnFilters"> <i class="fas fa-file-excel text-white"></i> Exportar a Excel</a>
    @endisset
    @isset($exportModel)
            <a href="{{route('getModelListXlS',['model'=>$exportModel])}}" @isset($newWindow) @endisset class="btn btn-icon btn-rounded btn-outline-info btnFilters"> <i class="fas fa-file-excel text-white"></i> Exportar Modelo a Excel</a>
    @endisset

</div>
