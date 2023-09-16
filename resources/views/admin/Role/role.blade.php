@extends('layouts.dashboard')
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Permission</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h3>Role table</h3>
                </div>
                <div class="card-body">
                    <table class='table table-striped'>
                        <tr>
                            <td>Sl</td>
                            <td>Admin</td>
                            <td>Permission</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($roles as $sl=>$role )                          
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach ($role->getAllPermissions() as $permission)
                                <span class="badge badge-primary">{{ $permission->name }}</span>
                                    
                                @endforeach
                            </td>
                            <td>Action</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>User Role List</h3>
                </div>
                <div class="card-body">
                    <table class='table table-striped'>
                        <tr>
                            <td>Sl</td>
                            <td>Admin</td>
                            <td>Role</td>
                            <td>Permission</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($users as $sl=>$user )                          
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @forelse ($user->getRoleNames() as $role)
                                    <span class="badge badge-primary">{{ $role}}</span>
                                @empty
                                    <span class="badge badge-danger">Not assign role</span>
                                @endforelse

                            </td>
                            <td>
                                @forelse ($user->getAllPermissions() as $permission)
                                    <span class="badge badge-primary">{{ $permission->name}}</span>
                                @empty
                                    <span class="badge badge-danger">Not assign permission</span>
                                @endforelse
                               
                            </td>
                            <td>
                                <a href="{{ route('eidt.user.permission', $user->id)}}" class="btn btn-info">Edit</a>
                                <a href="{{ route('remove.role', $user->id)}}" class="btn btn-warning">Remove</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            {{-- <div class="card">
                <div class="card-header">
                    <h3>Permission</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('permission.store')}}" method="POST" >
                        @csrf
                        <div class="form-group">
                            <input id="" class="form-control" name="permission_name" type="text" >
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div> --}}
            <div class="card">
                <div class="card-header">
                    <h3>Permission</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.store')}}" method="POST" >
                        @csrf
                        <div class="form-group">
                            <h3>Role name:</h3>
                            <input id="" class="form-control" name="role_name" type="text" placeholder="Role name">
                        </div>
                        <div class="form-group">
                            <h3>Permission</h3>
                            @foreach ($permissions as $permission)
                                
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="permission[]" value="{{ $permission->id}}">
                                    {{ $permission->name}}
                                    <i class="input-frame"></i></label>
                                </div>
                             @endforeach

                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Assign Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('assign.role')}}" method="POST" >
                        @csrf
                        <div class="form-group">
                            <select name="user_id" id="" class="form-control user_id">
                                <option value="" selected >---selct user----</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id}}">{{ $user->name}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <strong class="text-danger">{{ $message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select name="role_id" id="" class="form-control">
                                <option value="">---selct role----</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id}}">{{ $role->name}}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <strong class="text-danger">{{ $message}}</strong>
                        @enderror
                        </div>
  
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Assign Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_srcipt')
<script>
    $(document).ready(function() {
    $('.user_id').select2();
});
</script>
@endsection