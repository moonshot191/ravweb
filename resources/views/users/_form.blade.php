<!-- Name Form Input -->
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('Edit User') }}</h4>
        <p class="card-category"></p>
    </div>
    <div class="card-body ">
        <div class="row">
            <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
            <div class="col-sm-7">
        <div class="form-group @if ($errors->has('name')) has-error @endif">

            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
            @if ($errors->has('name')) <p class="error text-danger">{{ $errors->first('name') }}</p> @endif
        </div>
            </div>
        </div>
        <!-- email Form Input -->
            <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                <div class="col-sm-7">
        <div class="form-group @if ($errors->has('email')) has-error @endif">

            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
            @if ($errors->has('email')) <p class="error text-danger">{{ $errors->first('email') }}</p> @endif
        </div>
                </div>
            </div>
        <!-- password Form Input -->
                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Password') }}</label>
                    <div class="col-sm-7">
        <div class="form-group @if ($errors->has('password')) has-error @endif">

            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
            @if ($errors->has('password')) <p class="error text-danger">{{ $errors->first('password') }}</p> @endif
        </div>
                    </div>
                </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Confirm Password') }}</label>
                        <div class="col-sm-7">
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
                        </div>
                    </div>
        <!-- Roles Form Input -->
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Roles') }}</label>
                        <div class="col-sm-7">
        <div class="form-group @if ($errors->has('roles')) has-error @endif">

            {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null,  ['class' => 'form-control', 'multiple']) !!}
            @if ($errors->has('roles')) <p class="error text-danger">{{ $errors->first('roles') }}</p> @endif
        </div>
                        </div>
                    </div>
    </div>

</div>


<!-- Permissions -->
@if(isset($user))
    @include('shared._permissions', ['closed' => 'true', 'model' => $user ])
@endif
