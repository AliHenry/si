@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/employees/employees.js"></script>
    <script src="/assets/admin/js/employees/employees2.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Edit Employee</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Employee</a></li>
                <li class="breadcrumb-item active">{{$employee->first_name.' '.$employee->last_name}}</li>

            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('employees.update', $employee->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-header">
                                <h6>Employee Form</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">First Name</label>
                                        <input type="text" class="form-control" name="first_name" id="inputFirstName"
                                               placeholder="First Name" value="{{$employee->first_name}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Middle Name</label>
                                        <input type="text" class="form-control" name="middle_name" id="inputFirstName"
                                               placeholder="Middle Name" value="{{$employee->middle_name}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="inputFirstName"
                                               placeholder="Last Name" value="{{$employee->last_name}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName"> Email</label>
                                        <input type="email" class="form-control" name="email" id="inputFirstName"
                                               placeholder="Email Name" value="{{$employee->email}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Gender</label>
                                        <select name="gender" class="form-control" id="exampleFormControlSelect1">
                                            <option value="male" {{$employee->gender === 'male' ? 'selected' : ''}}>Male</option>
                                            <option value="female" {{$employee->gender === 'female' ? 'selected' : ''}}>Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName"> Date Of Birthday</label>
                                        <input type="text" class="form-control ls-datepicker" name="date_of_birth" value="{{$employee->date_of_birth}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="inputFirstName"
                                               placeholder="Phone Number" value="{{$employee->phone}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName"> Join Date</label>
                                        <input type="text" class="form-control ls-datepicker" name="join_date" value="{{$employee->join_date}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Address</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="address" rows="3">{{$employee->address}}</textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">Department</label>
                                        <select name="department" id="department" data-dependent="designation" data-url="{{route('designations.fetch')}}" class="form-control ls-select2">
                                            <option value="{{null}}"> -- select department -- </option>
                                            @foreach($departments as $department)
                                                <option value="{{$department->id}}" {{$department->id == $employee->dept_id ? 'selected' : ''}}>{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">Designation</label>
                                        <select name="designation" id="designation" class="form-control ls-select2">
                                            <option value="{{$employee->job_type}}"> {{$employee->designation->name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">State</label>
                                        <select name="state_id" id="state"  data-url="{{route('lga.fetch')}}" class="form-control ls-select2">
                                            <option value="{{null}}"> -- select state -- </option>
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}" {{$state->id == $employee->state_id ? 'selected' : ''}}>{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">LGA</label>
                                        <select name="lga_id" id="lga" class="form-control ls-select2">
                                            <option value="{{$employee->lga_id}}">{{$employee->lga->name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">User</label>
                                        <select name="user_id" id="designation" class="form-control ls-select2">
                                            <option value="{{null}}"> -- select user -- </option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" {{$user->id == $employee->user_id ? 'selected' : ''}}>{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlFile1">Image</label>
                                        <input type="file" class="form-control-file" name="avatar" id="exampleFormControlFile1">
                                        <small class="text-muted">Upload image should not be more than 2MP.
                                        </small>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Edit Employee">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
