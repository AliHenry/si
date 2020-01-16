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
                                        <label>Category</label>
                                        <select class="form-control" v-model="cateID">
                                            <label>Category</label>
                                            <option selected>-- Select Store --</option>
                                            <option v-for="category in categories" v-bind:value="category.id">{{
                                                category.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary" @click.prevent="fetchProduct">Start Audit</button>
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
                                <th>#</th>
                                <th>Name</th>
                                <th>Current Qty</th>
                                <th>Verify</th>
                                <th>Unverify</th>
                            </tr>
                            </thead>
                            <tr v-for="product in products">
                                <th>{{product.code}}</th>
                                <td>{{product.name}}</td>
                                <td>{{product.qty}}</td>
                                <td v-if="!product.pivot">
                                    <button class="btn btn-primary" @click.prevent="verified(cateID, product.id)">
                                        Verify
                                    </button>
                                    <p v-if="product.pivot.missing > 0 && product.pivot.balanced == 0">Not Balanced</p>
                                    <p v-if="product.pivot.missing === 0 && product.pivot.balanced == 1">verified</p>
                                </td>
                                <td v-if="product.pivot">
                                    <button v-if="product.pivot.balanced == 0" class="btn btn-primary"
                                            @click.prevent="verified(product.pivot.store_audit_id, product.id)">Verify
                                    </button>
                                    <p v-if="product.pivot.missing > 0 && product.pivot.balanced == 0">Not Balanced</p>
                                    <p v-if="product.pivot.missing === 0 && product.pivot.balanced == 1">verified</p>
                                </td>
                                <td v-if="product.pivot">
                                    <input v-if="product.pivot.balanced == 0" type="number" name="product.pivot.missing"
                                           v-model="product.pivot.missing">
                                    <button v-if="product.pivot.balanced == 0" class="btn btn-danger"
                                            @click.prevent="unVerified(product.pivot.store_audit_id, product.id, product.pivot.missing)">
                                        Send Report
                                    </button>
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
        props: ['categories'],

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
                columns: [
                    {label: 'id', field: 'id'},
                    {label: 'Name', field: 'name'},
                    {label: 'Email', field: 'email'}
                ],
                rows: [{id: 1, name: "Aliyu", email:'@gmail.com'}],
                page: 1,
                per_page: 10,
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

