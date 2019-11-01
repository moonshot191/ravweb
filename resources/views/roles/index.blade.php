@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Roles & Permissions')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('Roles & Permissions') }}</h4>
                            <p class="card-category"> {{ __('Here you can manage Roles & Permissions') }}</p>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-12 text-right">
                                    @can('add_roles')
                                        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#roleModal">{{ __('Add Role') }}</a>
                                    @endcan
                                </div>
                            </div>
{{--data--}}
{{--                                start modal--}}
                                <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        {!! Form::open(['method' => 'post']) !!}

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group @if ($errors->has('name')) has-error @endif">
                                                    {!! Form::label('name', 'Name') !!}
                                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Role Name']) !!}
                                                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
{{--                            modal endd--}}

                                @forelse ($roles as $role)
                                    {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update',  $role->id ], 'class' => 'm-b']) !!}

                                    @if($role->name === 'Admin')
                                        @include('shared._permissions', [
                                                      'title' => $role->name .' Permissions',
                                                      'options' => ['disabled'] ])
                                    @else
                                        @include('shared._permissions', [
                                                      'title' => $role->name .' Permissions',
                                                      'model' => $role ])

                                    @endif

                                    {!! Form::close() !!}

                                @empty
                                    <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
                                @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
