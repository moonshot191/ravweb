@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

{!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update',  $user->id ] ]) !!}
@csrf
@include('users._form')
<!-- Submit Form Button -->
    {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
