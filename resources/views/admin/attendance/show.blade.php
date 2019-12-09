@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Attendance Detail</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('attendance.index')}}">Attendance</a></li>
                <li class="breadcrumb-item active">{{$attendance->day}}</li>
            </ol>
            <div class="page-actions">
                @permission('edit.attendance')
                    <a href="{{route('attendance.edit',$attendance->id)}}" class="btn btn-primary"><i class="icon-fa icon-fa-edit"></i> Edit Designation</a>
                @endpermission

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="section-semi-title mt-4">
                            Attendance Details
                        </h5>
                        <hr>

                        <form>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Code</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $attendance->code }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Day</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $attendance->day }}</p>
                                </div>
                            </div>
                            <hr>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <table id="departments-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Present</th>
                                        <th>Absent</th>
                                        <th>Sick</th>
                                        <th>Leave</th>
                                    </tr>
                                    </thead>
                                    @foreach($attendance->employees as $employee)
                                        <tr>
                                            <td><img height="50" src="{{asset('storage/'.$employee->image)}}" alt="{{$employee->first_name}}"></td>
                                            <td>{{$employee->first_name. ' '. $employee->middle_name. ' '. $employee->last_name}}</td>
                                            <td style="text-align: center">@if($employee->attend_type->type === 1) <i class="icon-fa icon-fa-check"></i> @endif</td>
                                            <td style="text-align: center">@if($employee->attend_type->type === 2) <i class="icon-fa icon-fa-check"></i> @endif</td>
                                            <td style="text-align: center">@if($employee->attend_type->type === 3) <i class="icon-fa icon-fa-check"></i> @endif</td>
                                            <td style="text-align: center">@if($employee->attend_type->type === 4) <i class="icon-fa icon-fa-check"></i> @endif</td>
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
        </div>
    </div>
@stop
