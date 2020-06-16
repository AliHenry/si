@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Payment Type Detail</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('expenditure-types.index')}}">Expenditure Types</a></li>
                <li class="breadcrumb-item active">{{$expenditureType->name}}</li>
            </ol>
            <div class="page-actions">
                <a href="{{route('expenditure-types.edit',$expenditureType->id)}}" class="btn btn-primary"><i class="icon-fa icon-fa-edit"></i> Edit Expenditure Type</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="section-semi-title mt-4">
                            Expenditure Type Details
                        </h5>
                        <hr>
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Name</label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $expenditureType->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Description</label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $expenditureType->description}}</p>
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
