@extends('layouts.dashboard');
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Update user permission</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('update.permission')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <span class="badge badge-success">{{ $user->name}}</span><span class="float-right badge badge-warning">@foreach ($user->getRoleNames() as $role)
                                {{ $role }}
                            @endforeach</span>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" value="{{ $user->id}}" name="user_id">
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <h3>Permission</h3>
                                @foreach ($permissions as $permission)
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input {{ ($user->hasPermissionTo($permission->name))?'checked':''}} type="checkbox" class="form-check-input" name="permission[]" value="{{ $permission->id}}">
                                        {{ $permission->name}}
                                        <i class="input-frame"></i></label>
                                    </div>
                                 @endforeach
    
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-success" type="submit">Update</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection