@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/roles/roles.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Loans</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('loans.index')}}">Loans</a></li>
            </ol>
            <div class="page-actions">
                <select name="status" class="form-control ls-select2">
                    <option value="{{null}}"> -- select status -- </option>
                    <option value="loan">Loan</option>
                    <option value="paid">Paid</option>
                </select>
                <button class="btn btn-primary"><i class="icon-fa icon-fa-search"></i> Search </button>
                @permission('create.loans')
                    <a href="{{route('loans.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Loan</a>
                @endpermission
                <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Loans</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="roles-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Arrears</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($loans as $loan)
                            <tr>
                                <td>{{$loan->id}}</td>
                                <td>{{$loan->customer ? getFullName($loan->customer) : 'Non'}}</td>
                                <td>{{$loan->transaction ? $loan->transaction->transaction_id : 'null' }}</td>
                                <td>{{priceFormat($loan->amount)}}</td>
                                <td>{{priceFormat($loan->arrears)}}</td>
                                <td>{{priceFormat($loan->new_amount)}}</td>
                                <td>{{$loan->status}}</td>
                                <td>
                                    @permission('view.loans')
                                        <a href="{{route('loans.show',$loan->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.loans')
                                        <a href="{{route('loans.edit',$loan->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.loans')
                                        <a href="{{route('loans.destroy',$loan->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
