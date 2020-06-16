@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/profile/profile.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Employees</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Employees</a></li>
                <li class="breadcrumb-item active">Employees</li>
            </ol>
            <div class="page-actions">
                @permission('create.employees')
                    <a href="{{route('employees.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Employees</a>
                @endpermission
                @permission('delete.employees')
                    <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
                @endpermission
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Employees</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="departments-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>D.O.B</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Join Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($employees as $employee)
                            <tr>
                                <td><img height="50" src="{{productImage($employee->image)}}" alt="{{$employee->first_name}}"></td>
                                <td>{{$employee->code}}</td>
                                <td>{{$employee->first_name. ' '. $employee->middle_name. ' '. $employee->last_name}}</td>
                                <td>{{$employee->gender}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->phone}}</td>
                                <td>{{$employee->date_of_birth}}</td>
                                <td>{{$employee->department->name}}</td>
                                <td>{{$employee->designation->name}}</td>
                                <td>{{$employee->join_date}}</td>
                                <td>
                                    @permission('edit.employees')
                                        <a href="{{route('employees.show',$employee->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.employees')
                                        <a href="{{route('employees.edit',$employee->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.employees')
                                        <a href="{{route('employees.destroy',$employee->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
