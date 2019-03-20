<a href="{{route($imagenesDenunciaItem,['Id'=>$item->id])}}"
   class="action-icon text-center" @isset($newWindow)target="_blank" @endisset
   data-toggle="tooltip" title="Agregar Imágenes"
    >
    <i class="fas fa-camera-retro text-warning"></i>
</a>
