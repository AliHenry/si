<hmtl>
    <head>
        <link href="{{ mix('/assets/admin/css/laraspace.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="invoice p-3 mb-3 mt-5">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fa fa-globe"></i> Bauchi State Water & Sewerage Corporation
                                <small class="float-right">Date: {{ $bill->payment_date}}</small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>Bauchi State Water & Sewerage Corporation.</strong><br>
                                Bauchi<br>
                                Phone: (804) 123-5432<br>
                                Email: info@almasaeedstudio.com
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>{{$bill->customer->first_name.' '.$bill->customer->middle_name.' '.$bill->customer->last_name}}</strong><br>
                                {{$bill->customer->address}}<br>
                                Phone: {{$bill->customer->phone}}<br>
                                Email: {{$bill->customer->email}}
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #007612</b><br>
                            <br>
                            <b>Order ID:</b> {{ $bill->code}}<br>
                            <b>Payment Due:</b>{{ $bill->payment_date}}<br>
                            <b>Account:</b> {{ $bill->customer->code}}
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <!--                <tr>-->
                                <!--                  <th>Qty</th>-->
                                <!--                  <th>Product</th>-->
                                <!--                  <th>Serial #</th>-->
                                <!--                  <th>Description</th>-->
                                <!--                  <th>Subtotal</th>-->
                                <!--                </tr>-->
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Arrears:</td>
                                    <td>{{$bill->arrears}}</td>
                                </tr>
                                <tr>
                                    <td>Amount Due:</td>
                                    <td>{{$bill->current_amount}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <!-- /.col -->
                        <div class="col-6">
                            <p class="lead">Amount Due {{ $bill->payment_date}}</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>{{ $bill->arrears + $bill->current_amount }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tax (9.3%)</th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>{{ $bill->arrears + $bill->current_amount }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                </div>
            </div>
        </div>
    </div>
    </body>
</hmtl>