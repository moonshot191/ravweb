@extends('layouts.app', ['activePage' => 'groups-management', 'titlePage' => __('Group Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ $groups->total() }} {{str_plural('Group',$groups->count())}}</h4>
                            <p class="card-category"> {{ __('Here you can manage Groups') }}</p>
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
                                    @can('add_groups')
                                        <a href="{{ route('groups.create') }}" class="btn btn-sm btn-primary">{{ __('Add Group') }}</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        {{ __('Group ID') }}
                                    </th>
                                    <th>
                                        {{ __('Group Title') }}
                                    </th>
                                    <th>
                                        {{ __('Group Language') }}
                                    </th>
                                    <th>
                                        {{ __('Added by') }}

                                    </th>
                                    <th>
                                        {{ __('Creation date') }}
                                    </th>
                                    <th class="text-right">
                                        @can('edit_groups','delete_groups')
                                            {{ __('Actions') }}
                                        @endcan
                                    </th>
                                    </thead>
                                    <tbody>
                                    @if($groups->total()>0)
                                    @foreach($groups as $group)
                                        <tr>
                                            <td>
                                                {{ $group->group_id }}
                                            </td>
                                            <td>
                                                {{ $group->group_title }}
                                            </td>
                                            <td>
                                                {{ $group->group_language }}
                                            </td>
                                            <td>
                                                {{$group->group_admin}}
{{--                                                {{ $group->roles->implode('name',', ') }}--}}
                                            </td>
                                            <td>
                                                {{ $group->created_at->toFormattedDateString() }}
                                            </td>

                                            <td class="td-actions text-right">
                                                {{--                              @include('shared._actions', ['entity' => 'users','id'=>$group->id])--}}

                                                    <form action="{{ route('groups.destroy', $group) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        @can('edit_groups')
                                                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('groups.edit', $group) }}" data-original-title="" title="">
                                                                <i class="material-icons">edit</i>
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        @endcan
                                                        @can('delete_groups')
                                                            <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this group?") }}') ? this.parentElement.submit() : ''">
                                                                <i class="material-icons">close</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        @endcan
                                                    </form>

                                            </td>

                                        </tr>
                                    @endforeach
                                        @else
                                        <td>
                                            <p>No groups created at the moment</p>
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
