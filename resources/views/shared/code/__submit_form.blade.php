@section("script_extra")
<script >
    jQuery(function($) {
        $(document).ready(function() {
            if( $(".preloader") ){
                $(".preloader").hide();
            }
            if  ($("#fromPhotoProfile") ){
                $("#fromPhotoProfile").on("submit",function(event){
                    // event.preventDefault();
                    $("#btnSavePhoto").hide();
                    $(".preloader").show();
                })
            }
        });
    });

</script>

@endsection