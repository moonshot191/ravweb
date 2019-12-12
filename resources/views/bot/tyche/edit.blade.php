@extends('layouts.app', ['activePage' => 'tyche-management', 'titlePage' => __('Tyche Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" enctype="multipart/form-data" action="{{ route('tyches.update',$tyche) }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('put')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit Odin question') }}</h4>
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
                                        <a href="{{ route('tyches.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>

                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('Word') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group{{ $errors->has('question') ? ' has-danger' : '' }}">
                                                <input class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}"  name="question" id="input-que" type="text" placeholder="{{ __('Word') }}" value="{{ old('question',$tyche->question) }}" required="true" aria-required="true"/>
                                                @if ($errors->has('question'))
                                                    <span id="question-error" class="error text-danger" for="input-que">{{ $errors->first('question') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Question Level') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('level') ? ' has-danger' : '' }}">

                                            {!! Form::select('level', array(1 => 'Elementary', 2 => 'Intermediate',3=>'Advanced'), $tyche->level,['class' => 'form-control']); !!}
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
                                            @if($tyche->validated==true)
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
                                <button type="submit" class="btn btn-primary">{{ __('Update Odin') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
