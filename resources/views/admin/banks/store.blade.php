@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Create Bank</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('banks.index')}}">Banks</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('banks.store')}}" method="POST">
                            @csrf
                            <div class="card-header">
                                <h6>Bank Form</h6>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail">Account Name</label>
                                    <input type="text" class="form-control" name="acc_name" id="exampleInputName"
                                           aria-describedby="emailHelp" placeholder="Enter Account Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Bank Name</label>
                                    <input type="text" class="form-control" name="bank_name" id="exampleInputName"
                                           aria-describedby="emailHelp" placeholder="Enter Bank Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Account Number</label>
                                    <input type="text" class="form-control" name="acc_no" id="exampleInputName"
                                           aria-describedby="emailHelp" placeholder="Enter Account Number">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Account Type</label>
                                    <select name="acc_type" class="form-control ls-select2">
                                        <option value="{{null}}"> -- select account type -- </option>
                                        <option value="savings">Savings</option>
                                        <option value="current">Current</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Account Officer's Name</label>
                                    <input type="text" class="form-control" name="acc_officer" id="exampleInputName"
                                           aria-describedby="emailHelp" placeholder="Enter Account Number">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Account Officer's Phone</label>
                                    <input type="text" class="form-control" name="acc_officer_number" id="exampleInputName"
                                           aria-describedby="emailHelp" placeholder="Enter Account Number">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Address</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="address" rows="3"></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlFile1">Featured</label>
                                        <input name="featured" type="checkbox" class="form-control ls-switch" checked data-color="#007dcc"/>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Create Bank">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
