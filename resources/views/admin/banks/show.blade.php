@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Bank Detail</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('banks.index')}}">Bank</a></li>
                <li class="breadcrumb-item active">{{$bank->bank_name.' '.$bank->acc_no}}</li>
            </ol>
            <div class="page-actions">
                @permission('edit.departments')
                    <a href="{{route('banks.edit',$bank->id)}}" class="btn btn-primary"><i class="icon-fa icon-fa-edit"></i> Edit Department</a>
                @endpermission

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-12 mt-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Account Name:</b></label>
                                    {{$bank->acc_name}}

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Account Number:</b></label>
                                    {{$bank->acc_no}}
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Bank:</b></label>
                                    {{$bank->bank_name}}

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Account Type:</b></label>
                                    {{$bank->acc_type}}
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Account Officer:</b></label>
                                    {{$bank->acc_officer}}

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Acc. Officer Phone:</b></label>
                                    {{$bank->acc_officer_number}}
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="inputFirstName"><b>Bank Address:</b></label>
                                    {{$bank->address}}

                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
