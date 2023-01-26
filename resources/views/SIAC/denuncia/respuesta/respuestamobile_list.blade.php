{{--@extends(Auth::user()->Home)--}}

{{--@section('container')--}}

{{--    @component('components.catalogo')--}}

{{--        @slot('buttons')--}}
{{--            @include('shared.ui_kit.__menu_respuesta')--}}
{{--        @endslot--}}
{{--        @slot('body_catalogo')--}}
{{--            @include('SIAC.denuncia.respuesta.__respuesta.__respuestamobile_list')--}}
{{--        @endslot--}}

{{--    @endcomponent--}}

{{--@endsection--}}

@component('components.form.form-modal')
    @slot('Method', "POST" ?? 'GET')
    @slot('Titulo', $Titulo ?? '')
    @slot('Route', "saveRespuestaMobileDen" ?? '#')
    @slot('IsUpload', $IsUpload ?? false)
    @slot('IsNew', true ?? false)
    @slot('IsModal', true ?? false )
    @slot('items_forms', "SIAC.denuncia.respuesta.__respuesta.__respuestamobile_list" ?? '')
    @slot('item', $items ?? null)
    @slot('formData', 'formFullModal')
    @slot('user',$user ?? null)
    @slot('id',$id ?? null)
    @slot('denunciamobile_id',$denunciamobile_id ?? null)
@endcomponent
