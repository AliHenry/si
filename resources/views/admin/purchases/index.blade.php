@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/departments/departments.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-md-12 col-lg-6 col-xl-3">
                <a class="dashbox" href="#">
                    <i class="icon-fa icon-fa-truck text-primary"></i>
                    <span class="title">
                     {{day_trucks_count()}}
                    </span>
                    <span class="desc">
                      Today Trucks
                    </span>
                </a>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-3">
                <a class="dashbox" href="#">
                    <i class="icon-fa icon-fa-shopping-cart text-success"></i>
                    <span class="title">
                      {{daily_total_Purchase() ? daily_total_Purchase() : 0}}
                    </span>
                    <span class="desc">
                      Daily Purchases
                    </span>
                </a>
            </div>
        </div>
        <div class="page-header">
            <h3 class="page-title">Purchases</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('purchase.index')}}">Purchases</a></li>
                <li class="breadcrumb-item active">Purchases</li>
            </ol>
            <div class="page-actions">
                @permission('create.products')
                    <a href="{{route('purchase.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Purchase</a>
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
                        <h6>All Purchases</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="departments-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Supplier</th>
                                <th>Damage</th>
                                <th>Truck</th>
                                <th>Receiver</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($purchases as $purchase)
                            <tr>
                                <td>{{$purchase->product->name}}</td>
                                <td>{{$purchase->supplied_qty}}</td>
                                <td>{{$purchase->supplied_price}}</td>
                                <td>{{$purchase->supplier ? $purchase->supplier->name : $purchase->supplier_name}}</td>
                                <td>{{$purchase->damage_prod}}</td>
                                <td>{{$purchase->truck_no}}</td>
                                <td>{{$purchase->user->name}}</td>
                                <td>{{$purchase->total_price}}</td>
                                <td>
                                    <a href="{{route('purchase.show',$purchase->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-print"></i> Print</a>
                                    @permission('edit.purchase')
                                        <a href="{{route('purchase.show',$purchase->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.purchase')
                                        <a href="{{route('purchase.edit',$purchase->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.purchase')
                                        <a href="{{route('purchase.destroy',$purchase->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
