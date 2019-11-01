
<div class="row">

    <div class="col-lg-6 col-md-12">
        <div class="row">
            <div class="col-md-6">
                <ul class="nav nav-pills nav-pills-icons flex-column" role="tablist">
                    <!--
                                        color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                                    -->
                    <li class="nav-item">
                        <a class="nav-link" href="#{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" role="tab" data-toggle="tab" aria-expanded="{{ isset($closed) ? 'on' : 'off' }}" aria-controls="{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
                            <i class="material-icons">dashboard</i>  {{ $title ?? 'Override Permissions' }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
                        </a>
                    </li>

                </ul>
            </div>
            <div class="col-md-6">
                <div class="tab-content">
                    <div aria-labelledby="{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" class="tab-pane {{ $closed ?? '' ?? '' == 'on' ? ' active' : ''}}" id="{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @foreach($permissions as $perm)
                                        <?php
                                        $per_found = null;
                                        if( isset($role) ) {
                                            $per_found = $role->hasPermissionTo($perm->name);
                                        }
                                        if( isset($user)) {
                                            $per_found = $user->hasDirectPermission($perm->name);
                                        }
                                        ?>

                                        <div class="col-md-5">
                                            <div class="checkbox">
                                                <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                                    {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                        @can('edit_roles')
                                            {!! Form::submit('Update', ['class' => 'btn btn-danger']) !!}
                                        @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!--                 end nav pills -->
