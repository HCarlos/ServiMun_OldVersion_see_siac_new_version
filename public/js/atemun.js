
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
        }
    });

    if ( $(".dataTable").length > 0 ){

        var nCols = $(".dataTable").find("tbody > tr:first td").length;
        var aCol = [];

        aCol[nCols - 1] = {"sorting": false};
        if (aCol.length > 0 ){
            $(".dataTable").DataTable({
                searching: false,
                paging: false,
                info: true,
                "pageLength": 50,
                "order": [[ 0, "desc" ]],
                "language": {
                    "info": "Mostrando página _PAGE_ de _PAGES_"
                },
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
                "aoColumns": aCol
            });
        }
    }

    if ( $(".removeItemList").length > 0  ){
        $('.removeItemList').on('click', function(event) {
            event.preventDefault();
            var aID = event.currentTarget.id.split('-');
            var x = confirm("Desea eliminar el registro: "+aID[1]);

            if (!x){
                return false;
            }

            var Url = '/'+aID[0]+'/'+aID[1];

            $(function() {
                $.ajax({
                    method: "GET",
                    url: Url
                })
                    .done(function( response ) {
                        if (response.data == 'OK'){
                            alert(response.mensaje);
                            window.location.reload();
                        }else{
                            alert(response.mensaje);
                        }
                    })
            });
        });
    }

    if ( $(".btnFullModal").length > 0  ){
        $(".btnFullModal").on("click", function (event) {
            event.preventDefault();
            localStorage.Input="";

            // Aplica para los Checkbox en dataTable
            if ( $(".table") ){
                $form = $(".table > tbody");
                $form.find("input[name='file-select']:checked").each(function() {
                    localStorage.Input += localStorage.Input === "" ? $(this).val() : ","+$(this).val();
                });
            }

            // Nombre del Modal Form
            $("#modalFull .modal-content").empty();
            $("#modalFull .modal-content").html('<div class="fa-2x m-2"><i class="fa fa-cog fa-spin"></i> Cargado datos...</div>');
            $("#modalFull").modal('show');
            var Url = event.currentTarget.href;
            $(function () {
                $.ajax({
                    method: "get",
                    url: Url
                })
                .done(function (response) {
                    $("#modalFull .modal-content").html(response);

                    // Aplica para los Select2
                    $form = $("#modalFull .modal-content");
                    $form.find('.select2').each(function() {
                        $(this).select2({
                            dropdownParent: $('#modalFull')
                        });
                    });

                    // Aplica para los Checkbox en dataTable
                    if ( localStorage.Input!=="" ) {
                        $("#var2").val(localStorage.Input);
                    }

                    // Cuando se ejecuta un cambio en el Checkbox
                    $('.custom-control-input').on("change",function(e){
                        $(this).val( $(this).is(':checked') );
                    });
                    // Aplica para el Dropzone
                    if ( $('.dropzone')){
                        Dropzone.discover();
                    }

                });
            });
        });
    }

    if ( $(".listTarget").length > 0  ){
        $(".listTarget").on('change', function(event) {
            event.preventDefault();
            window.location.href = '/'+this.id+'/'+$(this).val();
        });
    }

    if ( $(".btnAsign0").length > 0  ){
        $(".btnAsign0").on('click', function(event) {
            event.preventDefault();
            var IdArr  = this.id.split('-');
            var urlAsigna = IdArr[0];
            var x = $('.listEle option:selected').val();
            var y = $('select[name="listTarget"] option:selected').val();
            if (isUndefined(x)){
                alert("Seleccione una opción disponible");
                return false;
            }else{
                x='';
                $(".listEle option:selected").each(function () {
                    x += $(this).val() + "|";
                });
            }
            if (isUndefined(y) || y <= 0){
                alert("Seleccione un elemento");
                return false;
            }
            // var Url = '/'+urlAsigna+'/'+y+'/'+x;

            //alert(Url);

            var Data = new FormData();
            Data.append( 'Id', y );
            Data.append( 'names', x );


            $(function() {

                $.ajax({
                    url: '/'+urlAsigna,
                    data: Data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function ( data ) {
                        window.location.href = data.mensaje;
                    }
                });

            });

        });
    }

    if ( $(".btnUnasign0").length > 0  ){
        $(".btnUnasign0").on('click', function(event) {
            event.preventDefault();
            var IdArr  = this.id.split('-');
            var urlElimina = IdArr[0];
            var urlRegresa = IdArr[1];
            var z = $('.lstAsigns option:selected').val();
            var y = $('select[name="listTarget"] option:selected').val();
            if (isUndefined(z)){
                alert("Seleccione una opción disponible");
                return false;
            }else{
                z='';
                $(".lstAsigns option:selected").each(function () {
                    z += $(this).val() + "|";
                });
            }
            if (isUndefined(y) || y <= 0){
                alert("Seleccione un elemento");
                return false;
            }


            var Data = new FormData();
            Data.append( 'Id', y );
            Data.append( 'names', z );


            $(function() {

                $.ajax({
                    url: '/'+urlElimina,
                    data: Data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function ( data ) {
                        window.location.href = data.mensaje;
                    }
                });

            });

        });
    }

    if ( $(".btnFilters").length > 0  ){
        $(".btnFilters").on('click', function(event) {
            event.preventDefault();

            if ( $(".frmSearchInList").length > 0  ){
                var hRef = event.currentTarget.href;
                var token = $("meta[name='csrf-token']").attr('content');
                var arrRole = [];
                $("input[name*='roles[]']:checked").each(function(){
                    arrRole.push($(this).val());
                });
                var oSearch    = $("input[name='search']").length > 0 ? $("input[name='search']").val() : "";
                var oRole_User = $("input[name='role_user']").length > 0 ? $("input[name='role_user']").val() : "";
                var PARAMS = {
                    search : oSearch,
                    roles  : arrRole,
                    role_user : oRole_User,
                    _token : token
                };
                var temp=document.createElement("form");
                temp.action=hRef;
                temp.method="POST";
                temp.target="_blank";
                temp.style.display="none";
                for(var x in PARAMS) {
                    var opt=document.createElement("textarea");
                    opt.name=x;
                    opt.value=PARAMS[x];
                    temp.appendChild(opt);
                }
                document.body.appendChild(temp);
                temp.submit();
                return temp;
            }

        });
    }

    if ( $(".btnGetItems").length > 0  ){
        $(".btnGetItems").on('click', function(event) {
            event.preventDefault();
            if ( $(".frmGetItems").length > 0  ){
                var hRef = event.currentTarget.href;
                var token = $("meta[name='csrf-token']").attr('content');
                var oSearch    = $("input[name='search']").length > 0 ? $("input[name='search']").val() : "";
                var oItems     = $("input[name='items']").length > 0 ? $("input[name='items']").val() : "";
                var PARAMS = {
                    search : oSearch,
                    items : oItems,
                    _token : token
                };
                var temp=document.createElement("form");
                temp.action=hRef;
                temp.method="POST";
                temp.target="_blank";
                temp.style.display="none";
                for(var x in PARAMS) {
                    var opt=document.createElement("textarea");
                    opt.name=x;
                    opt.value=PARAMS[x];
                    temp.appendChild(opt);
                }
                document.body.appendChild(temp);
                temp.submit();
                return temp;
            }
        });

    }

    // Activa o desactiva los checkbox desde el encabezado de la tabla
    $('#lblcheckbox').on("change",function(event){
        $(".image-chk").prop( "checked", $(this).is(':checked') );
    });

    if ( $(".removeItemSelects").length > 0  ){
        $('.removeItemSelects').on('click', function(event) {
            event.preventDefault();
            localStorage.Input = "";
            if ( $(".table") ){
                $form = $(".table > tbody");
                $form.find("input[name='file-select']:checked").each(function() {
                    localStorage.Input += localStorage.Input === "" ? $(this).val() : ","+$(this).val();
                });
            }
            var x = confirm("Desea eliminar los registros seleccionados?");

            if (!x){
                return false;
            }
            var aID = event.currentTarget.id.split('-');
            if ( localStorage.Input === ""){
                var Url = '/'+aID[0]+'/'+aID[1];
            }else{
                var Url = '/'+aID[0]+'/'+localStorage.Input;
            }

            $(function() {
                $.ajax({
                    method: "GET",
                    url: Url
                })
                    .done(function( response ) {
                        if (response.data == 'OK'){
                            alert(response.mensaje);
                            window.location.reload();
                        }else{
                            alert(response.mensaje);
                        }
                    })
            });
        });
    }

    if ( $(".home").html().length == 37 ){
        $(".home").html("<div class='img_bg_home' ></div>");

    }



    $("#colonia, #comunidad, #calle, #asentamiento, #tipoasentamiento, #tipocomunidad, #localidad," +
        "#afiliacion, #area, #subarea, #dependencia, #medida, #origen, #prioridad, #servicio, #ubicacon," +
        "#ciudad, #estado, #municipio, #estatus, #codigo, #cp, #search, #num_ext, #num_int," +
        "#search_autocomplete").keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

});
