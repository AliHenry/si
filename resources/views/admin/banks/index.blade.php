@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/departments/departments.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Banks</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('banks.index')}}">Banks</a></li>
                <li class="breadcrumb-item active">Banks</li>
            </ol>
            <div class="page-actions">
                @permission('create.banks')
                    <a href="{{route('banks.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Bank</a>
                @endpermission
                @permission('delete.banks')
                    <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
                @endpermission
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Banks</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="departments-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Account No.</th>
                                <th>Account Name</th>
                                <th>Bank</th>
                                <th>Account Type</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($banks as $bank)
                            <tr>
                                <td>{{$bank->acc_no}}</td>
                                <td>{{$bank->acc_name}}</td>
                                <td>{{$bank->bank_name}}</td>
                                <td>{{$bank->acc_type}}</td>
                                <td>
                                    @permission('edit.banks')
                                        <a href="{{route('banks.show',$bank->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.banks')
                                        <a href="{{route('banks.edit',$bank->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.banks')
                                        <a href="{{route('banks.destroy',$bank->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
