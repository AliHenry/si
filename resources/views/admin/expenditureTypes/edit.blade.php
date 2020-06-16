@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Edit Expenditure Type</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('expenditure-types.index')}}">Expenditure Types</a></li>
                <li class="breadcrumb-item active">{{ $expenditureType->name }}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('expenditure-types.update', $expenditureType->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="card-header">
                                <h6>Expenditure Type Form</h6>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputName"
                                           aria-describedby="emailHelp" value="{{$expenditureType->name}}"
                                           placeholder="Enter Permission Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Description</label>
                                    <input type="text" class="form-control" name="description" id="exampleInputName"
                                           aria-describedby="emailHelp" value="{{$expenditureType->description}}"
                                           placeholder="Enter Permission Name">
                                </div>

                                <input type="submit" class="btn btn-primary" value="Edit Expenditure Type">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
