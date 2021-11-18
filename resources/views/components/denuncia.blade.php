    <div class="row mt-3">
        {{$contenido}}
    </div>
@section("script_extra")
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script >

        jQuery(function($) {
            $(document).ready(function() {

                $("#radio1").prop('checked',true);
                $(".panelUbiProblem").hide();

                var getParents = "/getItemParent/";

                var Objs = ["#search_autocomplete","#search_autocomplete_user"];
                var Urls = ["{{ route('searchAdress') }}","{{ route("searchUser") }}"];
                var Gets = ["/getUbi/","/getUser/"];
                var Ids =  ["id","id"];

                for (i=0;i<13;i++)
                    if ( $(Objs[i]) ) callAjax($(Objs[i]), Urls[i], Gets[i], i, Ids[i]);

                        function callAjax(Obj, Url, Get, Item, ID) {
                            $(Obj).autocomplete({
                                source: function(request, response) {
                                    // var ta = $("#tipo_asentamiento") ? $("#tipo_asentamiento").val() : "";
                                    $.ajax({
                                        url: Url,
                                        dataType: "json",
                                        data: {
                                            search  : request.term,
                                        },
                                        success: function(data) {
                                            response(data);
                                        },
                                    });
                                },
                                minLength: 3,
                            });

                            $( Obj ).on( "autocompleteselect", function( event, ui ) {
                                var ox = ID.split('/');
                                var Id;
                                if ( ox.length ==1 ) Id = ui.item[ID];
                                if ( ox.length == 2 ) Id = ui.item[ox[0]]+"/"+ui.item[ox[1]];
                                $.get( Get+Id, function( data ) {
                                    asignObjects(Obj,Item, data);
                                }, "json" );
                            });

                            $( Obj ).on( "keyup", function( event ) {
                                clearObjects(Item);
                            });

                        }


                function asignObjects(Obj, Item, data) {
                    // alert(Item);
                    //
                    var d = data.data;
                    switch (Item) {
                        case 0:
                            $("#ubicacion_id").val(d.id);
                            $("#ubicacion_id_span").html(d.id);
                            $("#ubicacion").val(d.calle+' '+d.colonia+' '+d.comunidad+' '+d.ciudad+' '+d.municipio+' '+d.estado+' '+d.cp);
                            // $("#search_autocomplete").val("");
                            break;
                        case 1:
                            if ( $("#usuario") )           $("#usuario").val('('+d.id+') '+d.nombre_completo);
                            if ( $("#usuario_domicilio") ) $("#usuario_domicilio").val(d.domicilio);
                            if ( $("#usuario_id") )        $("#usuario_id").val(d.id);
                            if ( $("#ubicacion_id") )      $("#ubicacion_id").val(d.ubicacion_id);
                            if ( $("#ubicacion_id_span") ) $("#ubicacion_id_span").html(d.ubicacion_id);
                            if ( $("#ubicacion") )         $("#ubicacion").val(d.domicilio);
                            break;
                    }
                }

                function clearObjects(Item) {
                    switch (Item) {
                        case 0:
                            $("#ubicacion_id").val(0);
                            $("#ubicacion_id_span").val("");
                            $("#ubicacion").val("");
                            break;
                        case 1:
                            $("#usuario").val("");
                            $("#usuario_domicilio").val("");
                            $("#usuario_id").val(0);
                            break;

                    }
                }

                function clearObjAll(){
                    if ( $("#ubicacion_id") )      $("#ubicacion_id").val(0);
                    if ( $("#ubicacion_id_span") ) $("#ubicacion_id_span").val("");
                    if ( $("#ubicacion") )         $("#ubicacion").val("");
                    if ( $("#usuario_domicilio") ) $("#usuario_domicilio").val("");
                    if ( $("#usuario_id") )        $("#usuario_id").val(0);
                }

                if( $(".pregunta1") ){
                    $(".pregunta1").on('change',function(event){
                        event.preventDefault();
                        if ( $(this).val() == 0 ){
                            $(".panelUbiProblem").hide();
                        }else{
                            $(".panelUbiProblem").show();
                        }
                    });
                }

                function getServicioFromDependencia(dependencia_id){
                    $("#servicio_id").empty();
                    $.get( "/getServiciosFromDependencias/"+dependencia_id, function( data ) {
                        $("#servicio_id").empty();
                        if ( data.data.length > 0 ){
                            $.each(data.data, function(i, item) {
                                $("#servicio_id").append('<option value="'+item.id+'" > '+item.servicio+'</option>');
                            });
                        }
                    }, "json" );

                }

                $("#dependencia_id").on("change",function (event) {
                    var Id = event.currentTarget.value;
                    getServicioFromDependencia(Id);
                });

                if ( $(".pregunta1").val() == 1 ){
                    $(".panelUbiProblem").show();
                }

            });

        });

    </script>

@endsection
