@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ $users->total() }} {{str_plural('User',$users->count())}}</h4>
                <p class="card-category"> {{ __('Here you can manage users and invite a new teacher.') }}</p>
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
                  <div class="col-6 text-right">
                      @can('add_users')
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
                    @endcan
                  </div>
                  <div class="col-6 text-right">
                     
                    <a href="{{ route('invite.index') }}" class="btn btn-sm btn-primary">{{ __('Invite a new teacher') }}</a>
              
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          {{ __('Name') }}
                      </th>
                      <th>
                        {{ __('Email') }}
                      </th>
                      <th>
                          {{ __('Role') }}
                      </th>
                      <th>
                        {{ __('Creation date') }}
                      </th>
                      <th class="text-right">
                          @can('edit_users','delete_users')
                        {{ __('Actions') }}
                              @endcan
                      </th>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                        <tr>
                          <td>
                            {{ $user->name }}
                          </td>
                          <td>
                            {{ $user->email }}
                          </td>
                            <td>
                                {{ $user->roles->implode('name',', ') }}
                            </td>
                          <td>
                            {{ $user->created_at->toFormattedDateString() }}
                          </td>

                          <td class="td-actions text-right">
{{--                              @include('shared._actions', ['entity' => 'users','id'=>$user->id])--}}
                            @if ($user->id != auth()->id())
                              <form action="{{ route('users.destroy', $user) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  @can('edit_users')
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('users.edit', $user) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  @endcan
                                  @can('delete_users')
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                                  @endcan
                              </form>
                            @else
                                  @can('edit_users')
                              <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('profile.edit') }}" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                              @endcan
                            @endif
                          </td>

                        </tr>
                      @endforeach
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
