@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/release/release.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Release Product Detail</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('release.products.index')}}">Release Products</a></li>
                <li class="breadcrumb-item active">{{$sell->transaction_id}}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-12 mt-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Code:</b></label>
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
                                    <label for="inputFirstName"><b>Number of Item(s):</b></label>
                                    {{count($sell->products)}}

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName"><b>Date:</b></label>
                                    {{$sell->created_at}}
                                </div>
                            </div>
                            <hr>
                            <a href="{{route('release.invoice', ['id' => $sell->id])}}" class="btn btn-primary">Print Receipt</a>
                        </div>
                    </div>
                </div>
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
                        <table id="release-datatable"
                               class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($sell->products as $product)
                                <tr>
                                    <td>{{$product->code}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->pivot->qty}}</td>
                                    <td>{{$product->pivot->trans_status_id == 1 ? 'Paid' : 'Released'}}</td>
                                    <td>
                                        <input id="release-product" name="featured"
                                               type="checkbox"
                                               class="form-control ls-switch"
                                               {{$product->pivot->trans_status_id == 2 ? 'checked' : '' }} data-color="#007dcc"
                                               data-id="{{$product->id}}"
                                               data-sell="{{$sell->id}}"
                                               data-url="{{route('release.products.send')}}"
                                               />
                                    </td>
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
