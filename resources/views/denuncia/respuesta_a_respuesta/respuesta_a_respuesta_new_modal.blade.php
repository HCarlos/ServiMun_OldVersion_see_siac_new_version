@component('components.form.form-modal')
    @slot('metodo','POST')
    @slot('action','saveRespuestaARespuestaDen')
    @slot('_csrf')
        @csrf
        {{--{{method_field('PUT')}}--}}
    @endslot
    @slot('titulo_full_modal',"Nueva Respuesta")
    @slot('body_full_modal')
        @include('shared.denuncia.respuesta_a_respuesta.__respuesta_a_respuesta_new')
    @endslot
@endcomponent
