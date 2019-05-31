<div class="row">
    <div class="col-lg-12">
        <ul class="media-list">
            @foreach($items as $item)
                @if(count($item->childs))
                    @include('shared.code.__hoja_tree_one_view',['items'=>$item,"isborder"=>true])
                    @include('shared.code.__hoja_tree_view',['items'=>$item->childs])
                @else
                    @include('shared.code.__hoja_tree_one_view',['items'=>$item])
                @endif
            @endforeach
        </ul>
    </div>
{{--    <div class="col-lg-6"></div>--}}
</div>
