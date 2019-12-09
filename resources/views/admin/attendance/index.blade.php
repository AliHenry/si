@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/departments/departments.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Designations</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('attendance.index')}}">Attendance</a></li>
                <li class="breadcrumb-item active">Designations</li>
            </ol>
            <div class="page-actions">
                @permission('create.designations')
                    <a href="{{route('attendance.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Designations</a>
                @endpermission
                @permission('delete.designations')
                    <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
                @endpermission
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Designations</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="departments-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Day</th>
                                <th>Present</th>
                                <th>Absent</th>
                                <th>Sick</th>
                                <th>Leave</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($attendances as $attendance)
                            <tr>
                                <td>{{$attendance->code}}</td>
                                <td>{{$attendance->day}}</td>
                                <td>{{$attendance->present}}</td>
                                <td>{{$attendance->absent}}</td>
                                <td>{{$attendance->sick}}</td>
                                <td>{{$attendance->leave}}</td>
                                <td>
                                    @permission('edit.designations')
                                        <a href="{{route('attendance.show',$attendance->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.designations')
                                        <a href="{{route('attendance.edit',$attendance->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.designations')
                                        <a href="{{route('attendance.destroy',$attendance->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
