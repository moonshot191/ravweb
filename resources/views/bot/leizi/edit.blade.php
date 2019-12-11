@extends('layouts.app', ['activePage' => 'leizi-management', 'titlePage' => __('Leizi Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" enctype="multipart/form-data" action="{{ route('leizis.update',$leizi) }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('put')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit Leizi question') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                @if (session('status'))
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                <span>{{ session('status') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('leizis.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Instructions') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group{{ $errors->has('instruction') ? ' has-danger' : '' }}">
                                                <input class="form-control{{ $errors->has('instruction') ? ' is-invalid' : '' }}"  name="instruction" id="input-que" type="text" placeholder="{{ __('Instructions') }}" value="{{ old('instruction',$leizi->instruction) }}" required="true" aria-required="true"/>
                                                @if ($errors->has('instruction'))
                                                    <span id="queinstruction-error" class="error text-danger" for="input-que">{{ $errors->first('instruction') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Question') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group{{ $errors->has('question') ? ' has-danger' : '' }}">
                                                <input class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}"  name="question" id="input-que" type="text" placeholder="{{ __('Word') }}" value="{{ old('question',$leizi->question) }}" required="true" aria-required="true"/>
                                                @if ($errors->has('question'))
                                                    <span id="question-error" class="error text-danger" for="input-que">{{ $errors->first('question') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Answer') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('answer') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}"  name="answer" id="input-ans" type="text" placeholder="{{ __('Answer') }}" value="{{ old('answer',$leizi->answer) }}" required="true" aria-required="true"/>
                                            @if ($errors->has('answer'))
                                                <span id="answer-error" class="error text-danger" for="input-answer">{{ $errors->first('answer') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Alt-Answer') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group{{ $errors->has('alternative') ? ' has-danger' : '' }}">
                                                <input class="form-control{{ $errors->has('alternative') ? ' is-invalid' : '' }}"  name="alternative" id="input-alternative" type="text" placeholder="{{ __('Alternative Answer') }}" value="{{ old('alternative',$leizi->alternative) }}" aria-required="true"/>
                                                @if ($errors->has('alternative'))
                                                    <span id="alternative-error" class="error text-danger" for="input-alternative">{{ $errors->first('alternative') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Question Level') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('level') ? ' has-danger' : '' }}">

                                            {!! Form::select('level', array(1 => 'Elementary', 2 => 'Intermediate',3=>'Advanced'), $leizi->level,['class' => 'form-control']); !!}
                                            {{--                                            {!! Form::select('product_id', $groups, 1, ['class' => 'form-control']) !!}--}}

                                            @if ($errors->has('level'))
                                                <span id="level-error" class="error text-danger" for="input-level">{{ $errors->first('level') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Validate ') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('validated') ? ' has-danger' : '' }}">
                                            @if($leizi->validated==true)
                                                <div class="togglebutton">
                                                    <label>
                                                        <input type="checkbox" name="validated" id="validated" checked="">
                                                        <span class="toggle"></span>
                                                        Validated
                                                    </label>
                                                </div>
                                            @else
                                                <div class="togglebutton">
                                                    <label>
                                                        <input type="checkbox" name="validated" id="validated">
                                                        <span class="toggle"></span>
                                                        Validate
                                                    </label>
                                                </div>
                                            @endif
                                            @if ($errors->has('validated'))
                                                <span id="validated-error" class="error text-danger" for="input-validated">{{ $errors->first('validated') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <input type="text" name="edited_by" hidden>
                                <input type="text" name="validated_by" hidden>
                                <input type="text" name="validated_at" hidden>
                                {{--                                <input type="text" name="user_id" hidden>--}}
                                {{--                                <input type="text" name="username" hidden>--}}
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Update Leizi') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
