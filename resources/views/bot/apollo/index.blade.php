@extends('layouts.app', ['activePage' => 'apollo-management', 'titlePage' => __('Apollo Management')])

@section('content')

<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ $apollo->total() }} {{str_plural('Question',$apollo->count())}}</h4>
                            <p class="card-category"> {{ __('Here you can manage Apollo questions') }}</p>
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
                                    @can('add_apollo')
                                        <a href="{{ route('apollo.create') }}" class="btn btn-sm btn-primary">{{ __('Add Question') }}</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        {{ __('Question') }}
                                    </th>
                                    <th>
                                        {{ __('Answer') }}
                                    </th>
                                    <th>
                                        {{ __('Level') }}
                                    </th>
                                    <th>
                                        {{ __('Status') }}

                                    </th>
                                    <th>
                                        {{ __('Group ID') }}

                                    </th>
                                    <th>
                                        {{ __('Created by') }}

                                    </th>
                                    <th>
                                        {{ __('Creation date') }}
                                    </th>
                                    <th class="text-right">
                                        @can('edit_apollo','delete_apollo')
                                            {{ __('Actions') }}
                                        @endcan
                                    </th>
                                    </thead>
                                    <tbody>
                                    @if($apollo->total()>0)
                                        @foreach($apollo as $group)
                                            <tr>
                                                <td>
                                                    {{ $group->question }}
                                                </td>
                                                <td>
                                                    {{ $group->answer }}
                                                </td>
                                                <td>
                                                    {{ $group->level }}
                                                </td>
                                                @if($group->status==0)
                                                <td>

                                                    Not Answered
                                                </td>
                                                    @else
                                                    <td>

                                                        Answered
                                                    </td>
                                                @endif
                                                <td>
                                                    {{ $group->group_id }}
                                                </td>
                                                <td><a href="https://t.me/{{ $group->username }}">{{ $group->username }}</a></td>
                                                <td>
                                                    {{ $group->created_at->toFormattedDateString() }}
                                                </td>

                                                <td class="td-actions text-right">
                                                    {{--                              @include('shared._actions', ['entity' => 'users','id'=>$group->id])--}}

                                                    <form action="{{ route('apollo.destroy', $group) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        @can('edit_apollo')
                                                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('apollo.edit', $group) }}" data-original-title="" title="">
                                                                <i class="material-icons">edit</i>
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        @endcan
                                                        @can('delete_apollo')
                                                            <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this group?") }}') ? this.parentElement.submit() : ''">
                                                                <i class="material-icons">close</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        @endcan
                                                        <button type="button" class="btn btn-danger btn-link" data-toggle="modal" data-target=".bd-example-modal-sm" data-original-title="" title="" >
                                                            <i class="material-icons">chat</i>
                                                            <div class="ripple-container"></div>
                                                        </button>
                                                    </form>

                                                </td>

                                            </tr>
                                        @endforeach
                                        {{--    -    modal--}}
                                        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <form action="{{route('apollo.send',$apollo)}}" method="post">
                                                        @csrf
                                                        @method('post')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Post to Group</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="text" name="qid" value="{{$group->id}}" hidden>
                                                            <p class="card-text">Question: {{$group->question}}</p>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit"  class="btn btn-primary">POST</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{$apollo->links()}}
                                    @else
                                        <td>
                                            <p>No apollo created at the moment</p>
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
