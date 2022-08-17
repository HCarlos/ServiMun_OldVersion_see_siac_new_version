@if(Auth::user()->getAuthIdentifier() == $user->id)
    <a href="#"
       class="action-icon text-center removeItemListTwo"
       id="{{$removeItem.'-'.$items->id.'-'.$item->id}}"
       data-toggle="tooltip" title="Quitar Registro"
    >
        <i class="fas fa-trash-alt text-danger"></i>
    </a>
@endif
