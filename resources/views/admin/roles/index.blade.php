@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/roles/roles.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Roles</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></li>
                <li class="breadcrumb-item active">Role</li>
            </ol>
            <div class="page-actions">
                <a href="{{route('roles.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New User</a>
                <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Roles</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="roles-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Level</th>
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{$role->name}}</td>
                                <td>{{$role->slug}}</td>
                                <td>{{$role->description}}</td>
                                <td>{{$role->level}}</td>
                                <td>{{$role->created_at}}</td>
                                <td><a href="{{route('roles.show',$role->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    <a href="{{route('roles.edit',$role->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @permission('delete.roles')
                                        <a href="{{route('roles.destroy',$role->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
