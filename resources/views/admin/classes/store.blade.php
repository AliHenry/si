@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Create Class</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('classes.index')}}">Classes</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('classes.store')}}" method="POST">
                            @csrf
                            <div class="card-header">
                                <h6>Class Form</h6>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail">Code</label>
                                    <input type="text" class="form-control" name="code" id="exampleInputName"
                                           aria-describedby="emailHelp" placeholder="Enter Class Code">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputName"
                                           aria-describedby="emailHelp" placeholder="Enter Class Name">
                                </div>

                                <input type="submit" class="btn btn-primary" value="Create Class">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
