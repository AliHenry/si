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
                <li class="breadcrumb-item active">Create Attendance</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <form action="{{route('attendance.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <h5 class="section-semi-title mt-4">
                                Create Attendance
                            </h5>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"> Attendance Date</label>
                                    <input type="text" class="form-control ls-datepicker" name="day"
                                           value="{{ date('m/d/Y') }}">
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table id="departments-datatable" class="table table-striped table-bordered"
                                           cellspacing="0" width="100%">
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
                                        @foreach($employees as $employee)
                                            <tr>
                                                <td><img height="50" src="{{asset('storage/'.$employee->image)}}"
                                                         alt="{{$employee->first_name}}"></td>
                                                <td>{{$employee->first_name. ' '. $employee->middle_name. ' '. $employee->last_name}}</td>
                                                <td style="text-align: center"><input class="form-check-input"
                                                                                      type="radio" name="types[{{$employee->id}}]"
                                                                                      id="inlineRadio2" value="{{1}}">
                                                </td>
                                                <td style="text-align: center"><input class="form-check-input"
                                                                                      type="radio" name="types[{{$employee->id}}]"
                                                                                      id="inlineRadio2" value="{{2}}">
                                                </td>
                                                <td style="text-align: center"><input class="form-check-input"
                                                                                      type="radio" name="types[{{$employee->id}}]"
                                                                                      id="inlineRadio2" value="{{3}}">
                                                </td>
                                                <td style="text-align: center"><input class="form-check-input"
                                                                                      type="radio" name="types[{{$employee->id}}]"
                                                                                      id="inlineRadio2" value="{{4}}">
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Create Attendance">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
