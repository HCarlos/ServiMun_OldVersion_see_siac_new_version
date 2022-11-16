
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
                console.log(data.power)
            })
            .listen('.IUQDenunciaEvent', (data) => {
                if ( $(".tblCatDenuncias") && parseInt(data.status) === 200 ){
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
            }
        );
    });
});


