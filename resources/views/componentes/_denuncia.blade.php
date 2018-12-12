<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{$titulo_catalogo}} <small>{{$titulo_header}}</small></h4>
        </div>
    </div>
</div>
<div class="row">
    {{$contenido}}
</div>
@section("script_extra")
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script >
        jQuery(function($) {
            $(document).ready(function() {
                if ( $("#search_autocomplete") ){

                    src = "{{ route('searchAdress') }}";
                    $("#search_autocomplete").autocomplete({
                        source: function(request, response) {
                            $.ajax({
                                url: src,
                                dataType: "json",
                                data: {
                                    search : request.term
                                },
                                success: function(data) {
                                    response(data);
                                },
                            });
                        },
                        minLength: 3,
                    });
                }
                $( "#search_autocomplete" ).on( "autocompleteselect", function( event, ui ) {
                    var Id = ui.item['id'];
                    $.get( "/getUbi/"+Id, function( data ) {
                        $("#ubicacion_id").val(data.data.id);
                        $("#calle").val(data.data.calle);
                        $("#colonia").val(data.data.colonia);
                        $("#comunidad").val(data.data.comunidad);
                        $("#ciudad").val(data.data.ciudad);
                        $("#municipio").val(data.data.municipio);
                        $("#estado").val(data.data.estado);
                        $("#cp").val(data.data.cp);
                        $("#search_autocomplete").val("");
                    }, "json" );
                });

                $( "#search_autocomplete" ).on( "keyup", function( event ) {
                    clearObjects();
                });

                function clearObjects() {
                    $("#ubicacion_id").val(0);
                    $("#calle").val("");
                    $("#colonia").val("");
                    $("#comunidad").val("");
                    $("#ciudad").val("");
                    $("#municipio").val("");
                    $("#estado").val("");
                    $("#cp").val("");
                }

            });
        });

    </script>

@endsection
