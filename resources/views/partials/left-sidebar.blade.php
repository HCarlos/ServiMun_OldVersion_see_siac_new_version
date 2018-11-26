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

            {{--<li class="side-nav-title side-nav-item">OPCIONES</li>--}}

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="dripicons-browser"></i>
                    <span> Catálogos </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('listCategorias')}}">
                            <i class="fas fa-user-tag"></i>
                            <span class="badge badge-light float-right">{{\App\Models\Users\Categoria::count()}}</span>
                            <span>Categorias Usuario</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('listDependencias')}}">
                            <i class="mdi mdi-account-multiple-outline"></i>
                            <span class="badge badge-light float-right">{{\App\Models\Catalogos\Dependencia::count()}}</span>
                            <span>Dependencias</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('listAreas')}}">
                            <i class="mdi mdi-account-group"></i>
                            <span class="badge badge-light float-right">{{\App\Models\Catalogos\Area::count()}}</span>
                            <span>Áreas</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('listSubareas')}}">
                            <i class="fas fa-money-check-alt"></i>
                            <span class="badge badge-light float-right">{{\App\Models\Catalogos\Subarea::count()}}</span>
                            <span>Subareas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('listEstatus')}}">
                            <i class="fas fa-money-check-alt"></i>
                            <span class="badge badge-light float-right">{{\App\Models\Catalogos\Estatu::count()}}</span>
                            <span>Status</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('listMedidas')}}">
                            <i class="fas fa-money-check-alt"></i>
                            <span class="badge badge-light float-right">{{\App\Models\Catalogos\Medida::count()}}</span>
                            <span>Medidas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('listOrigenes')}}">
                            <i class="fas fa-money-check-alt"></i>
                            <span class="badge badge-light float-right">{{\App\Models\Catalogos\Origen::count()}}</span>
                            <span>Origenes</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('listPrioridades')}}">
                            <i class="fas fa-money-check-alt"></i>
                            <span class="badge badge-light float-right">{{\App\Models\Catalogos\Prioridad::count()}}</span>
                            <span>Prioridades</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('listServicios')}}">
                            <i class="fas fa-money-check-alt"></i>
                            <span class="badge badge-light float-right">{{\App\Models\Catalogos\Servicio::count()}}</span>
                            <span>Servicios</span>
                        </a>
                    </li>

                </ul>

            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="fas fa-cog"></i>
                    <span> Configuraciones </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('listUsers')}}">
                            <i class="fas fa-users"></i>
                            <span class="badge badge-success float-right">{{\App\User::count()}}</span>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('asignaRole',['Id'=>0])}}">
                            <i class="fas fa-users-cog"></i>
                            <span class="badge badge-light float-right">{{\App\Role::count()}}</span>
                            <span>Roles</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('asignaPermission',['Id'=>0])}}">
                            <i class="fas fa-user-cog"></i>
                            <span class="badge badge-light float-right">{{\App\Permission::count()}}</span>
                            <span>Permisos</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('archivosConfig')}}">
                            <i class="fas fa-file-excel"></i>
                            <span>Formatos Excel</span>
                        </a>
                    </li>

                </ul>

            </li>



        </ul>



        <div class="clearfix"></div>
    @endguest
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
