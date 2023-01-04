<div class="alert d-flex bg-primary text-white  border-0 radius-0" role="alert" id="alertNotificationImageMobile">
    <i class="fas fa-exclamation-circle mr-3 fa-2x text-warning-l3"></i>
    <span class="align-self-center text-120" id="labelTextMobile"></span>
</div>

<div class="col-lg-12 mt-2">
    <div class="row">
        {{$body_catalogo}}
    </div>
<div class="row">

@section('scripts')
{{--<script src="{{ asset('js/jquery.dataTables.js') }}"></script>--}}
{{--<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/buttons.bootstrap4.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/buttons.html5.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/buttons.flash.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/dataTables.select.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/datatable.js') }}"></script>--}}

<script src="{{ asset('js/servimun.js') }}"></script>

@endsection
