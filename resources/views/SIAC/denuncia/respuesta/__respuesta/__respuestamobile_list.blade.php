<div class="row">
    <div class="col-lg-12">
        <div id="conversations" class="card border-0 shadow-sm h-100">

{{--        <div id="conversations" class="card-body border-1 border-b-0 brc-secondary-l1 radius-t-1 bgc-secondary-l3 p-0">--}}
            <div class="card-body border-x-1 brc-primary-l1 p-0">
                <div class="ace-scroll" data-ace-scroll='{"height": 380, "smooth":true}'>
                @foreach($item->respuestas as $rs)
                @if( $rs->User->isRole('Administrator|SysOp|USER_OPERATOR_ADMIN|USER_ARCHIVO_ADMIN') )

{{--                    <div class="px-3 conversation">--}}
{{--                        <div class="media mt-2 mb-3">--}}
{{--                            <div class="d-flex flex-grow-1">--}}
{{--                                <div class="avatar align-self-end pos-rel">--}}
{{--                                    <img alt="{{ $rs->User->FullName }}" src="{{ $rs->User->PathImageProfile ?? "" }}" class="radius-round border-1 p-1px brc-primary w-5 h-5" height="32" width="32" />--}}
{{--                                    <span class="position-tr mt-2px mr-n2px bgc-success-tp2 radius-round border-1 brc-white p-1"></span>--}}
{{--                                </div>--}}
{{--                                <div class="media-body bgc-white py-2 px-3 col-10 col-sm-8 col-md-6 border-1 brc-secondary-l1">--}}
{{--                                    <div class="text-dark-m2 text-90">--}}
{{--                                        {{ $rs->respuesta }} <span class='fa-stack w-auto'> <i class='fas fa-circle text-dark fa-stack-1x text-100'></i> <i class='fas fa-smile-beam text-warning-m3 text-125 fa-stack-1x pos-rel'></i> </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                            <div class="px-3 conversation mt-425">
                                <div class="d-flex align-items-start col px-0">
                                    <div class="mr-3 mt-2px">
                                        <div class="pos-rel">
                                            <img alt="Max's avatar" src="{{ $rs->User->PathImageProfile ?? "" }}" class="radius-round w-4 h-4" height="32" width="32"/>
                                            <span class="position-tr bgc-success-d1 brc-white border-2 p-1 mt-n1 radius-round"></span>
                                        </div>
                                        <div class="text-600 text-90 ml-1">
                                            <a href="#" class="font-bolder btn-text-dark btn-h-text-primary">
                                                {{ $rs->User->username }}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col px-0">
                                        <div class="d-flex mb-15 pos-rel">
                                            <span class="position-tl ml-n15 mt-15 w-3 h-3 bgc-grey-l3 rotate-n45"></span>
                                            <div class="py-2 px-3 radius-1 bgc-grey-l3 text-dark-m1 pos-rel">
                                                <div class="text-90" style="max-width: 480px;">
                                                    {{ $rs->respuesta }}
                                                </div>
                                            </div>
                                            <div class="text-80 text-grey-m2 ml-2 mt-2">
                                                {{ $rs->fecha }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                @endif
            @endforeach
                    <input type="text" name="respuesta" class="form-control" placeholder="Escribe un comentario...">
                    <input type="hidden" name="user_id" id="user_id" value="{{ $item->user_id }}">
                    <input type="hidden" name="denunciamobile_id" id="denunciamobile_id" value="{{ $item->id }}">

            </div>
        </div>
    </div>
    </div>
</div>

