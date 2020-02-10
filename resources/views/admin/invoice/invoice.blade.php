<div class="container">
    <div class="row">
        <div class="col-12">

            <!-- Main content -->
            <div class="invoice p-3 mb-3 mt-5">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fa fa-globe"></i> S.I Comprehensive.
                            <small class="float-right">Date: {{\Carbon\Carbon::now()->format('d/m/y')}}</small>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>S.I. Comprehensive</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (804) 123-5432<br>
                            Email: info@almasaeedstudio.com
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <hr>
                        To
                        <address>
                            <strong>{{$sell->cust_name ? $sell->cust_name : $sell->customer->first_name.' '.$sell->customer->middle_name.' '.$sell->customer->last_name}}</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (555) 539-1037<br>
                            Email: john.doe@example.com
                        </address>
                        <hr>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice #{{$sell->transaction_id}}</b><br>
                        <br>
                        <b>Order ID:</b> 4F3S8J<br>
                        <b>Payment Due:</b> 2/22/2014<br>
                        <b>Account:</b> 968-34567
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->

                <div class="row">
                    <hr>
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sell->products as $product)
                                <tr>
                                    <td>{{$product->pivot->qty}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{priceFormat($product->pivot->total)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                        <p class="lead">Payment Methods: <b>{{$sell->type->name}}</b></p>
                    </div>
                    <hr>
                    <!-- /.col -->
                    <div class="col-6">
                        <p class="lead">Amount Date {{\Carbon\Carbon::parse($sell->created_at)->format('d/m/y')}}</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>{{priceFormat($sell->sub_total)}}</td>
                                </tr>
                                <tr>
                                    <th>Tax (5%)</th>
                                    <td>{{$sell->tax}}</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>{{priceFormat($sell->total)}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">

                        <a href="" onClick="window.print()" target="_blank" class="btn btn-default"><i
                                    class="fa fa-print"></i> Print</a>

                        <a href="{{route('sells.index')}}" target="_blank" class="btn btn-default"><i
                                    class="fa fa-print"></i> Back Sells</a>
{{--                        <button type="button" class="btn btn-success float-right">--}}
{{--                            <i class="fa fa-credit-card"></i>--}}
{{--                            Submit Payment--}}
{{--                        </button>--}}

{{--                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">--}}
{{--                            <i class="fa fa-download"></i> Generate PDF--}}
{{--                        </button>--}}

                    </div>
                </div>

            </div>
            <!-- /.invoice -->
        </div>


    </div>
</div>