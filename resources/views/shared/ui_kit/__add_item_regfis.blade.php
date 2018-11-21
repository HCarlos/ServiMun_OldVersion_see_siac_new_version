@isset($showListFamRegFis)
    <a href="{{route($showListFamRegFis,['Id'=>$item->id])}}" class="action-icon text-center" @isset($newWindow) target="_blank" @endisset><i class="fas fa-money-check-alt text-cafe"></i></a>
@endisset
