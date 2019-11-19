@extends('layouts.app', ['activePage' => 'seshat-management', 'titlePage' => __('Seshat Management')])
<style type="text/css">

    input[type=file]{

        display: inline;

    }

    #image_preview{

        border: 1px solid black;

        padding: 10px;
        width: 300px;
    }

    #image_preview img{

        width: 200px;
        align-content: center;
        padding: 5px;

    }

</style>
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" enctype="multipart/form-data" action="{{ route('seshats.update',$seshat) }}" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('put')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Edit Seshat Question') }}</h4>
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
                                        <a href="{{ route('seshats.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Image') }}</span>:</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <img src="{{ url('seshat/'.$seshat->img_path) }}" alt="..." class="img-thumbnail">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Replace:') }}</label>
                                    <div class="col-sm-7">
                                        <div class="img-fluid img-thumbnail" id="image_preview" > </div>
                                        <div class="form-group{{ $errors->has('') ? ' has-danger' : '' }}form-file-upload form-file-simple input-group">

                                            <input class="form-control-file form-file-upload" type="file" id="img_path" name="img_path" multiple/>


                                            @if ($errors->has('img_path'))
                                                <span id="img_path-error" class="error text-danger" for="input-img_path">{{ $errors->first('img_path') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Answer') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('answer') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" onkeyup="shuffle()" name="answer" id="input-ans" type="text" placeholder="{{ __('Answer') }}" value="{{ old('answer',$seshat->answer) }}" required="true" aria-required="true"/>
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
                                            <input class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" name="question" id="input-ques" type="text" placeholder="{{ __('Question auto generated') }}" value="{{ old('question',$seshat->question) }}" required="true" aria-required="true">
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

                                            {!! Form::select('level', array(1 => 'Elementary', 2 => 'Intermediate',3=>'Advanced'), $seshat->level,['class' => 'form-control']); !!}
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
                                            @if($seshat->validated==true)
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
                                <button type="submit" class="btn btn-primary">{{ __('Update Apollo') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>--}}


    <script type="text/javascript">



        $("#img_path").change(function(){

            $('#image_preview').html("");

            var total_file=document.getElementById("img_path").files.length;

            for(var i=0;i<total_file;i++)

            {

                $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");

            }

        });




    </script>
@endsection
