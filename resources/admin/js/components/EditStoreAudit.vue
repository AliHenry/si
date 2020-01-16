<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="card-header">
                                <h6>Store Audit Form</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label><b>Date:</b></label>
                                        {{audit.created_at}}

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><b>Store:</b></label>
                                        {{audit.store.name}}
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label><b>Balanced:</b></label>
                                        {{audit.balanced}}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><b>Unbalanced:</b></label>
                                        {{audit.unbalanced}}

                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label><b>Audit Manager:</b></label>
                                        {{audit.user.name}}

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><b>Note:</b></label>
                                        {{audit.note}}
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </form>
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
                        <table id="departments-datatable" class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Successful</th>
                            </tr>
                            </thead>
                            <tr v-for="product in audit.products">
                                <td>{{product.code}}</td>
                                <td>{{product.name}}</td>
                                <td>
                                    <input v-model="product.pivot.balanced" type="checkbox"
                                           class="form-control ls-switch" data-color="#007dcc"/>
                                </td>
                            </tr>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['audit'],

        data() {
            return {
                products: [],
                cateID: null,
                showInvoice: false,
                getAmount: true,
                showAmount: false,
                paidAmount: '',
                paidInvoice: false,
                inputId: null,
            }
        },

        // mounted () {
        //   this.showInvoice = false;
        //   this.showAmount = false;
        // },

        methods: {
            fetchProduct() {
                console.log(this.cateID)
                axios.get('fetch-product?category=' + this.cateID).then(res => {
                    this.products = res.data;
                    console.log(res.data);
                })
            },

            verified(auditId, productID) {
                let data = {
                    audit: auditId,
                    product: productID
                };
                console.log(data);
                axios.post('audits-verification', data).then(res => {
                    if (res.data) {
                        this.fetchProduct();
                    }

                    console.log(res.data);
                })
            },

            unVerified(auditId, productID, missing) {
                console.log(missing);
                let data = {
                    audit: auditId,
                    product: productID,
                    missing: missing,
                    note: 'none'
                };
                console.log(data);
                axios.post('audits-unverified', data).then(res => {
                    if (res.data) {
                        this.fetchProduct();
                    }

                    console.log(res.data);
                })
            },


            // fetchProduct() {
            //     axios.get('payment?code=' + this.customerCode).then(res => {
            //         this.showInvoice = true;
            //         this.getAmount = false;
            //         this.showAmount = true;
            //         this.bill = res.data;
            //         console.log(res.data);
            //     })
            // },

            printme() {
                window.print();
            },


            makePayment() {
                if (this.paidAmount === '') {
                    toastr['warning']('Input Amount', 'Warning');
                    return;
                }
                let data = {
                    paid_amount: this.paidAmount,
                    code: this.customerCode,

                };

                axios.post('payment', data).then(res => {
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

