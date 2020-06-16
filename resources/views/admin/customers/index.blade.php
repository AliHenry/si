@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/departments/departments.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Customers</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('customers.index')}}">Customers</a></li>
                <li class="breadcrumb-item active">Employees</li>
            </ol>
            <div class="page-actions">
                @permission('create.customers')
                    <a href="{{route('customers.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Customer</a>
                @endpermission
                @permission('delete.customers')
                    <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
                @endpermission
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Customers</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="departments-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Credit Limit</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($customers as $customer)
                            <tr>
                                <td>{{$customer->id}}</td>
                                <td><img height="50" src="{{productImage($customer->image)}}" alt="{{$customer->first_name}}"></td>
                                <td>{{$customer->code}}</td>
                                <td>{{$customer->first_name. ' '. $customer->middle_name. ' '. $customer->last_name}}</td>
                                <td>{{$customer->phone}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{priceFormat($customer->credit_limit)}}</td>
                                <td>
                                    @permission('edit.customers')
                                        <a href="{{route('customers.show',$customer->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.customers')
                                        <a href="{{route('customers.edit',$customer->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.customers')
                                        <a href="{{route('customers.destroy',$customer->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
