@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Role Detail</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></li>
                <li class="breadcrumb-item active">{{$role->name}}</li>
            </ol>
            <div class="page-actions">
                <a href="{{route('roles.edit',$role->id)}}" class="btn btn-primary"><i class="icon-fa icon-fa-edit"></i> Edit Role</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="section-semi-title mt-4">
                            Role Details
                        </h5>
                        <hr>

                        <form>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Name</label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $role->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Slug</label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $role->slug }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Description</label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $role->description }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Level</label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $role->level }}</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Role Permissions</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                @foreach($role->permissions as $permission)
                                    <button class="btn btn-theme btn-rounded m-2">
                                        {{$permission->name}}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
