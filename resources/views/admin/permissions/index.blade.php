@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Permission</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('permissions.index')}}">Permissions</a></li>
                <li class="breadcrumb-item active">Permission</li>
            </ol>
            <div class="page-actions">
                <a href="{{route('permissions.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Permissions</a>
                <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Permissions</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="users-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Role</th>
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->slug}}</td>
                                    <td>{{$permission->description}}</td>
                                    <td>
                                        @foreach($permission->roles as $role)
                                            {{$role->name}},
                                        @endforeach
                                    </td>
                                    <td>{{$permission->created_at}}</td>
                                    <td><a href="{{route('permissions.show',$permission->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                        <a href="{{route('permissions.edit',$permission->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                        @permission('delete.permissions')
                                        <a href="{{route('permissions.destroy',$permission->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
                                    @endpermission

                                </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
