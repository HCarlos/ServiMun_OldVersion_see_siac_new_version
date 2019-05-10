<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!-- LOGO -->
        <a href="/" class="logo text-left">
            <span class="logo-lg">
                <img src="{{asset('images/logo-interior.png')}}" alt="" >
            </span>
            <span class="logo-sm">
                <img src="{{asset('images/logo_sm.png')}}" >
            </span>
        </a>
    @guest()
    @else()
        <!--- Sidemenu -->
        <ul class="metismenu side-nav">
            <ul class="side-nav-second-level" aria-expanded="true">
                <li>
                    <a href="{{route('listDenunciasCiudadanas')}}">
                        <i class="mdi modal-dialog-popout"></i>
                        <span class="badge badge-light float-right">{{\App\Models\Denuncias\Denuncia::where('ciudadano_id',Auth::user()->id)->count()}}</span>
                        <span>Mis Reportes</span>
                    </a>
                </li>
            </ul>
        </ul>

        <div class="clearfix"></div>
    @endguest
    </div>
</div>
