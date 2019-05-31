@if(Auth::user()->getAuthIdentifier() == $item->user__id)
    <a href="#"
   class="action-icon text-center removeItemList"
   id="{{$removeItem.'-'.$item->id}}"
   data-toggle="tooltip" title="Quitar Registro"
    >
    <i class="fas fa-trash-alt text-danger"></i>
</a>
@endif