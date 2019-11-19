@extends('layouts.app', ['activePage' => 'apollo-management', 'titlePage' => __('Apollo Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('apollo.store') }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('post')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Add Apollo Question') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('apollo.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Answer') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('answer') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" onkeyup="shuffle()" name="answer" id="input-answer" type="text" placeholder="{{ __('Answer') }}" value="{{ old('answer') }}" required="true" aria-required="true"/>
                                            @if ($errors->has('answer'))
                                                <span id="answer-error" class="error text-danger" for="input-answer">{{ $errors->first('answer') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Question') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('question') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" name="question" id="input-question" type="text" placeholder="{{ __('Question auto generated') }}" value="{{ old('question') }}" required="true" aria-required="true">
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
{{--                                <div class="row">--}}
{{--                                    <label class="col-sm-2 col-form-label">{{ __('Group ') }}</label>--}}
{{--                                    <div class="col-sm-7">--}}
{{--                                        <div class="form-group{{ $errors->has('group_id') ? ' has-danger' : '' }}">--}}

{{--                                            {!! Form::select('level', array(1 => 'Elementary', 2 => 'Intermediate',3=>''), 1,['class' => 'form-control']); !!}--}}
{{--                                            {!! Form::select('group_id', $groups, 1, ['class' => 'form-control']) !!}--}}

{{--                                            @if ($errors->has('group_id'))--}}
{{--                                                <span id="group_id-error" class="error text-danger" for="input-group_id">{{ $errors->first('group_id') }}</span>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <input type="text" name="user_id" hidden>--}}
                                <input type="text" name="group_id" value="-1001278314934" hidden>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Add Apollo') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
