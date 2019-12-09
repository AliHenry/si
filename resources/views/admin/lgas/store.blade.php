@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Create LGA</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('lgas.index')}}">LGAs</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('lgas.store')}}" method="POST">
                            @csrf
                            <div class="card-header">
                                <h6>Country Form</h6>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputName"
                                           aria-describedby="emailHelp" placeholder="Enter Permission Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Country</label>
                                    <select name="state_id" id="designation" class="form-control ls-select2">
                                        <option value="{{null}}"> -- select country -- </option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Create LGA">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
