
jQuery(function($) {
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
            }
        });




        var i = 0;
        window.Echo.channel('test-channel')
            .listen('.InserUpdateDeleteEvent', (data) => {
                i++;
                $('#power').html(parseInt(data.power) * i);
                alert(data.msg.status+'\n'+data.msg.msg+'\n'+data.msg.access_token+'\n'+data.msg.user.id);
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
            })
            .listen('.APIDenunciaEvent', (data) => {
                if ( parseInt(data.status) === 200 ){
                    // if ( $("#alertNotificationImageMobile") ) {
                        $("#alertNotificationImageMobile").show();
                        $("#labelTextMobile").html("Acaba de llegar uno nuevo...");
                    // }
                    console.log(data.denuncia_id+" : Mobile : "+data.user_id);
                }
            });

        localStorage.setItems = 0;
        window.Echo.channel('api-channel')
            .listen('.APIDenunciaEvent', (data) => {
                if ( parseInt(data.status) === 200 ){
                    if ( $("#alertNotificationImageMobile") ) {
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


