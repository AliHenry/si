@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">State Detail</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('states.index')}}">State</a></li>
                <li class="breadcrumb-item active">{{$state->name}}</li>
            </ol>
            <div class="page-actions">
                <a href="{{route('states.edit',$state->id)}}" class="btn btn-primary"><i class="icon-fa icon-fa-edit"></i> Edit Country</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="section-semi-title mt-4">
                            State Details
                        </h5>
                        <hr>
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Name</label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $state->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Country</label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $state->country->name }}</p>
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
