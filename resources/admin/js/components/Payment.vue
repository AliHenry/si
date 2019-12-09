<template>
  <div class="main-content page-profile">
    <div class="row">
      <div class="col-12">
        <nav v-if="getAmount" class="page-header">
          <h3 class="page-title">Create Payment</h3>
          <div class="breadcrumb">
            <div class="col-sm-6">
              <input type="text" class="form-control"  v-model="customerCode"
                     placeholder="Enter Customer Code">
            </div>
            <div class="col-sm-6">
              <button class="btn btn-primary" @click.prevent="getBill">Get Bill</button>
            </div>
          </div>
        </nav>
        <nav v-if="showAmount" class="page-header">
          <h3 class="page-title">Create Payment</h3>
          <div class="breadcrumb">
            <div class="col-sm-6">
              <input type="text" class="form-control"  v-model="paidAmount"
                     placeholder="Enter Payment Amount">
            </div>
            <div class="col-sm-6">
              <button class="btn btn-primary" @click.prevent="makePayment">Make Payment</button>
            </div>
          </div>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-12">

        <!-- Main content -->
        <div v-if="showInvoice" class="invoice p-3 mb-3 mt-5">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fa fa-globe"></i> Bauchi State Water Board
                <small class="float-right">Date: {{ bill.payment_date}}</small>
              </h4>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              From
              <address>
                <strong>Bauchi State WaterBoard.</strong><br>
                Bauchi<br>
                Phone: (804) 123-5432<br>
                Email: info@almasaeedstudio.com
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              To
              <address>
                <strong>{{bill.customer.first_name+' '+bill.customer.middle_name+' '+bill.customer.last_name}}}</strong><br>
                {{bill.customer.address}}<br>
                Phone: {{bill.customer.phone}}<br>
                Email: {{bill.customer.email}}
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>Invoice #007612</b><br>
              <br>
              <b>Order ID:</b> {{ bill.code}}<br>
              <b>Payment Due:</b>{{ bill.payment_date}}<br>
              <b>Account:</b> {{ bill.customer.code}}
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
                  <td>₦ {{bill.arrears}}</td>
                </tr>
                <tr>
                  <td>Amount Due:</td>
                  <td>₦ {{bill.current_amount}}</td>
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
              <p class="lead">Amount Due {{ bill.payment_date}}</p>

              <div class="table-responsive">
                <table class="table">
                  <tbody>
                  <tr>
                    <th style="width:50%">Subtotal:</th>
                    <td>₦ {{ bill.arrears + bill.current_amount }}</td>
                  </tr>
                  <tr>
                    <th>Tax (9.3%)</th>
                    <td>0</td>
                  </tr>
                  <tr>
                    <th>Total:</th>
                    <td>₦ {{ bill.arrears + bill.current_amount }}</td>
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

              <a href="" @click.prevent="printme" target="_blank" class="btn btn-default"><i
                      class="fa fa-print"></i> Print</a>
              <button @click.prevent="makePayment" type="button" class="btn btn-success float-right">
                <i class="fa fa-credit-card"></i>
                Submit Payment
              </button>

<!--              <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">-->
<!--                <i class="fa fa-download"></i> Generate PDF-->
<!--              </button>-->

            </div>
          </div>

        </div>
        <!-- /.invoice -->


        <!-- Main content -->
        <div v-if="paidInvoice" class="invoice p-3 mb-3 mt-5">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fa fa-globe"></i> Bauchi State Water Board
                <small class="float-right">Date: {{ bill.payment_date}}</small>
              </h4>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              From
              <address>
                <strong>Bauchi State WaterBoard.</strong><br>
                Bauchi<br>
                Phone: (804) 123-5432<br>
                Email: info@almasaeedstudio.com
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              To
              <address>
                <strong>{{bill.customer.first_name+' '+bill.customer.middle_name+' '+bill.customer.last_name}}}</strong><br>
                {{bill.customer.address}}<br>
                Phone: {{bill.customer.phone}}<br>
                Email: {{bill.customer.email}}
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>Receipt #007612</b><br>
              <br>
              <b>Order ID:</b> {{ bill.code}}<br>
              <b>Payment Due:</b>{{ bill.payment_date}}<br>
              <b>Account:</b> {{ bill.customer.code}}
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
                  <td>₦ {{bill.oldArrears}}</td>
                </tr>
                <tr>
                  <td>Amount Due:</td>
                  <td>₦ {{bill.current_amount}}</td>
                </tr>
                <tr>
                  <td>Total:</td>
                  <td><b>₦ {{bill.oldArrears + bill.current_amount}}</b></td>
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
              <p class="lead">Amount Paid <b>₦ {{ bill.paid_amount}}</b></p>

              <div class="table-responsive">
                <table class="table">
                  <tbody>
                  <tr>
                    <th style="width:50%">Balance</th>
                    <td>₦ {{ bill.arrears }}</td>
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

              <a href="" @click.prevent="printme" target="_blank" class="btn btn-default"><i
                      class="fa fa-print"></i> Print</a>
              <button v-if="showAmount" @click.prevent="makePayment" type="button" class="btn btn-success float-right">
                <i class="fa fa-credit-card"></i>
                Submit Payment
              </button>

<!--              <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">-->
<!--                <i class="fa fa-download"></i> Generate PDF-->
<!--              </button>-->

            </div>
          </div>

        </div>
        <!-- /.invoice -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
  },

  data(){
    return {
      customerCode: '',
      bill: {},
      showInvoice: false,
      getAmount: true,
      showAmount: false,
      paidAmount: '',
      paidInvoice: false,
    }
  },

  mounted () {
    this.showInvoice = false;
    this.showAmount = false;
  },

  methods: {
    getBill(){
      axios.get('payment?code='+this.customerCode).then(res => {
        this.showInvoice = true;
        this.getAmount = false;
        this.showAmount = true;
        this.bill = res.data;
        console.log(res.data);
      })
    },

    printme() {
      window.print();
    },

    makePayment(){
      if (this.paidAmount === ''){
        toastr['warning']('Input Amount', 'Warning');
        return;
      }
      let data = {
        paid_amount: this.paidAmount,
        code: this.customerCode,

      };

      axios.post('payment', data ).then(res => {
        this.showInvoice = false;
        this.paidInvoice = true;
        this.showAmount = false;
        this.bill = res.data;
        console.log(res.data);
      })
    }
  }
}
</script>

