@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Expenditure Detail</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('expenditures.index')}}">Expenditures</a></li>
                <li class="breadcrumb-item active">{{$expenditure->title}}</li>
            </ol>
            <div class="page-actions">
                <a href="{{route('expenditures.edit',$expenditure->id)}}" class="btn btn-primary"><i class="icon-fa icon-fa-edit"></i> Edit Expenditure Type</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="section-semi-title mt-4">
                            Expenditure Details
                        </h5>
                        <hr>
                        <form>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="avatar-container">
                                        <img src="{{productImage($expenditure->image)}}" alt="{{$expenditure->title}}" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-5">
                                <label class="col-sm-2 form-control-label"><b>Title:</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $expenditure->title }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Type:</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $expenditure->type->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Amount:</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $expenditure->amount}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Paid To:</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $expenditure->paid_to}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Description:</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $expenditure->description}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Date:</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{\Carbon\Carbon::parse($expenditure->created_at)->format('M d, Y - h:i A')}}</p>
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
