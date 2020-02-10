<div class="sidebar" data-color="danger" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="#" class="simple-text logo-normal">
            {{ __('Learning Creators') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
                    <i class="material-icons">account_box</i>
                    <p>{{ __('Users & Permissions') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="laravelExample">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage  == 'profile' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini"> UP </span>
                                <span class="sidebar-normal">{{ __('User profile') }} </span>
                            </a>
                        </li>
                        @can('add_users','edit_users', 'delete_users')
                            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('users.index') }}">
                                    <span class="sidebar-mini"> UM </span>
                                    <span class="sidebar-normal"> {{ __('User Management') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'user-invite' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('users.invite') }}">
                                    <span class="sidebar-mini"> UI </span>
                                    <span class="sidebar-normal"> {{ __('User Invite') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'roles-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('roles.index') }}">
                                    <span class="sidebar-mini"> RM </span>
                                    <span class="sidebar-normal"> {{ __('Roles & Permissions') }} </span>
                                </a>
                            </li>


                        @endcan

                    </ul>
                </div>
            </li>
            @can('add_africas','edit_africas', 'delete_africas')
                <li class="nav-item{{ $activePage  == 'africa-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('africas.index') }}">
                        <i class="material-icons">swap_horizontal_circle</i>
                        <p>{{ __('Africa Management') }}</p>
                    </a>
                </li>
            @endcan
            @can('add_apollo','edit_apollo', 'delete_apollo')
                <li class="nav-item{{ $activePage == 'apollo-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('apollo.index') }}">
                        <i class="material-icons">help</i>
                        <p>{{ __('Apollo Management') }}</p>
                    </a>
                </li>
            @endcan
            @can('add_gaias','edit_gaias', 'delete_gaias')
                <li class="nav-item{{ $activePage  == 'gaia-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('gaias.index') }}">
                        <i class="material-icons">record_voice_over</i>
                        <p>{{ __('Gaia Management') }}</p>
                    </a>
                </li>
            @endcan
            <li class="nav-item {{ ($activePage == 'kadlu-management' || $activePage == 'kadlu-management') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#kadlu" aria-expanded="true">
                    <i class="material-icons">perm_camera_mic</i>
                    <p>{{ __('Kadlu Management') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="kadlu">
                    <ul class="nav">
                        @can('add_kadlus','edit_kadlus', 'delete_kadlus')
                            <li class="nav-item{{ $activePage  == 'kadlu-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('kadlus.index') }}">
                                    <span class="sidebar-mini"> WM </span>
                                    <span class="sidebar-normal">{{ __('Main Exercises') }} </span>
                                </a>
                            </li>
                        @endcan
                        @can('add_kadluqs','edit_kadluqs', 'delete_kadluqs')

                            <li class="nav-item{{ $activePage == 'kadluq-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('kadluqs.index') }}">
                                    <span class="sidebar-mini"> KAM </span>
                                    <span class="sidebar-normal"> {{ __('Associate Questions') }} </span>
                                </a>
                            </li>
                        @endcan


                    </ul>
                </div>
            </li>
            @can('add_leizis','edit_leizis', 'delete_leizis')
                <li class="nav-item{{ $activePage  == 'leizi-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('leizis.index') }}">
                        <i class="material-icons">compare_arrows</i>
                        <p>{{ __('Leizi Management') }}</p>
                    </a>
                </li>
            @endcan
            @can('add_nuwas','edit_nuwas', 'delete_nuwas')
                <li class="nav-item{{ $activePage  == 'nuwa-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('nuwas.index') }}">
                        <i class="material-icons">hearing</i>
                        <p>{{ __('Nuwa Management') }}</p>
                    </a>
                </li>
            @endcan
            @can('add_odins','edit_odins', 'delete_odins')
                <li class="nav-item{{ $activePage  == 'odin-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('odins.index') }}">
                        <i class="material-icons">remove_red_eye</i>
                        <p>{{ __('Odin Management') }}</p>
                    </a>
                </li>
            @endcan
            @can('add_seshats','edit_seshats', 'delete_seshats')
                <li class="nav-item{{ $activePage  == 'seshat-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('seshats.index') }}">
                        <i class="material-icons">add_a_photo</i>
                        <p>{{ __('Seshat Management') }}</p>
                    </a>
                </li>
            @endcan
            @can('add_tyches','edit_tyches', 'delete_tyches')
                <li class="nav-item{{ $activePage  == 'tyche-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('tyches.index') }}">
                        <i class="material-icons">sort_by_alpha</i>
                        <p>{{ __('Tyche Management') }}</p>
                    </a>
                </li>
            @endcan
            <li class="nav-item {{ ($activePage == 'wala' || $activePage == 'wala-management') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#wala" aria-expanded="true">
                    <i class="material-icons">extension</i>
                    <p>{{ __('Wala Management') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="wala">
                    <ul class="nav">
                        @can('add_walas','edit_walas', 'delete_walas')
                            <li class="nav-item{{ $activePage  == 'wala-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('walas.index') }}">
                                    <span class="sidebar-mini"> WM </span>
                                    <span class="sidebar-normal">{{ __('Main Exercises') }} </span>
                                </a>
                            </li>
                        @endcan
                        @can('add_walaqs','edit_walaqs', 'delete_walaqs')

                            <li class="nav-item{{ $activePage == 'walaq-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('walaqs.index') }}">
                                    <span class="sidebar-mini"> WAM </span>
                                    <span class="sidebar-normal"> {{ __('Associate Questions') }} </span>
                                </a>
                            </li>
                        @endcan


                    </ul>
                </div>
            </li>
            @can('add_zalmos','edit_zalmos', 'delete_zalmos')
                <li class="nav-item{{ $activePage  == 'seshat-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('zalmos.index') }}">
                        <i class="material-icons">mic</i>
                        <p>{{ __('Zalmoxis Management') }}</p>
                    </a>
                </li>
            @endcan







            {{--        @can('add_groups','edit_groups', 'delete_groups')--}}
            {{--            <li class="nav-item{{ $activePage  == 'groups-management' ? ' active' : '' }}">--}}
            {{--                <a class="nav-link" href="{{ route('groups.index') }}">--}}
            {{--                    <i class="material-icons">groups-management</i>--}}
            {{--                    <p>{{ __('Groups Management') }}</p>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--        @endcan--}}
        </ul>
    </div>
</div>
