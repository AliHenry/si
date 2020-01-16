@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/departments/departments.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Create Store Audit</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('audits.index')}}">Store Audits</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('audits.store')}}" method="POST">
                            @csrf
                            <div class="card-header">
                                <h6>Store Audit Form</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Category</label>
                                        <select class="form-control" name="category">
                                            <label>Category</label>
                                            <option value="{{null}}" selected>-- Select Store --</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary">Start Audit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
{{--        <div class="row">--}}
{{--            <div class="col-sm-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h6>All Products</h6>--}}

{{--                        <div class="card-actions">--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}

{{--                        <table id="departments-datatable" class="table table-striped table-bordered" cellspacing="0"--}}
{{--                               width="100%">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>#</th>--}}
{{--                                <th>Name</th>--}}
{{--                                <th>Current Qty</th>--}}
{{--                                <th>Verify</th>--}}
{{--                                <th>Unverify</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tr v-for="product in products">--}}
{{--                                <th>{{product.code}}</th>--}}
{{--                                <td>{{product.name}}</td>--}}
{{--                                <td>{{product.qty}}</td>--}}
{{--                                <td v-if="!product.pivot">--}}
{{--                                    <button class="btn btn-primary" @click.prevent="verified(cateID, product.id)">--}}
{{--                                        Verify--}}
{{--                                    </button>--}}
{{--                                    <p v-if="product.pivot.missing > 0 && product.pivot.balanced == 0">Not Balanced</p>--}}
{{--                                    <p v-if="product.pivot.missing === 0 && product.pivot.balanced == 1">verified</p>--}}
{{--                                </td>--}}
{{--                                <td v-if="product.pivot">--}}
{{--                                    <button v-if="product.pivot.balanced == 0" class="btn btn-primary"--}}
{{--                                            @click.prevent="verified(product.pivot.store_audit_id, product.id)">Verify--}}
{{--                                    </button>--}}
{{--                                    <p v-if="product.pivot.missing > 0 && product.pivot.balanced == 0">Not Balanced</p>--}}
{{--                                    <p v-if="product.pivot.missing === 0 && product.pivot.balanced == 1">verified</p>--}}
{{--                                </td>--}}
{{--                                <td v-if="product.pivot">--}}
{{--                                    <input v-if="product.pivot.balanced == 0" type="number" name="product.pivot.missing"--}}
{{--                                           v-model="product.pivot.missing">--}}
{{--                                    <button v-if="product.pivot.balanced == 0" class="btn btn-danger"--}}
{{--                                            @click.prevent="unVerified(product.pivot.store_audit_id, product.id, product.pivot.missing)">--}}
{{--                                        Send Report--}}
{{--                                    </button>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tbody>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@stop
