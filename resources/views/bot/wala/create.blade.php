@extends('layouts.app', ['activePage' => 'wala-management', 'titlePage' => __('Wala Management')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('walas.store') }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('post')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Add Wala Question') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('walas.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Question title') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"  name="title" id="input-title" type="text" placeholder="{{ __('Question Title') }}" value="{{ old('title') }}" required="true" aria-required="true"/>
                                            @if ($errors->has('title'))
                                                <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Question') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('question') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" name="question" id="input-question" type="text" placeholder="{{ __('Question description') }}" value="{{ old('question') }}" required="true" aria-required="true">
                                            @if ($errors->has('question'))
                                                <span id="question-error" class="error text-danger" for="input-title">{{ $errors->first('question') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Question Level') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('level') ? ' has-danger' : '' }}">

                                            {!! Form::select('level', array(1 => 'Elementary', 2 => 'Intermediate',3=>'Advanced'), 1,['class' => 'form-control']); !!}
{{--                                            {!! Form::select('product_id', $groups, 1, ['class' => 'form-control']) !!}--}}

                                            @if ($errors->has('level'))
                                                <span id="level-error" class="error text-danger" for="input-level">{{ $errors->first('level') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Save Question') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
