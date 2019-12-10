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
      <li class="nav-item{{ $activePage ?? '' ?? '' == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage ?? '' ?? '' == 'profile' || $activePage ?? '' ?? '' == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
            <i class="material-icons">account_box</i>
          <p>{{ __('Users & Permissions') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage ?? '' ?? '' == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
              @can('add_users','edit_users', 'delete_users')
            <li class="nav-item{{ $activePage ?? '' ?? '' == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('users.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
                  <li class="nav-item{{ $activePage ?? '' ?? '' == 'user-management' ? ' active' : '' }}">
                      <a class="nav-link" href="{{ route('roles.index') }}">
                          <span class="sidebar-mini"> RM </span>
                          <span class="sidebar-normal"> {{ __('Roles & Permissions') }} </span>
                      </a>
                  </li>
              @endcan

          </ul>
        </div>
      </li>

        @can('add_apollo','edit_apollo', 'delete_apollo')
            <li class="nav-item{{ $activePage ?? '' ?? '' == 'apollo-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('apollo.index') }}">
                    <i class="material-icons">help</i>
                    <p>{{ __('Apollo Management') }}</p>
                </a>
            </li>
        @endcan

        @can('add_seshats','edit_seshats', 'delete_seshats')
            <li class="nav-item{{ $activePage ?? '' ?? '' == 'seshat-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('seshats.index') }}">
                    <i class="material-icons">add_a_photo</i>
                    <p>{{ __('Seshat Management') }}</p>
                </a>
            </li>
        @endcan


        @can('add_zalmos','edit_zalmos', 'delete_zalmos')
            <li class="nav-item{{ $activePage ?? '' ?? '' == 'seshat-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('zalmos.index') }}">
                    <i class="material-icons">mic</i>
                    <p>{{ __('Zalmoxis Management') }}</p>
                </a>
            </li>
        @endcan
        @can('add_gaias','edit_gaias', 'delete_gaias')
            <li class="nav-item{{ $activePage ?? '' ?? '' == 'gaia-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('gaias.index') }}">
                    <i class="material-icons">record_voice_over</i>
                    <p>{{ __('Gaia Management') }}</p>
                </a>
            </li>
        @endcan
        @can('add_africas','edit_africas', 'delete_africas')
            <li class="nav-item{{ $activePage ?? '' ?? '' == 'africa-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('africas.index') }}">
                    <i class="material-icons">swap_horizontal_circle</i>
                    <p>{{ __('Africa Management') }}</p>
                </a>
            </li>
        @endcan
        @can('add_leizis','edit_leizis', 'delete_leizis')
            <li class="nav-item{{ $activePage ?? '' ?? '' == 'leizi-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('leizis.index') }}">
                    <i class="material-icons">compare_arrows</i>
                    <p>{{ __('Leizi Management') }}</p>
                </a>
            </li>
        @endcan
        @can('add_groups','edit_groups', 'delete_groups')
            <li class="nav-item{{ $activePage ?? '' ?? '' == 'groups-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('groups.index') }}">
                    <i class="material-icons">groups-management</i>
                    <p>{{ __('Groups Management') }}</p>
                </a>
            </li>
        @endcan

    </ul>
  </div>
</div>
