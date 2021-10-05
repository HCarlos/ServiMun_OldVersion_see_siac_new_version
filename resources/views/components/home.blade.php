@section('styles')
    <link href="{{ asset('css/servimun.css') }}" rel="stylesheet"  type="text/css">
@endsection

<div class="row mt-4">
    {{$contenido}}
</div>

@include('shared.code.__submit_form')

