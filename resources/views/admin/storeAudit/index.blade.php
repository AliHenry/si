@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/departments/departments.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Store Audits</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('audits.index')}}">Store Audits</a></li>
                <li class="breadcrumb-item active">Store Audits</li>
            </ol>
            <div class="page-actions">
                @permission('create.store.audit')
                    <a href="{{route('products.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Audit</a>
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
                                <th>Date</th>
                                <th>Store</th>
                                <th>User</th>
                                <th>Balanced</th>
                                <th>Unbalanced</th>
                                <th>Note</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($storeAudits as $audit)
                            <tr>
                                <td>{{$audit->create_at}}</td>
                                <td>{{$audit->store->name}}</td>
                                <td>{{$audit->user->name}}
                                <td>{{$audit->balanced}}</td>
                                <td>{{$audit->unbalanced}}</td>
                                <td>{{truncDescription($audit->note)}}</td>
                                <td>
                                    @permission('edit.store.audit')
                                        <a href="{{route('audits.show',$audit->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.store.audit')
                                        <a href="{{route('audits.edit',$audit->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.store.audit')
                                        <a href="{{route('audits.destroy',$audit->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
