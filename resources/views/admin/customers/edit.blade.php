@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/employees/employees.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Edit Customer</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('customers.index')}}">Customers</a></li>
                <li class="breadcrumb-item active">{{$customer->first_name.' '.$customer->last_name}}</li>

            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('customers.update', $customer->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-header">
                                <h6>Employee Form</h6>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName">First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="inputFirstName"
                                           placeholder="Enter First Name" value="{{$customer->first_name}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName">Middle Name</label>
                                    <input type="text" class="form-control" name="middle_name" id="inputFirstName"
                                           placeholder="Enter Middle Name" value="{{$customer->middle_name}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="inputFirstName"
                                           placeholder="Enter Last Name" value="{{$customer->last_name}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="inputFirstName"
                                           placeholder="Enter Phone Number" value="{{$customer->phone}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"> Email</label>
                                    <input type="email" class="form-control" name="email" id="inputFirstName"
                                           placeholder="Enter Email Name" value="{{$customer->email}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"> Zone</label>
                                    <select name="zone_id"  class="form-control ls-select2">
                                        <option value="{{null}}"> -- select zone -- </option>
                                        @foreach($zones as $zone)
                                            <option value="{{$zone->id}}" {{ $zone->id == $customer->zone_id ? 'selected' : '' }}>{{$zone->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"> Zone</label>
                                    <select name="pay_type_id"  class="form-control ls-select2">
                                        <option value="{{null}}"> -- select payment type -- </option>
                                        @foreach($paymentTypes as $paymentType)
                                            <option value="{{$paymentType->id}}" {{ $paymentType->id == $customer->pay_type_id ? 'selected' : '' }}>{{$paymentType->name.'/'.$paymentType->price}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Address</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="address" rows="3">{{$customer->address}}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail">State</label>
                                    <select name="state_id" id="state"  data-url="{{route('lga.fetch')}}" class="form-control ls-select2">
                                        <option value="{{null}}"> -- select state -- </option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}" {{ $state->id == $customer->state_id ? 'selected' : '' }}>{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail">LGA</label>
                                    <select name="lga_id" id="lga" class="form-control ls-select2">
                                        <option value="{{null}}"> -- select LGA -- </option>
                                        @foreach($lgas as $lga)
                                            <option value="{{$lga->id}}" {{ $lga->id == $customer->lga_id ? 'selected' : '' }}>{{$lga->name}}</option>
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
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlFile1">Active</label>
                                    <input type="checkbox" name="active" class="ls-switch" value="{{true}}" {{$customer->active === 1 ? 'checked' : ''}} />
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary" value="Edit Customer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
