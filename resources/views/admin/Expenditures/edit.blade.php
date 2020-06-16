@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Edit Expenditure</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('expenditures.index')}}">Expenditures</a></li>
                <li class="breadcrumb-item active">{{ $expenditure->title }}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('expenditures.update', $expenditure->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="card-header">
                                <h6>Expenditure Form</h6>
                            </div>
                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Title</label>
                                        <input type="text" class="form-control" name="title" id="inputFirstName"
                                               placeholder="Enter Title" value="{{$expenditure->title}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail">Type</label>
                                        <select name="type_id" id="type_id" class="form-control ls-select2">
                                            <option value="{{null}}"> -- select type -- </option>
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}" {{$type->id == $expenditure->type_id ? 'selected' : ''}}>{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Amount</label>
                                        <input type="text" class="form-control" name="amount" id="inputFirstName"
                                               placeholder="Enter Amount" value="{{$expenditure->amount}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Paid To</label>
                                        <input type="text" class="form-control" name="paid_to" id="inputFirstName"
                                               placeholder="Enter Person Paid to" value="{{$expenditure->paid_to}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{$expenditure->description}}</textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlFile1">Image</label>
                                        <input type="file" class="form-control-file" name="avatar" id="exampleFormControlFile1">
                                        <small class="text-muted">Upload image should not be more than 2MP.
                                        </small>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Edit Expenditure">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
