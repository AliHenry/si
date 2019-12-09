@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/roles/roles.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Billing</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('billing.index')}}">Billing</a></li>
                <li class="breadcrumb-item active">Billing</li>
            </ol>
            <div class="page-actions">
                @permission('create.billing')
                    <a href="{{route('billing.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Bill</a>
                @endpermission
                <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Bills</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="roles-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>staff</th>
                                <th>Code</th>
                                <th>Customer</th>
                                <th>Arrears</th>
                                <th>Amount Due</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($billing as $bill)
                            <tr>
                                <td>{{$bill->id}}</td>
                                <td>{{$bill->user->name}}</td>
                                <td>{{$bill->code}}</td>
                                <td>{{$bill->customer->code}}</td>
                                <td>{{$bill->arrears}}</td>
                                <td>{{$bill->current_amount}}</td>
                                <td>{{ totalBill($bill) }}</td>
                                <td>
                                    @permission('view.billing')
                                        <a href="{{route('billing.show',$bill->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('view.billing')
                                    <a href="{{route('invoice', ['id' => $bill->id])}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-cloud-download"></i> Invoice</a>
                                    @endpermission
                                    @permission('edit.billing')
                                        <a href="{{route('billing.edit',$bill->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.billing')
                                        <a href="{{route('billing.destroy',$bill->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
