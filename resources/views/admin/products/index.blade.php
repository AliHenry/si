@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/departments/departments.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Products</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
                <li class="breadcrumb-item active">Employees</li>
            </ol>
            <div class="page-actions">
                @permission('create.products')
                    <a href="{{route('products.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Product</a>
                @endpermission
                @permission('delete.products')
                    <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
                @endpermission
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Products</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="departments-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Brand</th>
                                <th>Measure</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($products as $product)
                            <tr>
                                <td><img height="50" src="{{productImage($product->image)}}" alt="{{$product->name}}"></td>
                                <td>{{$product->code}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{truncDescription($product->description)}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->qty}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->brand ? $product->brand->name : 'none'}}</td>
                                <td>{{$product->measure}}</td>
                                <td>
                                    @permission('edit.products')
                                        <a href="{{route('products.show',$product->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.products')
                                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.products')
                                        <a href="{{route('products.destroy',$product->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
                                    @endpermission

                            </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
