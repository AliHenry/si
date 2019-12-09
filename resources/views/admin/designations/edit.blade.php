@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Edit Designation</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('designations.index')}}">Designation</a></li>
                <li class="breadcrumb-item active">{{ $designation->name }}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('designations.update', $designation->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="card-header">
                                <h6>Designation Form</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputName"
                                           aria-describedby="emailHelp" value="{{$designation->name}}"
                                           placeholder="Enter Designation Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Department</label>
                                    <select name="department" class="form-control ls-select2">
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{ $department->id == $designation->dept_id ? 'selected' : '' }}>{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Edit Designation">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
