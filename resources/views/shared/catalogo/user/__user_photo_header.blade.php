<!-- Personal-Information -->
@card
@slot('title_card', $user->username)
@slot('body_card')
    @if( $user->IsEmptyPhoto() )
        @if( $user->IsFemale() )
            <img src="{{ asset('images/web/empty_user_female.png')  }}" class="img-circle border border-white"/>
        @else
            <img src="{{ asset('images/web/empty_user_male.png')  }}" class="img-circle border border-white"/>
        @endif
    @else
        <img src="{{ asset(env('PROFILE_ROOT').'/'.$user->filename_png)  }}?timestamp={{now()}}" class="mr-3 d-none d-sm-block col-md-12"  alt="{{$user->username}}"/>
        <a href="{{ route('quitarArchivoProfile/')  }}" class="btn btn-icon btn-light red mi-imagen-bajo-derecha" >
            <i class="mdi mdi-delete-empty mdi-18px"></i>
        </a>
    @endif
@endslot
@endcard
