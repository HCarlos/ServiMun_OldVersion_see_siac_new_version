<a href="{{route($imprimirDenuncia,['Id'=>$item->id])}}"
   class="action-icon text-center" @isset($newWindow) target="_blank" @endisset
    data-toggle="tooltip" title="Ver Denuncia en PDF"
    >
    <i class="fas fa-file-pdf text-cafe"></i>
</a>
