
@extends('layouts.app', ['activePage' => 'kadlu-management', 'titlePage' => __('Kadlu Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('kadlus.store') }}" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('post')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Upload Question') }}</h4>
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
{{--                                        <a href="{{ route('download') }}" class="btn btn-sm btn-info">{{ __('Download sample Csv') }}</a>--}}

                                        <a href="{{ route('kadlus.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>

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
                                        <label
                                            class="col-sm-2 col-form-label">{{ __('Question Type') }}</label>
                                        <div class="col-sm-7">
                                            <div
                                                class="form-group{{ $errors->has('c_type') ? ' has-danger' : '' }}">
                                                <div
                                                    class="form-check form-check-radio form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input"
                                                               type="radio"
                                                               name="c_type"
                                                               value="audio" required> Audio
                                                        <span class="circle">
                                                                            <span class="check"></span>
                                                                                </span>
                                                    </label>
                                                </div>
                                                <div
                                                    class="form-check form-check-radio form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input"
                                                               type="radio"
                                                               name="c_type"

                                                               value="video" required> Video
                                                        <span class="circle">
                                                                                        <span class="check"></span>
                                                                                </span>
                                                    </label>
                                                </div>


                                                @if ($errors->has('c_type'))
                                                    <span id="c_type-error"
                                                          class="error text-danger"
                                                          for="input-c_type">{{ $errors->first('c_type') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('File') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group{{ $errors->has('filename') ? ' has-danger' : '' }}form-file-upload form-file-simple input-group">

                                                <input class="form-control-file" type="file" id="filename" name="filename" required>


                                                @if ($errors->has('filename'))
                                                    <span id="filename-error" class="error text-danger" for="input-filename">{{ $errors->first('filename') }}</span>
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
                                <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
