@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/roles/roles.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Payment Types</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('payment-type.index')}}">Payment Types</a></li>
                <li class="breadcrumb-item active">Payment Types</li>
            </ol>
            <div class="page-actions">
                @permission('create.payment.types')
                    <a href="{{route('payment-type.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Payment Type</a>
                @endpermission
                <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Payment Types</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="roles-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($paymentTypes as $paymentType)
                            <tr>
                                <td>{{$paymentType->id}}</td>
                                <td>{{$paymentType->name}}</td>
                                <td>{{$paymentType->price}}</td>
                                <td>
                                    @permission('view.payment.types')
                                        <a href="{{route('payment-type.show',$paymentType->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.payment.types')
                                        <a href="{{route('payment-type.edit',$paymentType->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.payment.types')
                                        <a href="{{route('payment-type.destroy',$paymentType->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
