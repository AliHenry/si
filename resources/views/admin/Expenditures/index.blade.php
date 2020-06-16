@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/roles/roles.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Expenditures</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('expenditures.index')}}">Expenditures</a></li>
            </ol>
            <div class="page-actions">
                @permission('create.payment.types')
                    <a href="{{route('expenditures.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Expenditure</a>
                @endpermission
                <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Expenditures</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="roles-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Paid To</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($expenditures as $expenditure)
                            <tr>
                                <td>{{$expenditure->type->name}}</td>
                                <td>{{$expenditure->title}}</td>
                                <td>{{$expenditure->description}}</td>
                                <td>{{priceFormat($expenditure->amount)}}</td>
                                <td>{{$expenditure->paid_to}}</td>
                                <td>{{\Carbon\Carbon::parse($expenditure->created_at)->format('M d, Y - h:i A')}}</td>
                                <td>
                                    @permission('view.expenditures')
                                        <a href="{{route('expenditures.show',$expenditure->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.expenditures')
                                        <a href="{{route('expenditures.edit',$expenditure->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.expenditures')
                                        <a href="{{route('expenditures.destroy',$expenditure->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
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
