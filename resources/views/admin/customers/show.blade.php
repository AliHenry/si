@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Customer Detail</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('customers.index')}}">Customers</a></li>
                <li class="breadcrumb-item active">{{$customer->code}}</li>
            </ol>
            <div class="page-actions">
                <a href="{{route('customers.edit',$customer->id)}}" class="btn btn-primary"><i class="icon-fa icon-fa-edit"></i> Edit Customer</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="section-semi-title mt-4">
                            Customer Details
                        </h5>
                        <hr>
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Code</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $customer->code}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Name</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ getFullName($customer) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Phone</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $customer->phone }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Email</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $customer->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Zone</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $customer->zone->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Payment Type</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $customer->paymentType->name.'/'.$customer->paymentType->price }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>State</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $customer->state->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>LGA</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $customer->lga->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Address</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $customer->address }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Active</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $customer->active === 1 ? 'Active' : 'Inactive' }}</p>
                                </div>
                            </div>
                            <hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
