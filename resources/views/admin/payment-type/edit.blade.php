@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Edit Payment Type</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('payment-type.index')}}">Payment Type</a></li>
                <li class="breadcrumb-item active">{{ $paymentType->name }}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('payment-type.update', $paymentType->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="card-header">
                                <h6>Payment Type Form</h6>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputName"
                                           aria-describedby="emailHelp" value="{{$paymentType->name}}"
                                           placeholder="Enter Permission Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Price</label>
                                    <input type="text" class="form-control" name="price" id="exampleInputName"
                                           aria-describedby="emailHelp" value="{{$paymentType->price}}"
                                           placeholder="Enter Permission Name">
                                </div>
                                <input type="submit" class="btn btn-primary" value="Edit Payment Type">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
