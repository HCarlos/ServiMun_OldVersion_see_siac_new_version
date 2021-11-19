jQuery(function($) {
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
            }
        });

        var Objs = ["#search_autocomplete","#search_autocomplete_user",".search_autocomplete_user"];
        var Urls = ["/searchAdress","/searchUser","/searchUser"];
        var Gets = ["/getUbi/","/getUser/","/getUser/"];
        var Ids =  ["id","id","id"];

        for (i=0;i<13;i++)
            if ( $(Objs[i]) ) callAjax($(Objs[i]), Urls[i], Gets[i], i, Ids[i]);

        function callAjax(Obj, Url, Get, Item, ID, Elem) {
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
                case 2:
                    if ( $("#lstAsigns") ) $("#lstAsigns").empty();
                    $("#listTarget").val(d.id);
                    getRolesFromUser(Obj, Item, data);
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
                case 2:
                    if ( $("#lstAsigns") ) $("#lstAsigns").empty();
                    $("#listTarget").val(0);
                    break;

            }
        }

        function clearObjAll(){
            if ( $("#ubicacion_id") )      $("#ubicacion_id").val(0);
            if ( $("#ubicacion_id_span") ) $("#ubicacion_id_span").val("");
            if ( $("#ubicacion") )         $("#ubicacion").val("");
            if ( $("#usuario_domicilio") ) $("#usuario_domicilio").val("");
            if ( $("#usuario_id") )        $("#usuario_id").val(0);
            if ( $("#usuario_id") )        $("#lstAsigns").empty();
            if ( $("#listTarget") )        $("#listTarget").val(0);
        }

        function getRolesFromUser(Obj, Item, data){
            var d = data.data;
            $.get(  $("#getItems").val()+d.id, function( dato ) {
                var count = $.map(dato.data, function(n, i) { return i; }).length;
                $("#totalRolesUsuarios").html( count );
                $.each(dato.data, function( index, value ) {
                    $("#lstAsigns").append("<option value='"+index+"'>"+value+"</option>");
                });
            }, "json" );
        }

    });
});
