
@extends('layouts.app', ['activePage' => 'odin-management', 'titlePage' => __('Odin Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('odins.store') }}" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
                        @csrf
                        @method('post')

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Upload Questions') }}</h4>
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
                                        <a href="{{ route('sampleodin') }}" class="btn btn-sm btn-info">{{ __('Download sample Csv') }}</a>

                                        <a href="{{ route('odins.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>

                                    </div>
                                </div>
                                <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('CSV') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group{{ $errors->has('csv_file') ? ' has-danger' : '' }}form-file-upload form-file-simple input-group">

                                                <input class="form-control-file" type="file" id="csv_file" name="csv_file" required>


                                                @if ($errors->has('csv_file'))
                                                    <span id="csv_file-error" class="error text-danger" for="input-csv_file">{{ $errors->first('csv_file') }}</span>
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
