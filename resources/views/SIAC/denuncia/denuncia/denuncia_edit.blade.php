@extends(Auth::user()->Home)

@section('container')

@component('components.denuncia')
{{--    @slot('titulo_catalogo',$titulo_catalogo)--}}
{{--    @slot('titulo_header','Folio: '. $items->id)--}}
    @slot('contenido')

        <ul class="nav nav-tabs nav-bordered">
            @foreach($tabs as $tab)

            <li class="nav-item">
                <a href="#{{$tab->tab}}" data-toggle="tab" aria-expanded="false" class="nav-link {{$tab->active}}">
                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">{{$tab->caption}}</span>
                </a>
            </li>
            @endforeach
        </ul>
        <div class="tab-content p-35 border-0">
            @foreach($tabs as $tab)
            <div class="tab-pane fade text-95 {{$tab->active.' show'}}" id="{{$tab->tab}}" role="tabpanel" aria-labelledby="{{$tab->tab}}-tab-btn">
                @component('components.card')
                    @slot('title_card','')
                    @slot('body_card')
                        @component('components.form')
                            @slot('Method', $tab->Method ?? 'GET')
                            @slot('Route', $tab->Route ?? '#')
                            @slot('IsUpload', $tab->IsUpload ?? false)
                            @slot('IsNew', $tab->IsNew ?? false)
                            @slot('items_forms', $tab->items_forms ?? '')
                            @slot('items', $items ?? null)
                            @slot('prioridades', $prioridades ?? null)
                            @slot('origenes', $origenes ?? null)
                            @slot('dependencias', $dependencias ?? null)
                            @slot('servicios', $servicios ?? null)
                            @slot('ciudadanos', $ciudadanos ?? null)
                            @slot('estatus', $estatus ?? null)
                            @slot('user',$user ?? null)
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
            @endforeach
        </div>
    @endslot
@endcomponent

@endsection
