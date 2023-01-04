@foreach($items as $item)

    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 px-2 mt-2 mt-sm-0">
        <div class="dh-zoom-1">
            <!-- Professional -->
            <div class="d-style active btn btn-light btn-h-outline-blue btn-a-outline-blue bgc-white mt-lg-n2 w-100 border-t-3 my-2 pb-3 shadow-sm">

                <div class="d-flex flex-column align-items-center">
                    <h4 class="w-90 pb-3 text-150 my-25">
                        <i>{{ $item->Servicio->servicio }}</i><br>
                        <small class="w-90 pb-3 text-110 my-25 overlay-item">
                            <i>{{ $item->Servicio->Dependencia->abreviatura }}</i>
                        </small>
                    </h4>

                    <span class="position-tr mt-n25 mr-2px">
                        <span class="badge badge-lg bgc-orange-d2 brc-orange-d2 text-white arrowed-in arrowed-in-right">
                            {{ $item->fecha }}
                        </span>
                        </span>

                    <div class="mt-2 mb-4">
                        <a href="{{ url($item->Imagemobiles()->first()->PathImage)}}" target="_blank" title="{{$item->denuncia}}">
                            <img src="{{$item->Imagemobiles()->first()->PathImage}}?timestamp={{now()}}" class="img-circle border border-white"  alt="{{$item->denuncia}}" width="300" height="250"/>
                        </a>
                    </div>

                    <div class="text-120">
                        <div class="text-orange-d2 mt-n2">
                            <span class="pos-abs ml-n25 mt-3"></span>
                            <span class="text-200">{{$item->denuncia}}</span>
                        </div>
                    </div>

                    <hr class="w-90 my-4 brc-secondary-l3">

                    <div class="flex-grow-1 text-dark-l1 text-90 w-90">
                        <ul class="list-unstyled text-left mx-auto mb-1">

                            <li class="mb-3">
                                    <span class="text-110 text-1">
                                        <a href="http://www.openstreetmap.org/?mlat={{$item->latitud}}&mlon={{$item->longitud}}&map=23" class="btn btn-link">
                                <i class="fa fa-globe-americas text-success-m2 text-110 mr-1 mt-1"></i>
                                            Ver Ubicación
                                        </a>
                              </span>
                            </li>

                            <li class="mt-3 text-center">
                                <hr class="my-4 brc-secondary-l3">
                                <a href="#" class="pos-abs v-n-active btn btn-outline-default px-4 text-600">Responder</a>
                                <a href="#" class="v-active btn btn-blue px-4  text-600 btn-raised">Ver otras imágenes</a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>


@endforeach
