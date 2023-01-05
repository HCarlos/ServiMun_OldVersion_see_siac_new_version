            <div class="col-lg-12 ">
                <div class="row">
@foreach($items as $item)

                    <div class="card col-lg-3 m-2">
                        <div class="card-body pb-1">

                            <div class="d-flex">
                                <img class="me-2 rounded" src="{{ $item->User->PathImageProfile }}" height="32" width="32" alt="">
                                <div class="w-100 ml-1">
                                    <h5 class="m-0">{{$item->User->FullName}}</h5>
                                    <p class="text-muted"><small>{{ \Carbon\Carbon::parse($item->fecha)->format('d-m-Y H:i:s') }}<span class="mx-1">⚬</span> <span>{{$item->User->Role()->name}}</span></small></p>
                                </div> <!-- end w-100-->
                            </div> <!-- end d-flex -->

                            <hr class="m-0"/>

                            <div class="my-3">
                                <p>{{$item->denuncia}}!</p>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <a href="{{ $item->Imagemobiles()->first()->PathImage }}" target="_blank"  width="400" height="300">
                                            <img src="{{ $item->Imagemobiles()->first()->PathImage }}" alt="post-img" class="rounded me-1 mb-3 mb-sm-0 img-fluid"/>
                                        </a>
                                    </div>
                                    <div class="col">
{{--                                        <img src="assets/images/small/small-2.jpg" alt="post-img" class="rounded me-1 img-fluid mb-3" />--}}
{{--                                        <img src="assets/images/small/small-3.jpg" alt="post-img" class="rounded me-1 img-fluid" />--}}
                                    </div>
                                </div>
                                <p class="mt-3">{{$item->ubicacion}}</p>
                            </div>

                            <div class="mt-1 mb-1">
                                <a href="http://www.openstreetmap.org/?mlat={{$item->latitud}}&mlon={{$item->longitud}}&map=23" class="btn btn-sm btn-link text-muted ps-0" target="_blank"><i class='mdi mdi-map-marker text-danger'></i> Ver Ubicación</a>
                                <a href="#" class="btn btn-sm btn-link text-muted"><i class='uil uil-comments-alt'></i> 0 Respuesta(s)</a>
{{--                                <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted"><i class='uil uil-share-alt'></i> Share</a>--}}
                            </div>

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
@endforeach
            </div>
        </div>
