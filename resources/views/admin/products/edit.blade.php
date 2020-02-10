@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/employees/employees.js"></script>
    <script src="/assets/admin/js/employees/employees2.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Edit Product</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
                <li class="breadcrumb-item active">{{$product->name}}</li>

            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-header">
                                <h6>Product Form</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Name</label>
                                        <input type="text" class="form-control" name="name" id="inputFirstName"
                                               placeholder="Product Name" value="{{$product->name}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Measure</label>
                                        <input type="text" class="form-control" name="measure" id="inputFirstName"
                                               placeholder="Measure" value="{{$product->measure}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Discount</label>
                                        <input type="text" class="form-control" name="discount" id="inputFirstName"
                                               placeholder="Discount Price" value="{{$product->discount}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName"> Limit</label>
                                        <input type="text" class="form-control" name="limit" id="inputFirstName"
                                               placeholder="Low Stock Limit" value="{{$product->limit}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Qty</label>
                                        <input type="number" class="form-control" name="qty" id="inputFirstName"
                                               placeholder="Quantity" value="{{$product->qty}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName"> Price</label>
                                        <input type="text" class="form-control" name="price" value="{{$product->price}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{$product->description}}</textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">Category</label>
                                        <select name="cate_id" class="form-control ls-select2">
                                            <option value="{{null}}"> -- select category -- </option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{$category->id == $product->cate_id ? 'selected' : ''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">Brand</label>
                                        <select name="brand_id" class="form-control ls-select2">
                                            <option value="{{null}}"> -- select brand -- </option>
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}" {{$brand->id == $product->brand_id ? 'selected' : ''}}>{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlFile1">Image</label>
                                        <input type="file" class="form-control-file" name="avatar" id="exampleFormControlFile1">
                                        <small class="text-muted">Upload image should not be more than 2MP.
                                        </small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlFile1">Featured</label>
                                        <input name="featured" type="checkbox" class="form-control ls-switch" {{$product->featured ? 'checked' : ''}} data-color="#007dcc"/>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Update Product">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
