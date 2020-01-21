@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/departments/departments.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Sells</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('sells.index')}}">Sells</a></li>
                <li class="breadcrumb-item active">Sells</li>
            </ol>
            <div class="page-actions">
                @permission('create.sells')
                    <a href="{{route('sells.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Sells</a>
                @endpermission
                @permission('delete.sells')
                    <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
                @endpermission
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Sells</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="departments-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Trans ID</th>
                                <th>Customer</th>
                                <th>User</th>
                                <th>Qty</th>
                                <th>Sub Total</th>
                                <th>Total</th>
                                <th>Payment Type</th>
                                <th>Payment Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($sells as $sell)
                            <tr>
                                <td>{{$sell->transaction_id}}</td>
                                <td>{{$sell->customer->name}}</td>
                                <td>{{$sell->user->name}}</td>
                                <td>{{$sell->qty}}</td>
                                <td>{{$sell->sub_total}}</td>
                                <td>{{$sell->total}}</td>
                                <td>{{$sell->type->name}}</td>
                                <td>{{$sell->status->name}}</td>
                                <td>
                                    @permission('edit.sells')
                                        <a href="{{route('sells.show',$sell->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.sells')
                                        <a href="{{route('sells.edit',$sell->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.sells')
                                        <a href="{{route('sells.destroy',$sell->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
