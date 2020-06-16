@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Purchase Detail</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('purchase.index')}}">Purchases</a></li>
                <li class="breadcrumb-item active">{{$purchase->product->name}}</li>
            </ol>
            <div class="page-actions">
                @permission('edit.products')
                <a href="{{route('purchase.edit',$purchase->id)}}" class="btn btn-primary"><i class="icon-fa icon-fa-edit"></i> Edit Product</a>
                @endpermission

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-12 mt-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Product:</b></label>
                                    {{$purchase->product->name}}

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Supplier:</b></label>
                                    {{$purchase->supplier ? $purchase->supplier->name : $purchase->supplier_name}}
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Supplied Qty:</b></label>
                                    {{$purchase->supplied_qty}}

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Old Qty:</b></label>
                                    {{$purchase->current_qty}}
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Purchase Price:</b></label>
                                    {{priceFormat($purchase->supplied_price)}}

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Discount:</b></label>
                                    {{priceFormat($purchase->discount)}}
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Total:</b></label>
                                    {{$purchase->total_price}}

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>User:</b></label>
                                    {{$purchase->user->name}}
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
