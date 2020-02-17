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
                <li class="breadcrumb-item"><a href="{{route('release.products.index')}}">Release Products</a></li>
                <li class="breadcrumb-item active">Employees</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Release Products</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="departments-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Trans ID</th>
                                <th>Customer Name</th>
                                <th>Total Item(s)</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($sells as $sell)
                                @if(!$sell->products->isEmpty())
                                    <tr>

                                        <td>{{$sell->transaction_id}}</td>
                                        <td>{{$sell->cust_name ? $sell->cust_name : $sell->customer->first_name.' '.$sell->customer->middle_name.' '.$sell->customer->last_name}}</td>
                                        <td>{{count($sell->products)}}</td>
                                        <td>{{$sell->created_at}}</td>
                                        <td>
                                            <a href="{{route('release.products.show',$sell->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                        </td>
                                        {{--                                <td>--}}
                                        {{--                                    @permission('edit.products')--}}
                                        {{--                                        <a href="{{route('products.show',$product->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>--}}
                                        {{--                                    @endpermission--}}
                                        {{--                                    @permission('edit.products')--}}
                                        {{--                                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>--}}
                                        {{--                                    @endpermission--}}
                                        {{--                                    @permission('delete.products')--}}
                                        {{--                                        <a href="{{route('products.destroy',$product->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a>--}}
                                        {{--                                </td>--}}
                                        {{--                                    @endpermission--}}

                                    </tr>
                                @endif
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
