@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/roles/roles.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Zones</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('zones.index')}}">Zones</a></li>
                <li class="breadcrumb-item active">Zones</li>
            </ol>
            <div class="page-actions">
                @permission('create.zones')
                    <a href="{{route('zones.create')}}" class="btn btn-primary"><i class="icon-fa icon-fa-plus"></i> New Zones</a>
                @endpermission
                <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Delete </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>All Zones</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="roles-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($zones as $zone)
                            <tr>
                                <td>{{$zone->id}}</td>
                                <td>{{$zone->code}}</td>
                                <td>{{$zone->name}}</td>
                                <td>
                                    @permission('view.zones')
                                        <a href="{{route('zones.show',$zone->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-search"></i> View</a>
                                    @endpermission
                                    @permission('edit.zones')
                                        <a href="{{route('zones.edit',$zone->id)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Edit</a>
                                    @endpermission
                                    @permission('delete.zones')
                                        <a href="{{route('zones.destroy',$zone->id)}}" class="btn btn-default btn-sm" data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i class="icon-fa icon-fa-trash"></i> Delete</a></td>
                                    @endpermission

                            </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
