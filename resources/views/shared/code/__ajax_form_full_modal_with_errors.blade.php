<script>

    if( $("#formFullModal") ){
        $("#formFullModal").unbind("submit");
        $("#formFullModal").on("submit", function (event) {
            event.preventDefault();
            var $form = $(this);
            var url = $form.attr('action');
            var formData = {};
            $form.find('input, select, checkbox, textarea, radio, file, img').each(function() {
                formData[ $(this).attr('name') ] = $(this).val();
            });
            $.post(url, formData, function(response) {
                if (response.data === "OK") {
                    alert(response.mensaje);
                    $("#modalFull").modal('hide');
                    location.reload();
                }
            }).fail(function(response) {
                associate_errors(response.responseJSON, $form);
            });
        });
    }

    function associate_errors(errors, $form) {
        $.each( errors, function( key, val ) {
            $form.find('#' + key ).addClass('has-error form-error');
            $form.find('.has-' + key ).find('.text-danger').text(val);
        });
    }

</script>