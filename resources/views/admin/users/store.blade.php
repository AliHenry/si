@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Create User</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('users.store')}}" method="POST">
                            @csrf
                            <div class="card-header">
                                <h6>User Form</h6>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputName"
                                           aria-describedby="emailHelp" placeholder="Enter User Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Email</label>
                                    <input type="email" class="form-control" name="email" id="exampleInputName"
                                           aria-describedby="emailHelp" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Password</label>
                                    <input type="password" class="form-control" name="password" id="exampleInputName"
                                           aria-describedby="emailHelp" placeholder="Enter Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="exampleInputName"
                                           aria-describedby="emailHelp" placeholder="Enter Confirm Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Role</label>
                                    <select name="role_id" class="form-control ls-select2">
                                        <option value="{{null}}"> -- select role -- </option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Create User">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
