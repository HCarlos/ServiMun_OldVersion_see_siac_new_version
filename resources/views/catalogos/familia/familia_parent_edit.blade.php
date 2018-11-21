@formFullModal
    @slot('metodo','POST')
    @slot('action','putFamParent')
    @slot('_csrf')
        @csrf
        {{method_field('PUT')}}
    @endslot
    @slot('titulo_full_modal')
        {{ $item->familia }}
    @endslot
    @slot('body_full_modal')
        @include('shared.familia.__familia_parent_edit')
    @endslot
@endformFullModal
