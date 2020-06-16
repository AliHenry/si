@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/customers/customers.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Create Customer</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('customers.index')}}">Customers</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('customers.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h6>Customer Form</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">First Name</label>
                                        <input type="text" class="form-control" name="first_name" id="inputFirstName"
                                               placeholder="Enter First Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Middle Name</label>
                                        <input type="text" class="form-control" name="middle_name" id="inputFirstName"
                                               placeholder="Enter Middle Name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="inputFirstName"
                                               placeholder="Enter Last Name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="inputFirstName"
                                               placeholder="Enter Phone Number">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName"> Email</label>
                                        <input type="email" class="form-control" name="email" id="inputFirstName"
                                               placeholder="Enter Email Name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Credit Limit</label>
                                        <input type="text" class="form-control" name="credit_limit" id="inputFirstName"
                                               placeholder="Enter Phone Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Address</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="address" rows="3"></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">State</label>
                                        <select name="state_id" id="state"  data-url="{{route('lga.fetch')}}" class="form-control ls-select2">
                                            <option value="{{null}}"> -- select state -- </option>
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}">{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">LGA</label>
                                        <select name="lga_id" id="lga" class="form-control ls-select2">
                                            <option value="{{null}}"> -- select LGA -- </option>
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

                                <input type="submit" class="btn btn-primary" value="Create Customer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
