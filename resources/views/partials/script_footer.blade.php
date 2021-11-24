<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/fontawesome.min.js')}}"></script>
<script src="{{asset('js/bootbox.min.js')}}"></script>

<script src="{{asset('js/bootbox.min.js')}}"></script>
<script src="{{asset('js/bootstrap-dialog.js')}}"></script>
<script src="{{asset('js/buttons.bootstrap4.min.js')}}"></script>

<script src="{{asset('js/buttons.flash.min.js')}}"></script>
<script src="{{asset('js/buttons.html5.min.js')}}"></script>
<script src="{{asset('js/buttons.print.min.js')}}"></script>
<script src="{{asset('js/chart.bundle.min.js')}}"></script>

<script src="{{asset('js/component.dragula.js')}}"></script>
<script src="{{asset('js/component.fileupload.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('js/dataTables.keyTable.min.js')}}"></script>

<script src="{{asset('js/jquery.dataTables.js')}}"></script>
<script src="{{asset('js/jquery-jvectormap.min.js')}}"></script>
<script src="{{asset('js/jquery-jvectormap-world-mill-en.js')}}"></script>

<script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('js/responsive.bootstrap4.min.js')}}"></script>

@yield("scripts")

<script src="{{ '/js/base.js?timestamp()' }}"></script>
<script src="{{ '/js/atemun.js?timestamp()' }}"></script>
<script src="{{ '/js/servimun.js?timestamp()' }}"></script>

@yield("script_autocomplete")

@yield("script_extra")
@yield("script_extra_modal")
@yield("script_interno")

