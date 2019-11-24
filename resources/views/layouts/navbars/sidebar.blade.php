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
        @can('add_groups','edit_groups', 'delete_groups')
      <li class="nav-item{{ $activePage ?? '' ?? '' == 'groups-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('groups.index') }}">
          <i class="material-icons">groups-management</i>
            <p>{{ __('Groups Management') }}</p>
        </a>
      </li>
        @endcan

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
                <a class="nav-link" href="{{ route('zalmox.index') }}">
                    <i class="material-icons">mic</i>
                    <p>{{ __('Zalmoxis Management') }}</p>
                </a>
            </li>
        @endcan
{{--        <li class="nav-item{{ $activePage ?? '' ?? '' == 'table' ? ' active' : '' }}">--}}
{{--            <a class="nav-link" href="{{ route('table') }}">--}}
{{--                <i class="material-icons">content_paste</i>--}}
{{--                <p>{{ __('Table List') }}</p>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--      <li class="nav-item{{ $activePage ?? '' ?? '' == 'typography' ? ' active' : '' }}">--}}
{{--        <a class="nav-link" href="{{ route('typography') }}">--}}
{{--          <i class="material-icons">library_books</i>--}}
{{--            <p>{{ __('Typography') }}</p>--}}
{{--        </a>--}}
{{--      </li>--}}
{{--      <li class="nav-item{{ $activePage ?? '' ?? '' == 'icons' ? ' active' : '' }}">--}}
{{--        <a class="nav-link" href="{{ route('icons') }}">--}}
{{--          <i class="material-icons">bubble_chart</i>--}}
{{--          <p>{{ __('Icons') }}</p>--}}
{{--        </a>--}}
{{--      </li>--}}
{{--      <li class="nav-item{{ $activePage ?? '' ?? '' == 'map' ? ' active' : '' }}">--}}
{{--        <a class="nav-link" href="{{ route('map') }}">--}}
{{--          <i class="material-icons">location_ons</i>--}}
{{--            <p>{{ __('Maps') }}</p>--}}
{{--        </a>--}}
{{--      </li>--}}
{{--      <li class="nav-item{{ $activePage ?? '' ?? '' == 'notifications' ? ' active' : '' }}">--}}
{{--        <a class="nav-link" href="{{ route('notifications') }}">--}}
{{--          <i class="material-icons">notifications</i>--}}
{{--          <p>{{ __('Notifications') }}</p>--}}
{{--        </a>--}}
{{--      </li>--}}
{{--      <li class="nav-item{{ $activePage ?? '' ?? '' == 'language' ? ' active' : '' }}">--}}
{{--        <a class="nav-link" href="{{ route('language') }}">--}}
{{--          <i class="material-icons">language</i>--}}
{{--          <p>{{ __('RTL Support') }}</p>--}}
{{--        </a>--}}
{{--      </li>--}}
{{--      <li class="nav-item active-pro{{ $activePage ?? '' ?? '' == 'upgrade' ? ' active' : '' }}">--}}
{{--        <a class="nav-link" href="{{ route('upgrade') }}">--}}
{{--          <i class="material-icons">unarchive</i>--}}
{{--          <p>{{ __('Upgrade to PRO') }}</p>--}}
{{--        </a>--}}
{{--      </li>--}}
    </ul>
  </div>
</div>
