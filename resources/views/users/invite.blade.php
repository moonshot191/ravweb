@extends('layouts.app', ['activePage' => 'user-invite', 'titlePage' => __('User Invite')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('users.send_email')}}" class="form-horizontal" method="get">
                        @csrf
                        <div class="form-group">
                            <label for="">Input Name</label>
                            <input type="text" placeholder="input name" value="" name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Input Email</label>
                            <input type="text" placeholder="input email" value="" name="email">
                        </div>
                        <div class="form-group">
                            <button type="submit">Invite</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
