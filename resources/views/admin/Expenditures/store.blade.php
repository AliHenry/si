@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Create Expenditure</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('expenditures.index')}}">Expenditures</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('expenditures.store')}}" method="POST">
                            @csrf
                            <div class="card-header">
                                <h6>Expenditure Form</h6>
                            </div>
                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Title</label>
                                        <input type="text" class="form-control" name="title" id="inputFirstName"
                                               placeholder="Enter Title">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">Type</label>
                                        <select name="type_id" id="type_id" class="form-control ls-select2">
                                            <option value="{{null}}"> -- select type -- </option>
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Amount</label>
                                        <input type="text" class="form-control" name="amount" id="inputFirstName"
                                               placeholder="Enter Amount">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Paid To</label>
                                        <input type="text" class="form-control" name="paid_to" id="inputFirstName"
                                               placeholder="Enter Person Paid to">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlFile1">Image</label>
                                        <input type="file" class="form-control-file" name="avatar" id="exampleFormControlFile1">
                                        <small class="text-muted">Upload image should not be more than 2MP.
                                        </small>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Create Expenditure">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
