@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">User Profile</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
                <li class="breadcrumb-item active">{{$user->name}}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="section-semi-title mt-4">
                            User Details
                        </h5>
                        <hr>

                        <form>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Name:</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $user->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>email:</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $user->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Role:</b></label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">
                                        @forelse($user->roles as $role)
                                            {{ $role->name }},
                                        @empty
                                            {{ $user->role}}
                                        @endforelse
                                    </p>
                                </div>
                            </div>
                            <hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
