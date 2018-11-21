@isset($showEdit)
    @if( $user->hasRole('Administrator|SysOp') )
        <a href="#" id="{{$showEdit.'/'.$item->id}}" class="action-icon text-center btnFullModal" data-toggle="modal" data-target="#modalFull"><i class="fas fa-user-plus"></i></a>
    @endif
@endisset

