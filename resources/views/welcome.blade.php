@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Fortuna Dashboard')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <h1 class="text-white text-center">{{ __('Welcome to Fortuna Dashboard') }}</h1>
      </div>
  </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">account_box</i>
                            </div>
                            <p class="card-category">Login as</p>

                            <h3 class="card-title">Manager

                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">


                                <a href="{{route('login')}}" class="btn btn-info">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">account_circle</i>
                            </div>
                            <p class="card-category">Login as</p>
                            <h3 class="card-title">Validator

                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">


                                <a href="{{route('login')}}" class="btn btn-success">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">record_voice_over</i>
                            </div>
                            <p class="card-category">Login as</p>
                            <h3 class="card-title">Teacher

                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">


                                <a href="{{route('login')}}" class="btn btn-primary">Login</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
@endsection
