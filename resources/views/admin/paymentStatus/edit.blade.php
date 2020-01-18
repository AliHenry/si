@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Edit Payment Status</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('status.index')}}">Payment Status</a></li>
                <li class="breadcrumb-item active">{{ $status->name }}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('status.update', $status->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="card-header">
                                <h6>Payment Status Form</h6>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputName"
                                           aria-describedby="emailHelp" value="{{$status->name}}"
                                           placeholder="Enter Permission Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Show</label>
                                    <input name="show" type="checkbox" class="form-control ls-switch" {{$status->show ? 'checked' : ''}} data-color="#007dcc"/>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Edit Payment Status">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
