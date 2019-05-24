{{--<a href="{{route($editItem,['Id'=>$item->id])}}" id="{{$editItem}}" class="action-icon text-center btnFullModal" data-toggle="modal" data-target="#modalFull" data-placement="top" title="Editar" data-original-title="Editar" >--}}
{{--    <i class="fas fa-edit text-success"></i>--}}
{{--</a>--}}

<a href="{{route($new2Item,['denuncia_id'=>$denuncia_id,'respuesta__id'=>$item->id]) }}" id="{{$new2Item}}" class="action-icon text-center btnFullModal" data-toggle="modal" data-target="#modalFull" data-placement="top" title="Responder" data-original-title="Responder" >
                <i class="fas fa-comment-dots"></i>
            </a>


