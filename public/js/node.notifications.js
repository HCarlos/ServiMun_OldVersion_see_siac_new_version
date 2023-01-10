
jQuery(function($) {
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
            }
        });


        // $dens = Denunciamobile::select(['id','denuncia','fecha','latitud','longitud','ubicacion','ubicacion_google','user_id','serviciomobile_id'])


        var i = 0;
        window.Echo.channel('test-channel')
            .listen('.InserUpdateDeleteEvent', (data) => {
                i++;
                $('#power').html(parseInt(data.power) * i);
                if ( $("#pantallaMobileMaster") != null  ) {
                    alert(data.status + '\n' +
                        data.msg.status + '\n' +
                        data.msg.msg + '\n' +
                        data.msg.access_token + '\n' +
                        data.msg.token_type);
                }
                // alert(data.status+'\n'+
                //     data.msg+'\n'+
                //     data.denuncias[0].denuncia+'\n'+
                //     data.denuncias[0].fecha+'\n'+
                //     data.denuncias[0].latitud+'\n'+
                //     data.denuncias[0].longitud+'\n'+
                //     data.denuncias[0].ubicacion+'\n'+
                //     data.denuncias[0].ubicacion_google+'\n'+
                //     data.denuncias[0].user_id);

                console.log(data.power)
            })
            .listen('.IUQDenunciaEvent', (data) => {
                if ( parseInt(data.status) === 200 ){
                    $.toast({
                        heading: 'SIAC',
                        text: data.msg,
                        icon: data.icon,
                        loader: true,
                        hideAfter: false,
                        loaderBg: '#9EC600',
                        position: 'top-right',
                    })
                    console.log(data.denuncia_id+" :: "+data.user_id);
                }
            });

        localStorage.setItems = 0;
        window.Echo.channel('api-channel')
            .listen('.APIDenunciaEvent', (data) => {
                if ( parseInt(data.status) === 200 ){
                    if ( $("#pantallaMobileMaster") != null ) {
                        localStorage.setItems++;
                        $("#alertNotificationImageMobile").show();
                        $("#labelTextMobile").html("Hay "+localStorage.setItems+" nuevo(s)");
                    }
                    console.log(data.denuncia_id+" : Mobile : "+data.user_id);
                }
            });

        // alert("Hola Mun-2");




    });
});


