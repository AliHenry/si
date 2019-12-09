@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Edit Term</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('terms.index')}}">Terms</a></li>
                <li class="breadcrumb-item active">{{ $term->name }}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('terms.update', $term->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="card-header">
                                <h6>Term Form</h6>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputName"
                                           aria-describedby="emailHelp" value="{{$term->name}}"
                                           placeholder="Enter Permission Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Country</label>
                                    <select name="session_id" id="designation" class="form-control ls-select2">
                                        <option value="{{null}}"> -- select country -- </option>
                                        @foreach($sessions as $session)
                                            <option value="{{$session->id}}" {{$term->session_id == $session->id ? 'selected' : '' }}>{{$session->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Start Date</label>
                                    <input type="text" class="form-control ls-datepicker" name="start_date" value="{{ $term->start_date }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">End Date</label>
                                    <input type="text" class="form-control ls-datepicker" name="end_date" value="{{ $term->start_date }}">
                                </div>

                                <input type="submit" class="btn btn-primary" value="Edit Term">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
