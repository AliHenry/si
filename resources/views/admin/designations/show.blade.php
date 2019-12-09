@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Designation Detail</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('designations.index')}}">Designation</a></li>
                <li class="breadcrumb-item active">{{$designation->name}}</li>
            </ol>
            <div class="page-actions">
                @permission('edit.designations')
                    <a href="{{route('designations.edit',$designation->id)}}" class="btn btn-primary"><i class="icon-fa icon-fa-edit"></i> Edit Designation</a>
                @endpermission

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="section-semi-title mt-4">
                            Designation Details
                        </h5>
                        <hr>

                        <form>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Name</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $designation->name }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label"><b>Department</b></label>

                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">{{ $designation->department->name }}</p>
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
