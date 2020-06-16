@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/profile/profile.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Employee Profile</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Employees</a></li>
                <li class="breadcrumb-item active">{{$employee->first_name}}</li>
            </ol>
            <div class="page-actions">
                @permission('edit.employees')
                <a href="{{route('employees.edit',$employee->id)}}" class="btn btn-primary"><i class="icon-fa icon-fa-edit"></i> Edit Employee</a>
                @endpermission

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tabs tabs-default">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#user" role="tab">User Details</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="avatar-container">
                                                <img src="{{productImage($employee->image)}}" alt="{{$employee->first_name}}" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <h4>{{ $employee->first_name.' '.$employee->middle_name.' '.$employee->last_name }}</h4>
                                            <p class="detail-row"><i class="icon-fa icon-fa-map-marker"></i> {{$employee->gender}}</p>
                                            <p class="detail-row"><i class="icon-fa icon-fa-map-marker"></i> {{$employee->address}}</p>
                                            <p class="detail-row"><i class="icon-fa icon-fa-birthday-cake"></i>{{\Carbon\Carbon::parse($employee->date_of_birth)->format('M d, Y')}}</p>
                                            <p class="detail-row"><i class="icon-fa icon-fa-phone"></i>{{$employee->phone}}</p>
                                            <p class="detail-row"><i class="icon-fa icon-fa-envelope"></i>{{$employee->email}}</p>
                                            <p class="detail-row"><i class="icon-fa icon-fa-wrench"></i> {{$employee->department->name.'/'.$employee->designation->name}}</p>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3 class="section-semi-title">Employee Origin</h3>
                                                    <ul class="media-list activity-list">
                                                        <p class="detail-row"><i class="icon-fa icon-fa-map-marker"></i> {{$employee->state->name.', '.$employee->lga->name}}</p>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h3 class="section-semi-title">Employee Join</h3>
                                                    <ul class="media-list activity-list">
                                                        <p class="detail-row"><i class="icon-fa icon-fa-map-marker"></i> {{\Carbon\Carbon::parse($employee->join_date)->format('M d, Y')}}</p>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="user" role="tabpanel">
                                    <div class="row mt-4">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3 class="section-semi-title">User Details</h3>
                                                    <ul class="media-list activity-list">
                                                        <p class="detail-row"><i class="icon-fa icon-fa-map-marker"></i> {{$employee->user->name}}</p>
                                                        <p class="detail-row"><i class="icon-fa icon-fa-map-marker"></i> {{$employee->user->role}}</p>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h3 class="section-semi-title">Security</h3>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputFirstName">Password</label>
                                                        <input type="hidden" id="url" name="user_id" value="{{route('change.profile.password')}}">
                                                        <input type="password" class="form-control" name="password" id="profile_pwd"
                                                               placeholder="Password">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputFirstName">Re-type Password</label>
                                                        <input type="password" class="form-control" name="confirm_password" id="profile_conf_pwd"
                                                               placeholder="Re-type Password">
                                                    </div>
                                                    <button id="changePassword" class="btn btn-primary">Change Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
