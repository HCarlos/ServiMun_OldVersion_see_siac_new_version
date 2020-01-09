<a href="{{route($showEdit,['Id'=>$item->id])}}"
   class="action-icon text-center" @isset($newWindow) target="_blank" @endisset
   data-toggle="tooltip" title="Editar Registro"
    >
    <i class="fas fa-edit text-primary"></i>
</a>
