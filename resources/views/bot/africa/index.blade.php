@extends('layouts.app', ['activePage' => 'africa-management', 'titlePage' => __('Africa Management')])

@section('content')

<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ $africa->total() }} {{str_plural('Question',$africa->count())}}</h4>
                            <p class="card-category"> {{ __('Here you can manage africa questions') }}</p>
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
                                    @can('add_africas')
                                        <a href="{{ route('africas.create') }}" class="btn btn-sm btn-info">{{ __('Upload questions') }}</a>
                                        <a href="{{ route('aexport') }}" class="btn btn-sm btn-success">{{ __('Export to CSV') }}</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        {{ __('Word(s)') }}
                                    </th>
                                    <th>
                                        {{ __('Meaning') }}
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
{{--                                    <th>--}}
{{--                                        {{ __('Validation date') }}--}}

{{--                                    </th>--}}

                                    <th>
                                        {{ __('Last edited by') }}
                                    </th>
{{--                                    <th>--}}
{{--                                        {{ __('Date edited') }}--}}
{{--                                    </th>--}}
                                    <th>
                                        {{ __('Created by') }}

                                    </th>
{{--                                    <th>--}}
{{--                                        {{ __('Creation date') }}--}}
{{--                                    </th>--}}
                                    <th class="text-right">
                                        @can('edit_africas','delete_africas')
                                            {{ __('Actions') }}
                                        @endcan
                                    </th>

                                    </thead>
                                    <tbody>
                                    @if($africa->total()>0)
                                        @foreach($africa as $group)
                                            <tr>
                                                <td>
                                                    {{ $group->question}}
                                                </td>
                                                <td>
                                                    {{ $group->answer}}
                                                </td>
                                                <td>
                                                    @if($group->level==1)
                                                        <span class="badge badge-pill badge-primary">Elementary</span>
                                                        @elseif($group->level==2)
                                                        <span class="badge badge-pill badge-warning">Intermediate</span>
                                                    @elseif($group->level==3)
                                                        <span class="badge badge-pill badge-danger">Advanced</span>
                                                        @endif

                                                </td>
                                                @if($group->validated==0)
                                                <td>

                                                    <span class="badge badge-pill badge-info">Not Validated</span>
                                                </td>
                                                    @else
                                                    <td>

                                                        <span class="badge badge-pill badge-danger">Validated</span>
                                                    </td>
                                                @endif
                                                <td>
                                                    @if($group->validated_by==null)
                                                        <span class="badge badge-pill badge-info">No one</span>
                                                    @else
                                                        <a href="https://t.me/{{ $group->validated_by }}">{{ $group->validated_by }}</a>
                                                    @endif
                                                </td>


                                                <td>
                                                    @if($group->edited_by==null)
                                                        No one
                                                    @else
                                                        <a href="https://t.me/{{ $group->edited_by }}">{{ $group->edited_by }}</a>
                                                    @endif
                                                </td>

                                                <td><a href="https://t.me/{{ $group->username }}">{{ $group->username }}</a></td>
{{--                                                <td>--}}
{{--                                                    {{ $group->created_at }}--}}
{{--                                                </td>--}}
                                                <td class="td-actions text-right">
                                                    {{--                              @include('shared._actions', ['entity' => 'users','id'=>$group->id])--}}

                                                    <form action="{{ route('africas.destroy', $group) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        @can('edit_africas')
                                                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('africas.edit', $group) }}" data-original-title="" title="Edit">
                                                                <i class="material-icons">edit</i>
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        @endcan
                                                        @can('delete_africas')
                                                            <button type="button" class="btn btn-danger btn-link" data-toggle="tooltip" rel="tooltip" title="Delete" onclick="confirm('{{ __("Are you sure you want to delete this question?") }}') ? this.parentElement.submit() : ''">
                                                                <i class="material-icons">close</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        @endcan
                                                        <button type="button" class="btn btn-danger btn-link" data-toggle="modal" data-target=".bd-example-modal-lg" rel="tooltip" title="View" >
                                                            <i class="material-icons">chat</i>
                                                            <div class="ripple-container"></div>
                                                        </button>
                                                    </form>

                                                </td>

                                            </tr>
                                        @endforeach
                                        {{--    -    modal--}}
                                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <form action="" method="post">
                                                        @csrf
{{--                                                        @method('post')--}}
                                                        <div class="modal-header card-header card-header-danger">
                                                            <h5 class="modal-title" id="exampleModalLabel">View question</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Word') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="text"  value="{{ old('question',$group->question) }}"  disabled>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Meaning') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="text"  value="{{ old('question',$group->answer) }}"  disabled>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Level') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        @if($group->level==1)
                                                                            <span class="badge badge-pill badge-primary">Elementary</span>
                                                                        @elseif($group->level==2)
                                                                            <span class="badge badge-pill badge-warning">Intermediate</span>
                                                                        @elseif($group->level==3)
                                                                            <span class="badge badge-pill badge-danger">Advanced</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Validated') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        @if($group->validated==0)


                                                                                <span class="badge badge-pill badge-warning">False</span>

                                                                        @else


                                                                                <span class="badge badge-pill badge-danger">True</span>

                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Validated by') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        @if($group->validated_by==null)
                                                                            <span class="badge badge-pill badge-warning">No one</span>
                                                                        @else
                                                                            <a href="https://t.me/{{ $group->validated_by }}">{{ $group->validated_by }}</a>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Validated on') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        @if($group->validated_at==null)
                                                                            <span class="badge badge-pill badge-warning">No date</span>
                                                                        @else
                                                                            {{ $group->validated_at }}
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Last Edited by') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        @if($group->edited_by==null)
                                                                            No one
                                                                        @else
                                                                            <a href="https://t.me/{{ $group->edited_by }}">{{ $group->edited_by }}</a>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Last edited on') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        @if($group->updated_at==null)
                                                                            <span class="badge badge-pill badge-warning">No date</span>
                                                                        @else
                                                                            {{ $group->updated_at }}
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Created by') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        <a href="https://t.me/{{ $group->username }}">{{ $group->username }}</a>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label"><span class="badge badge-pill badge-info">{{ __('Created on') }}</span>:</label>
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        {{ $group->created_at }}

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{$africa->links()}}
                                    @else
                                        <td>
                                            <p>No africa created at the moment</p>
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


@endsection
