<a href="{{route($showListFamParent,['Id'=>$item->id])}}"
   class="action-icon text-center" @isset($newWindow) target="_blank" @endisset
   data-toggle="tooltip" title="Lista de familiares"
    >
    <i class="fas fa-user-plus text-secondary "></i>
</a>
