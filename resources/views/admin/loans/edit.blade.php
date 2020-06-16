@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Edit Supplier</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('suppliers.index')}}">Suppliers</a></li>
                <li class="breadcrumb-item active">{{ $supplier->name }}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('suppliers.update', $supplier->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="card-header">
                                <h6>Roles Form</h6>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputName"
                                           aria-describedby="emailHelp" value="{{$supplier->name}}"
                                           placeholder="Enter Permission Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{$supplier->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="exampleInputName"
                                           aria-describedby="emailHelp" placeholder="Enter Permission Name" value="{{$supplier->phone}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Address</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="address" rows="3">{{$supplier->address}}</textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlFile1">Featured</label>
                                        <input name="featured" type="checkbox" class="form-control ls-switch" {{$supplier->featured ? 'checked' : ''}} data-color="#007dcc"/>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Edit Supplier">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
