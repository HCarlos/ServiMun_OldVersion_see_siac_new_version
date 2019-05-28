<li class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="{{ $item->user->PathImageThumbProfile }}?timestamp='{{ now() }}' " width="64" height="64" />
    </a>
    <div class="media-body">
        <h4 class="media-heading">{{$item->user->FullName}} <small>{{$item->fecha}}</small>
            <span class=" table-action button-list pl-2 ">
                @include('shared.ui_kit.__edit_item_modal')
                @include('shared.ui_kit.__remove_item')
                @include('shared.ui_kit.__respuesta_a_respuesta_item')
            </span>
        </h4>
        <div class="media">
            <p>
                {{$item->respuesta}}<br>
                <small>{{$item->observaciones}}</small>
            </p>
        </div>
    </div>
</li>