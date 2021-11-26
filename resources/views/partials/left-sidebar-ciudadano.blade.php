<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu sidebar-atemun-bg" >

    <div class="slimscroll-menu ">

        <!-- LOGO -->
        <a href="/" class="logo text-left  pr-2 pl-2 pt-1 pb-1" style="background: #FFF">
            <span class="logo-lg">
                <img src="{{asset('images/web/logo-0.png')}}" >
            </span>
            <span class="logo-sm">
                <img src="{{asset('images/web/logo_sm.png')}}" >
            </span>
        </a>
    @guest()

    @else()
        <!--- Sidemenu -->
        <ul class="metismenu side-nav">
            <li class="side-nav-item">
                <a href="{{route('listDenunciasCiudadanas')}}" class="side-nav-link">
                    <i class="mdi dripicons-archive"></i>
                    <span class="badge badge-light float-right">{{\App\Models\Denuncias\Denuncia::where('ciudadano_id',Auth::user()->id)->count()}}</span>
                    <span>Mis Denuncias</span>
                </a>
            </li>
        </ul>
        <!-- Help Box -->
        <div class="help-box2 text-white text-center">
            <img src="/images/help-icon.svg" height="45" />
            <h5 class="mt-3">Aviso de Privacidad</h5>
            <p class="mb-3">Lea nuestro aviso de privacidad</p>
            <a href="/privacidad" target="_blank" class="btn btn-outline-light btn-sm">Leer</a>
        </div>
        <!-- end Help Box -->
        <div class="clearfix"></div>
    @endguest
    </div>
</div>
