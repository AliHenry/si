@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/roles/roles.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Payment Status</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('status.index')}}">Payment Status</a></li>
            </ol>
            <div class="page-actions">
                @permission('create.payment.status')
                    <a href="{{route('status.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Payment Status</a>
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
                                <th>Show</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($paymentStatus as $status)
                            <tr>
                                <td>{{$status->id}}</td>
                                <td>{{$status->name}}</td>
                                <td>{{$status->show ? 'True' : 'False'}}</td>
                                <td>
                                    @permission('view.payment.status')
                                        <a href="{{route('status.show',$status->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.payment.status')
                                        <a href="{{route('status.edit',$status->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.payment.status')
                                        <a href="{{route('status.destroy',$status->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
