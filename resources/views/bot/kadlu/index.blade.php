@extends('layouts.app', ['activePage' => 'kadlu-management', 'titlePage' => __('Kadlu Management')])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ $kadlu->total() }} {{str_plural('Question',$kadlu->count())}}</h4>
                            <p class="card-category"> {{ __('Here you can manage Kadlu questions') }}</p>
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

                                    @can('add_kadlus','delete_kadlus')
                                        <button class="btn btn-warning btn-sm validate_all"
                                                data-url="{{ route('kadlusval') }}"><i class="material-icons">thumb_up</i>Validate
                                        </button>
                                        <button class="btn btn-danger btn-sm delete_all"
                                                data-url="{{ route('kadlusdel') }}"><i class="material-icons">delete</i>Delete
                                        </button>
                                        {{--                                        <a href="{{ route('apollexport') }}" class="btn btn-sm btn-success">{{ __('Export to Csv') }}</a>--}}
                                        <a href="#" onclick="window.print()" class="btn btn-sm btn-info"><i
                                                class="material-icons">print</i> Print</a>
                                        {{--                                        <a href="{{ route('walaview') }}" class="btn btn-sm btn-info">{{ __('Upload bulk') }}</a>--}}
                                        <a href="{{ route('kadlus.create') }}"
                                           class="btn btn-sm btn-primary">{{ __('Add Question') }}</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="ampl">

                                    <thead class=" text-primary">
                                    <th width="80px">
                                        {{ __('#') }}
                                    </th>
                                    <th width="50px"><input type="checkbox" id="master"></th>

                                    <th>
                                        {{ __('Title') }}
                                    </th>
                                    <th>
                                        {{ __('Question Type') }}
                                    </th>
                                    <th>
                                        {{ __('Level') }}
                                    </th>
                                    <th>
                                        {{ __('Validated') }}

                                    </th>
                                    <th>
                                        {{ __('Validated by') }}

                                    </th>
                                    <th>
                                        {{ __('Validation date') }}

                                    </th>

                                    <th>
                                        {{ __('Last edited by') }}
                                    </th>
                                    <th>
                                        {{ __('Date edited') }}
                                    </th>
                                    <th>
                                        {{ __('Created by') }}

                                    </th>
                                    <th>
                                        {{ __('Creation date') }}
                                    </th>

                                    <th class="text-right">
                                        @can('edit_kadlus','delete_kadlus')
                                            {{ __('Actions') }}
                                        @endcan
                                    </th>


                                    </thead>
                                    <tbody>
                                    @if($kadlu->total()>0)
                                        @foreach($kadlu as  $index =>$data)
                                            <tr id="tr_{{$data->id}}">
                                                <td>
                                                    <strong>{{ $index+1 }}.</strong>
                                                </td>
                                                <td><input type="checkbox" class="sub_chk" data-id="{{$data->id}}"></td>

                                                <td>
                                                    {{ $data->title }}
                                                </td>
                                                <td>
                                                    {{ $data->c_type }}
                                                </td>
                                                <td>
                                                    @if($data->level==1)
                                                        <span class="badge badge-pill badge-primary">Elementary</span>
                                                    @elseif($data->level==2)
                                                        <span class="badge badge-pill badge-warning">Intermediate</span>
                                                    @elseif($data->level==3)
                                                        <span class="badge badge-pill badge-danger">Advanced</span>
                                                    @endif

                                                </td>
                                                @if($data->validated==0)
                                                    <td>

                                                        <span class="badge badge-pill badge-info">Not Validated</span>
                                                    </td>
                                                @else
                                                    <td>

                                                        <span class="badge badge-pill badge-danger">Validated</span>
                                                    </td>
                                                @endif
                                                <td>
                                                    @if($data->validated_by==null)
                                                        <span class="badge badge-pill badge-info">No one</span>
                                                    @else
                                                        <a href="https://t.me/{{ $data->validated_by }}">{{ $data->validated_by }}</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($data->validated_at==null)
                                                        <span class="badge badge-pill badge-info">No date</span>
                                                    @else
                                                        {{ $data->validated_at }}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($data->edited_by==null)
                                                        No one
                                                    @else
                                                        <a href="https://t.me/{{ $data->edited_by }}">{{ $data->edited_by }}</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($data->updated_at==null)
                                                        <span class="badge badge-pill badge-info">No date</span>
                                                    @else
                                                        {{ $data->updated_at }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="https://t.me/{{ $data->created_by }}">{{ $data->created_by }}</a>
                                                </td>
                                                <td>
                                                    {{ $data->created_at }}
                                                </td>

                                                <td class="td-actions text-right">
                                                    {{--                              @include('shared._actions', ['entity' => 'users','id'=>$data->id])--}}
                                                    <form action="{{ route('kadlus.destroy', $data) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="btn btn-danger btn-link"
                                                                data-toggle="modal" data-target=".add-question{{$data->id}}"
                                                                rel="tooltip" title="Add Question">
                                                            <i class="material-icons">note_add</i>
                                                            <div class="ripple-container"></div>
                                                        </button>
                                                        @can('view_kadlus')
                                                            <button type="button" class="btn btn-danger btn-link"
                                                                    data-toggle="modal"
                                                                    data-target=".bd-example-modal-lg{{$data->id}}" rel="tooltip"
                                                                    title="View">
                                                                <i class="material-icons">chat</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        @endcan
                                                        @can('edit_kadlus')
                                                            <a rel="tooltip" class="btn btn-success btn-link"
                                                               href="{{ route('kadlus.edit', $data) }}"
                                                               data-original-title="" >
                                                                <i class="material-icons">edit</i>
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        @endcan
                                                        @can('delete_kadlus')

                                                            <button type="button" class="btn btn-danger btn-link"
                                                                    data-toggle="tooltip" rel="tooltip" title="Delete"
                                                                    onclick="confirm('{{ __("Note: This will delete all associate questions under this question,proceed?") }}') ? this.parentElement.submit() : ''">
                                                                <i class="material-icons">close</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        @endcan

                                                    </form>
                                                </td>


                                            </tr>

                                            <div class="modal fade bd-example-modal-lg{{$data->id}}" tabindex="-1" role="dialog"
                                                 aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="" method="post">
                                                            @csrf
                                                            {{--                                                        @method('post')--}}
                                                            <div class="modal-header card-header card-header-danger">
                                                                <h5 class="modal-title" id="exampleModalLabel">View
                                                                    question</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <label class="col-sm-2 col-form-label"><span
                                                                            class="badge badge-pill badge-info">{{ __('Title') }}</span>:</label>
                                                                    <div class="col-sm-7">
                                                                        <div class="form-group">
                                                                            <input class="form-control" type="text"
                                                                                   value="{{ old('title',$data->title) }}"
                                                                                   disabled>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <label class="col-sm-2 col-form-label"><span
                                                                            class="badge badge-pill badge-info">{{ __('Question Type') }}</span>:</label>
                                                                    <div class="col-sm-7">
                                                                        <div class="form-group">
                                                                            <input class="form-control" type="text"
                                                                                   value="{{ old('question',$data->c_type) }}"
                                                                                   disabled>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($data->c_type=='audio')
                                                                    <div class="row">
                                                                        <label class="col-sm-2 col-form-label"><span
                                                                                class="badge badge-pill badge-info">{{ __('Preview') }}</span>:</label>
                                                                        <div class="col-sm-7">
                                                                            <div class="form-group">
                                                                                <audio controls src="data:audio/wav;base64,{{$data->filename}}" id="audio"></audio>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif($data->c_type='video')
                                                                    <div class="row">
                                                                        <label class="col-sm-2 col-form-label"><span
                                                                                class="badge badge-pill badge-info">{{ __('Preview') }}</span>:</label>
                                                                        <div class="col-sm-7">
                                                                            <div class="form-group">
                                                                                <video width="500" height="200" controls src="data:audio/wav;base64,{{$data->filename}}" id="video"></video>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <div class="row">
                                                                    <label class="col-sm-2 col-form-label"><span
                                                                            class="badge badge-pill badge-info">{{ __('Level') }}</span>:</label>
                                                                    <div class="col-sm-7">
                                                                        <div class="form-group">
                                                                            @if($data->level==1)
                                                                                <span
                                                                                    class="badge badge-pill badge-primary">Elementary</span>
                                                                            @elseif($data->level==2)
                                                                                <span
                                                                                    class="badge badge-pill badge-warning">Intermediate</span>
                                                                            @elseif($data->level==3)
                                                                                <span class="badge badge-pill badge-danger">Advanced</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-sm-2 col-form-label"><span
                                                                            class="badge badge-pill badge-info">{{ __('Validated') }}</span>:</label>
                                                                    <div class="col-sm-7">
                                                                        <div class="form-group">
                                                                            @if($data->validated==0)


                                                                                <span
                                                                                    class="badge badge-pill badge-warning">False</span>

                                                                            @else


                                                                                <span class="badge badge-pill badge-danger">True</span>

                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-sm-2 col-form-label"><span
                                                                            class="badge badge-pill badge-info">{{ __('Validated by') }}</span>:</label>
                                                                    <div class="col-sm-7">
                                                                        <div class="form-group">
                                                                            @if($data->validated_by==null)
                                                                                <span
                                                                                    class="badge badge-pill badge-warning">No one</span>
                                                                            @else
                                                                                <a href="https://t.me/{{ $data->validated_by }}">{{ $data->validated_by }}</a>
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-sm-2 col-form-label"><span
                                                                            class="badge badge-pill badge-info">{{ __('Validated on') }}</span>:</label>
                                                                    <div class="col-sm-7">
                                                                        <div class="form-group">
                                                                            @if($data->validated_at==null)
                                                                                <span
                                                                                    class="badge badge-pill badge-warning">No date</span>
                                                                            @else
                                                                                {{ $data->validated_at }}
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-sm-2 col-form-label"><span
                                                                            class="badge badge-pill badge-info">{{ __('Last Edited by') }}</span>:</label>
                                                                    <div class="col-sm-7">
                                                                        <div class="form-group">
                                                                            @if($data->edited_by==null)
                                                                                No one
                                                                            @else
                                                                                <a href="https://t.me/{{ $data->edited_by }}">{{ $data->edited_by }}</a>
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-sm-2 col-form-label"><span
                                                                            class="badge badge-pill badge-info">{{ __('Last edited on') }}</span>:</label>
                                                                    <div class="col-sm-7">
                                                                        <div class="form-group">
                                                                            @if($data->updated_at==null)
                                                                                <span
                                                                                    class="badge badge-pill badge-warning">No date</span>
                                                                            @else
                                                                                {{ $data->updated_at }}
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-sm-2 col-form-label"><span
                                                                            class="badge badge-pill badge-info">{{ __('Created by') }}</span>:</label>
                                                                    <div class="col-sm-7">
                                                                        <div class="form-group">
                                                                            <a href="https://t.me/{{ $data->created_by }}">{{ $data->created_by }}</a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-sm-2 col-form-label"><span
                                                                            class="badge badge-pill badge-info">{{ __('Created on') }}</span>:</label>
                                                                    <div class="col-sm-7">
                                                                        <div class="form-group">
                                                                            {{ $data->created_at }}

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close
                                                                </button>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade add-question{{$data->id}}" tabindex="-1" role="dialog"
                                                 aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="{{ route('kadluqs.store') }}" method="post">
                                                            @csrf
                                                            @method('post')
                                                            <div class="modal-header card-header card-header-success">
                                                                <h5 class="modal-title" id="exampleModalLabel">Add associate
                                                                    question</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

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
                                                                                value="{{ old('question') }}"
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
                                                                                value="{{ old('answer_a') }}"
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
                                                                                value="{{ old('answer_b') }}"
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
                                                                                value="{{ old('answer_c') }}"
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
                                                                                value="{{ old('answer_d') }}"
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
                                                                            <div
                                                                                class="form-check form-check-radio form-check-inline">
                                                                                <label class="form-check-label">
                                                                                    <input class="form-check-input"
                                                                                           type="radio"
                                                                                           name="c_answer"
                                                                                           value="answer_a" required> A
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
                                                                                           name="c_answer"

                                                                                           value="answer_b" required> B
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
                                                                                           name="c_answer"

                                                                                           value="answer_c" required> C
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
                                                                                           name="c_answer"

                                                                                           value="answer_d" required> D
                                                                                    <span class="circle">
                                                                                        <span class="check"></span>
                                                                                </span>
                                                                                </label>
                                                                            </div>

                                                                            @if ($errors->has('c_answer'))
                                                                                <span id="c_answer-error"
                                                                                      class="error text-danger"
                                                                                      for="input-c_answer">{{ $errors->first('c_answer') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="text" name="kadlu_id" value=" {{$data->id}}" hidden>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">{{ __('Save Question') }}</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close
                                                                </button>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                        {{$kadlu->links()}}
                                    @else
                                        <td>
                                            <p>No Wala created at the moment</p>
                                        </td>
                                    @endif

                                    </tbody>

                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#exampl').DataTable({
                "stateSave": true,
                "ordering": true,
                "info": true,
                "paging": true,
                "pagingType": "full_numbers"
            });


            $('#master').on('click', function (e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });


            $('.delete_all').on('click', function (e) {


                var allVals = [];
                $(".sub_chk:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });


                if (allVals.length <= 0) {
                    alert("Please select question(s).");
                } else {


                    var check = confirm("Note: This will delete all associate questions under this question,proceed?");
                    if (check == true) {


                        var join_selected_values = allVals.join(",");


                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids=' + join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function () {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });


                    }
                }
            });

            $('.validate_all').on('click', function (e) {


                var allVals = [];
                $(".sub_chk:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });


                if (allVals.length <= 0) {
                    alert("Please select question(s).");
                } else {


                    var check = confirm("Are you sure you want to validate this question(s)?");
                    if (check == true) {


                        var join_selected_values = allVals.join(",");


                        $.ajax({
                            url: $(this).data('url'),
                            type: 'PUT',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids=' + join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    setTimeout(function () {// wait for 5 secs(2)
                                        location.reload(); // then reload the page.(3)
                                    }, 1000);
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });


                    }
                }
            });


        });
    </script>

@endsection
