@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Edit Role</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Role</a></li>
                <li class="breadcrumb-item active">{{ $role->name }}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('roles.update', $role->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="card-header">
                                <h6>Roles Form</h6>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputName"
                                           aria-describedby="emailHelp" value="{{$role->name}}"
                                           placeholder="Enter Permission Name">
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea class="form-control" name="description"
                                                  id="exampleFormControlTextarea1"
                                                  rows="3">{{$role->description}}</textarea>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Edit Role">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Users</strong></label>
                                        @foreach($permissions as $permission)
                                                @if($permission->type === 'users')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                                @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Roles</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'roles')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage
                                                Permissions</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'permissions')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Employees</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'employees')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Employee Attendance</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'attendance')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Sells</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'sells')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Loans</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'loans')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Audit</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'audit')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Audit Sells</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'audit sells')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Audit Purchase</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'audit purchase')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Payment Types</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'payment-types')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Payment Status</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'payment-status')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Customers</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'customers')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Store Audit</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'store_audit')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Products</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'products')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Release Products</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'release-products')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Purchase</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'purchase')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Suppliers</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'suppliers')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Expenditure</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'expenditures')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Expenditure Types</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'expenditure-types')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Categories</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'categories')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Brands</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'brands')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Banks</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'banks')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage Countries</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'country')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage State</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'state')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"><strong>Manage LGAs</strong></label>
                                        @foreach($permissions as $permission)
                                            @if($permission->type === 'lga')
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="permissions[]"
                                                                   value="{{ $permission->id }}"
                                                                   class="form-check-input"
                                                                   @if($role->permissions->contains($permission)) checked @endif>{{$permission->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
