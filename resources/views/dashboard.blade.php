@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">help</i>
              </div>
              <p class="card-category">Apollo</p>
              <h3 class="card-title">{{$apollo}}
                <small>Questions</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">home</i>
                <a href="{{route('apollo.index')}}">View</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">add_a_photo</i>
              </div>
              <p class="card-category">Seshat</p>
              <h3 class="card-title">{{$seshat}}
                  <small>Questions</small>
              </h3>
            </div>
              <div class="card-footer">
                  <div class="stats">
                      <i class="material-icons text-danger">home</i>
                      <a href="{{route('seshats.index')}}">View</a>
                  </div>
              </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">mic</i>
              </div>
              <p class="card-category">Zalmoxis</p>
              <h3 class="card-title">{{$zalmo}}
                  <small>Questions</small></h3>
            </div>
              <div class="card-footer">
                  <div class="stats">
                      <i class="material-icons text-danger">home</i>
                      <a href="{{route('zalmos.index')}}">View</a>
                  </div>
              </div>
          </div>
        </div>

      </div>
      <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                  <div class="card-header card-header-info card-header-icon">
                      <div class="card-icon">
                          <i class="material-icons">record_voice_over</i>
                      </div>
                      <p class="card-category">Gaia</p>
                      <h3 class="card-title">{{$gaia}}
                          <small>Questions</small>
                      </h3>
                  </div>
                  <div class="card-footer">
                      <div class="stats">
                          <i class="material-icons text-danger">home</i>
                          <a href="{{route('gaias.index')}}">View</a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                  <div class="card-header card-header-primary card-header-icon">
                      <div class="card-icon">
                          <i class="material-icons">swap_horizontal_circle</i>
                      </div>
                      <p class="card-category">Africa</p>
                      <h3 class="card-title">{{$africa}}
                          <small>Questions</small>
                      </h3>
                  </div>
                  <div class="card-footer">
                      <div class="stats">
                          <i class="material-icons text-danger">home</i>
                          <a href="{{route('africas.index')}}">View</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-success">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Users:</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#profile" data-toggle="tab">
                        <i class="material-icons">supervised_user_circle</i> Managers
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#messages" data-toggle="tab">
                        <i class="material-icons">spellcheck</i> Validators
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#settings" data-toggle="tab">
                        <i class="material-icons">speaker_notes</i> Teachers
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                    <div class="table-responsive">
                  <table class="table">
                      <thead class=" text-primary">
                      <th>
                          {{ __('Name') }}
                      </th>
                      <th>
                          {{ __('Username') }}
                      </th>
                      <th>
                          {{ __('Role') }}
                      </th>


                      </thead>
                    <tbody>
                    @foreach($users as $user)
                        @if($user->roles->implode('name',', ')=='Manager')

                            <tr>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    <a href="https://t.me/{{ $user->username }}">{{ $user->username }}</a>

                                </td>
                                <td>
                                    {{ $user->roles->implode('name',', ') }}
                                </td>


                            </tr>

                    </tbody>
                      @endif
                      @endforeach
                  </table>
                    </div>
                </div>
                <div class="tab-pane" id="messages">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                {{ __('Name') }}
                            </th>
                            <th>
                                {{ __('Username') }}
                            </th>
                            <th>
                                {{ __('Role') }}
                            </th>


                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                @if($user->roles->implode('name',', ')=='Validator')

                                    <tr>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            <a href="https://t.me/{{ $user->username }}">{{ $user->username }}</a>

                                        </td>
                                        <td>
                                            {{ $user->roles->implode('name',', ') }}
                                        </td>


                                    </tr>

                            </tbody>
                            @endif
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="settings">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                {{ __('Name') }}
                            </th>
                            <th>
                                {{ __('Username') }}
                            </th>
                            <th>
                                {{ __('Role') }}
                            </th>


                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                @if($user->roles->implode('name',', ')=='Teacher')

                                    <tr>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            <a href="https://t.me/{{ $user->username }}">{{ $user->username }}</a>

                                        </td>
                                        <td>
                                            {{ $user->roles->implode('name',', ') }}
                                        </td>


                                    </tr>

                            </tbody>
                            @endif
                            @endforeach
                        </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection


