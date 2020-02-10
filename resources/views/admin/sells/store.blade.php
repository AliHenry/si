@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/sells/sells.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('sells.index')}}">Sells</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Large modal -->
                        <button class="btn btn-primary" data-toggle="modal" data-target=".ls-example-modal-lg" {{ Cart::count() > 0 ? '' : 'disabled' }}>Make Payment</button>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <h5><label for="inputFirstName">Sub Total</label>
                                    {{ priceFormat(Cart::subtotal()) }}</h5>

                            </div>
                            <div class="form-group col-md-6">
                                <h5><label for="inputFirstName">Tax</label>
                                    {{ Cart::tax() }}</h5>

                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <h4><label for="inputFirstName">Total Count</label>
                                    {{ Cart::count() }}</h4>

                            </div>
                            <div class="form-group col-md-6">
                                <h4><label for="inputFirstName">Total</label>
                                    {{ priceFormat(Cart::total()) }}</h4>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="sells-datatable" class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Image</th>
                                {{--                                <th>Code</th>--}}
                                <th>Name</th>
                                <th>Category</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Brand</th>
                                <th>Measure</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($products as $product)
                                <tr>
                                    <td><img height="50" src="{{productImage($product->image)}}"
                                             alt="{{$product->name}}"></td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>{{$product->qty}}</td>
                                    <td>{{priceFormat($product->price)}}</td>
                                    <td>{{$product->brand ? $product->brand->name : 'none'}}</td>
                                    <td>{{$product->measure}}</td>
                                    <td>
                                        <button id="add-cart"
                                                class="btn btn-secondary"
                                                data-id="{{$product->id}}"
                                                data-name="{{$product->name}}"
                                                data-price="{{$product->price}}"
                                                data-url="{{route('add.cart')}}">
                                            Add
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header">
                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="cart-datatable" class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach(Cart::content() as $key => $item)
                                <tr>
                                    <td>{{$item->model->name}}</td>
                                    <td><input id="change_qty" data-id="{{$item->rowId}}"
                                               data-url="{{route('update.cart.qty')}}"
                                               name=" cart_qty" type="number"
                                               value="{{$item->qty}}" min="0">
                                    </td>
                                    <td>{{priceFormat($item->model->price)}}</td>
                                    <td>
                                        <button id="delete-cart"
                                                class="btn btn-danger"
                                                data-id="{{$item->rowId}}"
                                                data-url="{{route('delete.cart')}}">
                                            Delete
                                        </button>
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
    <div class="modal fade ls-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="overflow:hidden;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('sells.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h6>Product Form</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6" id="customer-name" style="display: none">
                                    <label for="inputFirstName">Customer Name</label>
                                    <input type="text" class="form-control" name="cust_name"
                                           placeholder="Product Name">
                                </div>
                                <div class="form-group col-md-6" id="customer-users" style="display: none">
                                    <label>Customer</label>
                                    <select name="cus_id" class="form-control ls-select2" style=" width: 100%">
                                        <option value="{{null}}" selected>-- Select Customer --</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{getFullName($customer).' '.$customer->phone}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Payment Type</label>
                                    <select class="form-control" name="payment_type" id="payment-type">
                                        <option value="{{null}}" selected>-- Select Payment Type --</option>
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6" id="pos-code" style="display: none">
                                    <label for="inputFirstName">POS Code</label>
                                    <input type="text" class="form-control" name="pos_code"
                                           placeholder="POS Code">
                                </div>
                                <div class="form-group col-md-6" id="received-payment" style="display: none">
                                    <label for="inputFirstName">Received Payment</label>
                                    <input id="pay" type="text" class="form-control" name="paid" data-total="{{ str_replace(",", "", Cart::total()) }}"
                                           placeholder="Enter Cash Received">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName">Sub Total</label>
                                    {{ priceFormat(Cart::subtotal()) }}

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName">Tax</label>
                                    {{ Cart::tax() }}

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <h4><label for="inputFirstName">Total Count</label>
                                        {{ Cart::count() }}</h4>

                                </div>
                                <div class="form-group col-md-6">
                                    <h4><label for="inputFirstName">Total</label>
                                        {{ priceFormat(Cart::total()) }}</h4>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6" id="payment-change" style="display: none">
                                    <h4 class="change"></h4>

                                </div>
                            </div>


                            <input type="submit" class="btn btn-primary" value="Make Payment">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop
