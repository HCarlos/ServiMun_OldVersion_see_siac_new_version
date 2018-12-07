<div class="row bg-dark rounded ">
    @if( $items->total() > 1 )
        <div class="col-md-6 mb-2" >
            @include('shared.ui_kit.__toolbar_denuncia')
        </div>
    @else
        <div class="col-md-12" >
            @include('shared.ui_kit.__toolbar_denuncia')
        </div>
    @endif
    <div class="col-md-6 ">
        <div class="mt-md-2">
            {{ $items->onEachSide(1)->links() }}
        </div>
    </div>
</div>
