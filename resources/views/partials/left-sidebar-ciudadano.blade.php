<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu sidebar-atemun-bg" >

    <div class="slimscroll-menu sidebar-atemun-bg">

        <!-- LOGO -->
        <a href="/" class="logo text-left"  style="background: #FFF">
            <span class="logo-lg">
                <img src="{{asset('images/web/logo-0.png')}}"  width="251" height="82" alt="" >
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

        <div class="clearfix"></div>
    @endguest
    </div>
</div>
