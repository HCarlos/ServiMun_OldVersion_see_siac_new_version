
<div class="button-list mt-md-2">
    @isset($newItem)
        <a href="{{route($newItem,['denuncia_id'=>$denuncia_id]) }}" id="{{$newItem}}" class="btn btn-icon btn-outline-purple btn-rounded  btnFullModal" data-toggle="modal" data-target="#modalFull" data-placement="top" title="Nuev@" data-original-title="Nuev@">
            <i class="fas fa-plus"></i>
        </a>
    @endisset

    <a class="btn btn-icon btn-outline-danger btn-rounded float-right" data-toggle="tooltip" data-placement="top" data-original-title="Cerrar" onclick="window.close();">
        <i class="fas fa-times text-white"></i>
    </a>

    <a class="btn btn-icon btn-outline-success btn-rounded float-right" data-toggle="tooltip" data-placement="top" data-original-title="Actualizar" onclick="window.location.reload(true);">
        <i class="fas fa-sync-alt text-white"></i>
    </a>

</div>
