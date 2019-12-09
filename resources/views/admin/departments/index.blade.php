@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/departments/departments.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Departments</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></li>
                <li class="breadcrumb-item active">Role</li>
            </ol>
            <div class="page-actions">
                @permission('create.departments')
                    <a href="{{route('departments.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Department</a>
                @endpermission
                @permission('delete.departments')
                    <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
                @endpermission
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Departments</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="departments-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($departments as $department)
                            <tr>
                                <td>{{$department->id}}</td>
                                <td>{{$department->name}}</td>
                                <td>{{$department->created_at}}</td>
                                <td>
                                    @permission('edit.departments')
                                        <a href="{{route('departments.show',$department->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.departments')
                                        <a href="{{route('departments.edit',$department->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.departments')
                                        <a href="{{route('departments.destroy',$department->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
