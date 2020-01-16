@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/departments/departments.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Store Audit Detail</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('audits.index')}}">Store Audits</a></li>
                <li class="breadcrumb-item active">{{\Carbon\Carbon::parse($audit->created_at)->format('M d, Y - h:i A').' - ' .$audit->store->name}}</li>
            </ol>
            <div class="page-actions">
                @permission('edit.products')
                <a href="{{route('audits.edit',$audit->id)}}" class="btn btn-primary"><i class="icon-fa icon-fa-edit"></i> Edit Store Audit</a>
                @endpermission

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tabs tabs-default">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Details</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile" role="tabpanel">
                                    <div class="col-sm-12 mt-4">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>Date:</b></label>
                                                {{\Carbon\Carbon::parse($audit->created_at)->format('M d, Y - h:i A')}}

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>Store:</b></label>
                                                {{$audit->store->name}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>Balanced:</b></label>
                                                {{$audit->balanced}}
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>Unbalanced:</b></label>
                                                {{$audit->unbalanced}}

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>Audit Manager:</b></label>
                                                {{$audit->user->name}}

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>Note:</b></label>
                                                {{$audit->note}}
                                            </div>
                                        </div>
                                        <hr>
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
                                                            <th>Code</th>
                                                            <th>Name</th>
                                                            <th>Successful</th>
                                                            <th>Missing</th>
                                                        </tr>
                                                        </thead>
                                                        @foreach($audit->products as $product)
                                                            <tr>
                                                                <td>{{$product->code}}</td>
                                                                <td>{{$product->name}}</td>
                                                                <td><font color="{{$product->pivot->balanced ? 'green' : 'red' }}">{{$product->pivot->balanced ? 'Yes' : 'No' }}</font></td>
                                                                <td>{{$product->pivot->missing > 0 ? $product->pivot->missing : 'None' }}</td>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
