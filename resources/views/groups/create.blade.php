@extends('layouts.app', ['activePage' => 'groups-management', 'titlePage' => __('Groups Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('groups.store') }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('post')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Add Group') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('groups.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Group ID') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('group_id') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('group_id') ? ' is-invalid' : '' }}" name="group_id" id="input-group_id" type="text" placeholder="{{ __('Group ID') }}" value="{{ old('group_id') }}" required="true" aria-required="true"/>
                                            @if ($errors->has('group_id'))
                                                <span id="group_id-error" class="error text-danger" for="input-group_id">{{ $errors->first('group_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Group Title') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('group_title') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('group_title') ? ' is-invalid' : '' }}" name="group_title" id="input-title" type="text" placeholder="{{ __('Group title') }}" value="{{ old('group_title') }}" required="true" aria-required="true"/>
                                            @if ($errors->has('group_title'))
                                                <span id="group_title-error" class="error text-danger" for="input-title">{{ $errors->first('group_title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Group language') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('group_language') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('group_language') ? ' is-invalid' : '' }}" name="group_language" id="input-language" type="text" placeholder="{{ __('Group language') }}" value="{{ old('group_language') }}" required />
                                            @if ($errors->has('group_language'))
                                                <span id="group_language-error" class="error text-danger" for="input-language">{{ $errors->first('language') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="row">--}}
{{--                                    <label class="col-sm-2 col-form-label" for="input-admin">{{ __('Admin user id') }}</label>--}}
{{--                                    <div class="col-sm-7">--}}
{{--                                        <div class="form-group{{ $errors->has('group_admin') ? ' has-danger' : '' }}">--}}
                                            <input class="form-control{{ $errors->has('admin') ? ' is-invalid' : '' }}" input type="text" name="group_admin" id="input-admin" placeholder="{{ __('Admin') }}" value="{{auth()->user()->user_id}}" hidden>
{{--                                            @if ($errors->has('group_admin'))--}}
{{--                                                <span id="admin-error" class="error text-danger" for="input-admin">{{ $errors->first('group_admin') }}</span>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="input-token">{{ __('Bot Token') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('token') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('token') ? ' is-invalid' : '' }}" input type="text" name="token" id="input-token" placeholder="{{ __('Bot token') }}" value="" required />
                                            @if ($errors->has('token'))
                                                <span id="token-error" class="error text-danger" for="input-admin">{{ $errors->first('token') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Add Group') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
