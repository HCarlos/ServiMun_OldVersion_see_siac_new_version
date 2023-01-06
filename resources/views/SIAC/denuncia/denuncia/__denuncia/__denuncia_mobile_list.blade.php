            <div class="col-lg-12 ">
                <div class="row">

                @foreach($items as $item)

                    <div class="card col-lg-3 m-2">
                        <div class="card-body pb-1">

                            <div class="d-flex">
                                <img class="me-2 rounded" src="{{ $item->ciudadanos->first()->PathImageProfile ?? "" }}" height="32" width="32" alt="">
                                <div class="w-100 ml-1">
                                    <h5 class="m-0">{{$item->ciudadanos()->first()->FullName ?? ""}}</h5>
                                    <p class="text-muted"><small>{{ \Carbon\Carbon::parse($item->fecha)->format('d-m-Y H:i:s') }}<span class="mx-1">⚬</span> <span>{{$item->User->Role()->name}}</span></small></p>
                                </div> <!-- end w-100-->
                            </div> <!-- end d-flex -->

                            <hr class="m-0"/>

                            <div class="my-3">
                                <p>{{$item->denuncia}}!<br>
                                    <small class="text-muted">{{ $item->Servicio->Dependencia->abreviatura }}</small>
                                </p>
                                <div class="row">
                                    @php $i = 0; $j = count($item->Imagemobiles)-1; @endphp
                                    @foreach($item->Imagemobiles as $image)
                                        @if($i==0)
                                        <div class="col-sm-12">
                                            <a href="{{ $image->PathImage }}" target="_blank" title="{{ $item->Servicio->Dependencia->dependencia }}">
                                                <img src="{{ $image->PathImage }}" alt="" class="rounded img-fluid"/>
                                            </a>
                                        </div>
                                        <div class="col m-1">
                                        @endif
                                        @if($i>0)
                                                <a href="{{ $image->PathImage }}" target="_blank" title="{{ $item->Servicio->Dependencia->dependencia }}" >
                                                   <img src="{{ $image->PathImageThumb }}" alt="" class="rounded img-fluid " width="60" height="60" />
                                                </a>
                                        @endif
                                        @php $i++; @endphp
                                    @endforeach
                                    </div>  <!-- end images thumb -->

                                </div>
                                <div class="w-100 mt-3">
                                    <p>{{$item->ubicacion}}</p>
                                </div>
                            </div>

                            <div class="mt-1 mb-1">
                                <a href="http://www.openstreetmap.org/?mlat={{$item->latitud}}&mlon={{$item->longitud}}&map=23" class="btn btn-sm btn-link text-muted ps-0" target="_blank"><i class='mdi mdi-map-marker text-danger'></i> Ver Ubicación</a>
{{--                                <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted"><i class='uil uil-comments-alt'></i> 0 Respuesta(s)</a>--}}
{{--                                <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted"><i class='uil uil-share-alt'></i> Share</a>--}}
                            </div>

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->

                @endforeach

            </div>
        </div>
