@formFullModal
@slot('metodo','POST')
@slot('action','putFamRegFis')
@slot('_csrf')
    @csrf
    {{method_field('PUT')}}
@endslot
@slot('titulo_full_modal')
    {{ $item->familia }}
@endslot
@slot('body_full_modal')
    @include('shared.familia.__familia_regfis_edit')
@endslot
@endformFullModal