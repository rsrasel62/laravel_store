@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <form action="{{ route('all.check.delete')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="card">
                    <div class="card-header">
                        <h3>Trash user list: <span class="float-right">Trash count:{{ $count}}</span></h3>
                        <button name="click" value="1" type="submit" class="btn btn-success">Restore check</button>
                        <button type="click" value="2" type="submit" class="btn btn-danger">Delete check</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                        <tr>
                            <th>
                                <input type="checkbox" id='checkAll'> Check all
                            </th>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>image</th>
                            <th>Action</th>
                            <th>Restore</th>
                        </tr>
                        @foreach ($users as $sl=>$user)   
                        <tr>
                            <td>
                                <input type="checkbox" name="check[]" value="{{ $user->id }}">
                            </td>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email}}</td>
                            <td>
                                @if ($user->image == null)
								<img src="{{ Avatar::create($user->name)->toBase64() }}" />

                                @else
                                <img src="{{ asset('uploads/user')}}/{{ $user->image}}" alt=""></td>

                                @endif

                            </td>
                            <td>
       
                                <a href="{{ route('user.restore', $user->id)}}" class="btn btn-success">Restore</a>
                            </td>
                            <td>
                                <a href="{{ route('hard.delete', $user->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                            
                        </tr>
                        @endforeach
   
                    </table>
                    <div class="py-2">
                        {{ $users->links() }}
                    </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
@section('footer_srcipt')
<script>
    $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>
@endsection