@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Permission Detail</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('permissions.index')}}">Permission</a></li>
                <li class="breadcrumb-item active">{{$permission->name}}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="section-semi-title mt-4">
                            Permission Details
                        </h5>
                        <hr>

                        <form>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Name</label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $permission->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Slug</label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $permission->slug }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Description</label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $permission->description }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Role</label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">
                                        @foreach($permission->roles as $role)
                                            {{$role->name}},
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
