<!-- Simple card -->
<div class="card">
    {{--@if($IsImage)--}}
    {{--<img class="card-img-top" src="{{asset($urlImg)}}" alt="{{$imgAlt}}">--}}
    {{--@endif--}}
    <div class="card-body">
        <h5 class="header-title mt-0 mb-3">{{$title_card}}</h5>
        {{$body_card}}
    </div> <!-- end card-body-->
</div><!-- end col -->

