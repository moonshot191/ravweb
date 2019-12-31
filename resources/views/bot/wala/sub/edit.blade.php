@extends('layouts.app', ['activePage' => 'walaq-management', 'titlePage' => __('Wala associate questions Management')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('walaqs.update',$walaq) }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('put')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit Wala Associate Question') }}</h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('walaqs.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Main Question') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="input-title" type="text" placeholder="{{ __('Main question') }}" value="{{ old('title',$walaq->wala->question) }}" disabled/>
                                            @if ($errors->has('title'))
                                                <span id="title-error" class="error text-danger" for="input-title">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                    <div class="row">
                                        <label
                                            class="col-sm-2 col-form-label">{{ __('Question') }}</label>
                                        <div class="col-sm-7">
                                            <div
                                                class="form-group{{ $errors->has('question') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}"
                                                    name="question" id="input-question"
                                                    type="text"
                                                    placeholder="{{ __('Question description') }}"
                                                    value="{{ old('question',$walaq->question) }}"
                                                    required="true" aria-required="true">
                                                @if ($errors->has('question'))
                                                    <span id="question-error"
                                                          class="error text-danger"
                                                          for="input-question">{{ $errors->first('question') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label
                                            class="col-sm-2 col-form-label">{{ __('Answer A') }}</label>
                                        <div class="col-sm-7">
                                            <div
                                                class="form-group{{ $errors->has('answer_a') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('answer_a') ? ' is-invalid' : '' }}"
                                                    name="answer_a" id="input-answer_a"
                                                    type="text"
                                                    placeholder="{{ __('Answer A') }}"
                                                    value="{{ old('answer_a',$walaq->answer_a) }}"
                                                    required="true" aria-required="true"/>
                                                @if ($errors->has('answer_a'))
                                                    <span id="answer_a-error"
                                                          class="error text-danger"
                                                          for="input-answer_a">{{ $errors->first('answer_a') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label
                                            class="col-sm-2 col-form-label">{{ __('Answer B') }}</label>
                                        <div class="col-sm-7">
                                            <div
                                                class="form-group{{ $errors->has('answer_b') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('answer_b') ? ' is-invalid' : '' }}"
                                                    name="answer_b" id="input-answer_b"
                                                    type="text"
                                                    placeholder="{{ __('Answer B') }}"
                                                    value="{{ old('answer_b',$walaq->answer_b) }}"
                                                    required="true" aria-required="true"/>
                                                @if ($errors->has('answer_b'))
                                                    <span id="answer_b-error"
                                                          class="error text-danger"
                                                          for="input-answer_b">{{ $errors->first('answer_b') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label
                                            class="col-sm-2 col-form-label">{{ __('Answer C') }}</label>
                                        <div class="col-sm-7">
                                            <div
                                                class="form-group{{ $errors->has('answer_c') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('answer_c') ? ' is-invalid' : '' }}"
                                                    name="answer_c" id="input-answer_c"
                                                    type="text"
                                                    placeholder="{{ __('Answer C') }}"
                                                    value="{{ old('answer_c',$walaq->answer_c) }}"
                                                    required="true" aria-required="true"/>
                                                @if ($errors->has('answer_c'))
                                                    <span id="answer_c-error"
                                                          class="error text-danger"
                                                          for="input-answer_c">{{ $errors->first('answer_c') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label
                                            class="col-sm-2 col-form-label">{{ __('Answer D') }}</label>
                                        <div class="col-sm-7">
                                            <div
                                                class="form-group{{ $errors->has('answer_d') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('answer_d') ? ' is-invalid' : '' }}"
                                                    name="answer_d" id="input-answer_d"
                                                    type="text"
                                                    placeholder="{{ __('Answer D') }}"
                                                    value="{{ old('answer_d',$walaq->answer_d) }}"
                                                    required="true" aria-required="true"/>
                                                @if ($errors->has('answer_d'))
                                                    <span id="answer_d-error"
                                                          class="error text-danger"
                                                          for="input-answer_d">{{ $errors->first('answer_d') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label
                                            class="col-sm-2 col-form-label">{{ __('Correct Answer') }}</label>
                                        <div class="col-sm-7">
                                            <div
                                                class="form-group{{ $errors->has('c_answer') ? ' has-danger' : '' }}">
                                                @if($walaq->c_answer=='answer_a')
                                                <div class="form-check form-check-radio form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input"
                                                               type="radio"
                                                               name="c_answer"
                                                               value="answer_a" checked> A
                                                        <span class="circle"><span class="check"></span></span>
                                                    </label>

                                                </div>
                                                    @else
                                                    <div class="form-check form-check-radio form-check-inline">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input"
                                                                   type="radio"
                                                                   name="c_answer"
                                                                   value="answer_a" required > A
                                                            <span class="circle"><span class="check"></span></span>
                                                        </label>

                                                    </div>
                                                @endif
                                                    @if($walaq->c_answer=='answer_b')
                                                <div class="form-check form-check-radio form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input"
                                                               type="radio"
                                                               name="c_answer"

                                                               value="answer_b" required> B
                                                        <span class="circle">
                                                                                        <span class="check"></span>
                                                                                </span>
                                                    </label>
                                                </div>
                                                    @else
                                                        <div class="form-check form-check-radio form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input"
                                                                       type="radio"
                                                                       name="c_answer"

                                                                       value="answer_b"  checked> B
                                                                <span class="circle">
                                                                                        <span class="check"></span>
                                                                                </span>
                                                            </label>
                                                        </div>
                                                        @endif
                                                    @if($walaq->c_answer=='answer_c')
                                                <div class="form-check form-check-radio form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input"
                                                               type="radio"
                                                               name="c_answer"

                                                               value="answer_c"  checked> C
                                                        <span class="circle">
                                                                                        <span class="check"></span>
                                                                                </span>
                                                    </label>
                                                </div>
                                                    @else
                                                        <div class="form-check form-check-radio form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input"
                                                                       type="radio"
                                                                       name="c_answer"

                                                                       value="answer_c" required> C
                                                                <span class="circle">
                                                                                        <span class="check"></span>
                                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                    @if($walaq->c_answer=='answer_d')
                                                <div class="form-check form-check-radio form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input"
                                                               type="radio"
                                                               name="c_answer"

                                                               value="answer_d"  checked> D
                                                        <span class="circle">
                                                                                        <span class="check"></span>
                                                                                </span>
                                                    </label>
                                                </div>
                                                    @else
                                                        <div class="form-check form-check-radio form-check-inline">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input"
                                                                       type="radio"
                                                                       name="c_answer"

                                                                       value="answer_d" required> D
                                                                <span class="circle">
                                                                                        <span class="check"></span>
                                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endif

                                                @if ($errors->has('c_answer'))
                                                    <span id="c_answer-error"
                                                          class="error text-danger"
                                                          for="input-c_answer">{{ $errors->first('c_answer') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Validate ') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('validated') ? ' has-danger' : '' }}">
                                            @if($walaq->validated==true)
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
                                <input type="text" name="wala_id" value=" {{$walaq->wala->id}}" hidden>
                                <input type="text" name="edited_by" hidden>
                                <input type="text" name="validated_by" hidden>
                                <input type="text" name="validated_at" hidden>
                                {{--                                <input type="text" name="user_id" hidden>--}}
                                {{--                                <input type="text" name="username" hidden>--}}
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Update Question') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
