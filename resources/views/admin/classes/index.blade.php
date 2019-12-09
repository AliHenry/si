@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/roles/roles.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Classes</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('classes.index')}}">Classes</a></li>
                <li class="breadcrumb-item active">Classes</li>
            </ol>
            <div class="page-actions">
                @permission('create.class')
                    <a href="{{route('classes.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Class</a>
                @endpermission
                <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Classes</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="roles-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($classes as $class)
                            <tr>
                                <td>{{$class->id}}</td>
                                <td>{{$class->code}}</td>
                                <td>{{$class->name}}</td>
                                <td>
                                    @permission('view.class')
                                        <a href="{{route('classes.show',$class->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.class')
                                        <a href="{{route('classes.edit',$class->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.class')
                                        <a href="{{route('classes.destroy',$class->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
