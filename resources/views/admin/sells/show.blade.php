@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/departments/departments.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Sell Detail</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('sells.index')}}">Sells</a></li>
                <li class="breadcrumb-item active">{{$sell->transaction_id}}</li>
            </ol>
            <div class="page-actions">
                @permission('edit.sells')
                <a href="{{route('sells.edit',$sell->id)}}" class="btn btn-primary"><i class="icon-fa icon-fa-edit"></i> Edit Sell</a>
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
                                    <a class="nav-link active" data-toggle="tab" href="#sell" role="tab">Sell</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="sell" role="tabpanel">
                                    <div class="col-sm-12 mt-4">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>Transaction ID:</b></label>
                                                {{$sell->transaction_id}}

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>Customer:</b></label>
                                                {{$sell->cust_name ? $sell->cust_name : $sell->customer->first_name.' '.$sell->customer->middle_name.' '.$sell->customer->last_name}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>Quantity:</b></label>
                                                {{$sell->total_qtyax}}

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>Tax:</b></label>
                                                {{$sell->tax}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>Sub Total:</b></label>
                                                {{priceFormat($sell->sub_total)}}

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>Total:</b></label>
                                                {{priceFormat($sell->total)}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>Payment Type:</b></label>
                                                {{$sell->type->name}}

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>Status:</b></label>
                                                {{$sell->status->name}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>User:</b></label>
                                                {{$sell->user->name}}

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName"><b>POS Code:</b></label>
                                                {{$sell->pos_code ? $sell->pos_code : 'None'}}
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Sold Product</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="departments-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Qty</th>
                                <th>product</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            @foreach($sell->products as $product)
                                <tr>
                                    <td>{{$product->pivot->qty}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->pivot->total}}</td>
                                    <td>{{$product->pivot->trans_status_id}}</td>
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
