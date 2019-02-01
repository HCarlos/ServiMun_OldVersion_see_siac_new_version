<!-- Topbar Start -->
@guest
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
            <div class="navbar-nav navbar-right navbar-right">
                <a class="nav-item nav-link active" href="/">Inicio <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link right font_Raleway_400" href="{{ route('login') }}">{{ __('Login') }}</a>
            </div>
    </nav>
@else

<div class="navbar-custom">

    <ul class="list-unstyled topbar-right-menu float-right mb-0">

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
               aria-expanded="false">
                <span class="account-user-avatar">
                    @if( Auth::user()->IsEmptyPhoto() )
                        @if( Auth::user()->IsFemale() )
                            <img src="{{ asset('images/web/empty_user_female.png')  }}" width="28" height="28" class="img-circle border border-white"/>
                        @else
                            <img src="{{ asset('images/web/empty_user_male.png')  }}" width="28" height="28" class="img-circle border border-white"/>
                        @endif
                    @else
                        <img src="{{ asset(env('PROFILE_ROOT').'/'.Auth::user()->filename_thumb) }}?timestamp={{now()}}" width="40" height="40" class="mr-3 d-none d-sm-block avatar-sm rounded-circle " alt="{{Auth::user()->username}}"/>
                    @endif
                </span>
                <span>
                    <span class="account-user-name">{{ Auth::user()->username }}</span>
                    <span class="account-position">{{ Auth::user()->Role()->name }}</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">
                        @if( Auth::user()->IsFemale() )
                            Bienvenida!
                        @else
                            Bienvenido!
                        @endif
                    </h6>
                </div>

                <!-- item-->
                <a href="{{url('edit')}}" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-settings-variant"></i>
                    <span>Mi Perfil</span>
                </a>

                <!-- item-->
                <a href="{{url('showEditProfilePhoto')}}" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle"></i>
                    <span>Mi Foto</span>
                </a>

                <!-- item-->
                <a href="{{url('showEditProfilePassword')}}" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-key"></i>
                    <span>Mi Password</span>
                </a>

                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        </li>

    </ul>
    @include('shared.search.__search_word_in_list')
    @include('shared.search.__search_denuncia_adress_list')
    @include('shared.search.__search_alumno_baca_list')
    @include('shared.search.__search_empty_tool_list')
</div>
@endguest

<!-- end Topbar -->
