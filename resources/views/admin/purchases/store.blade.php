@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/employees/employees.js"></script>
    <script src="/assets/admin/js/employees/employees2.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Create Purchase</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('purchase.index')}}">Purchases</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('purchase.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h6>Product Form</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Name</label>
                                        <input type="text" class="form-control" name="supplier_name" id="inputFirstName"
                                               placeholder="Product Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">Supplier</label>
                                        <select name="supplier_id" class="form-control ls-select2">
                                            <option value="{{null}}"> -- select supplier -- </option>
                                            @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">Product</label>
                                        <select name="prod_id" class="form-control ls-select2">
                                            <option value="{{null}}"> -- select product -- </option>
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName"> Supplied Qty</label>
                                        <input type="number" class="form-control" name="supplied_qty" id="inputFirstName"
                                               placeholder="Low Stock Limit">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Supply Price</label>
                                        <input type="text" class="form-control" name="supplied_price" id="inputFirstName"
                                               placeholder="Supplier Price" value="{{ 0.00 }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName"> Discount</label>
                                        <input type="text" class="form-control" name="discount" value="{{ 0.00 }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Struck Number</label>
                                        <input type="text" class="form-control" name="truck_no" id="inputFirstName"
                                               placeholder="Truck Number">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Number of Damage Product</label>
                                        <input type="number" class="form-control" name="damage_prod" value="{{ 0 }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlFile1">Receipt</label>
                                        <input type="file" class="form-control-file" name="avatar" id="exampleFormControlFile1">
                                        <small class="text-muted">Upload image should not be more than 2MP.
                                        </small>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Create Purchase">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
