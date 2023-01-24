
jQuery(function($) {
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
            }
        });

        i = 0;
        window.Echo.channel('test-channel')
            .listen('.InserUpdateDeleteEvent', (data) => {
                if ( $("#pantallaMobileMaster") != null  ) {
                    alert(data.status + '\n' +
                        data.msg.status + '\n' +
                        data.msg.msg + '\n' +
                        data.msg.access_token + '\n' +
                        data.msg.token_type);
                }
                i++;
                $('#power').html(parseInt(data.power) * i);
                console.log(data.power)
            })
            .listen('.IUQDenunciaEvent', (data) => {
                if (localStorage.isToast === true) {
                    $.toast({
                        heading: 'SIAC',
                        text: data.msg,
                        icon: data.icon,
                        loader: true,
                        hideAfter: false,
                        loaderBg: '#9EC600',
                        position: 'top-right',
                    })
                }
                i++;
                $("#power").html(parseInt(data.power) * i);
                console.log(data.denuncia_id+" :: "+data.user_id);
            });

        localStorage.setItems = 0;
        window.Echo.channel('api-channel')
            .listen('.APIDenunciaEvent', (data) => {
                if ( parseInt(data.status) === 200 ){
                    i++;
                    $('#power').html(parseInt(data.power) * i);
                    if ( $("#pantallaMobileMaster") != null ) {
                        localStorage.setItems++;
                        $("#alertNotificationImageMobile").show();
                        $("#labelTextMobile").html("Hay "+localStorage.setItems+" nuevo(s)");
                    }
                    console.log(data.denuncia_id+" : Mobile : "+data.user_id);
                }
            });

    });
});


