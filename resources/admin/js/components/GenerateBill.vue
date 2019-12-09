<template>
  <div class="main-content page-profile">
    <div class="row">
      <div class="col-12">
        <nav class=" page-header">
          <h3 class="page-title">Generate Bills</h3>
          <div class="breadcrumb">
            <div class="col-sm-6">
              <select name="zone" v-model="zone" id="" class=" form-control">
                <option value=""> -- select zone -- </option>
                <option v-for="item in zones"v-bind:value="item.id">{{item.name}}</option>
              </select>
            </div>
            <div class="col-sm-6">
              <button class="btn btn-primary" @click.prevent="generateBill">Generate Bill</button>
            </div>

          </div>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
<!--        <div>-->
<!--          <h3 v-if="bills.length > 0"> {{bills.length}} Bill{{bills.length > 1 ? 's' : ''}} generated.</h3>-->
<!--        </div>-->
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
      zones: [],
      zone: '',
      bills: [],
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
    axios.get('zones').then(res => {
      this.zones = res.data;
      console.log(res.data);
    })
  },

  methods: {
    generateBill(){
      axios({
        url: 'get-bills?zone='+this.zone,
        method: 'GET',
        responseType: 'blob',
      }).then((response) => {
        var fileURL = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement('a');

        fileLink.href = fileURL;
        fileLink.setAttribute('download', 'bills.pdf');
        document.body.appendChild(fileLink);

        fileLink.click();
        toastr['success']('Bill Successfully Downloaded', 'Success')
      });
      // axios.get('get-bills?zone='+this.zone).then(res => {
      //   this.bills = res.data;
      //   console.log(res.data);
      // })
    },

    printme() {
      window.print();
    },

    makePayment(){
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

