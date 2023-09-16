@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                @can('show_user_list')
                    <form action="{{ route('delete.check') }}" method="POST">
                        @csrf
                    
                        <div class="card">
                            <div class="card-header">
                                <h3>User list: <span class="float-right">Total:{{ $count_user }}</span></h3>
                                <h3>
                                    <button type="submit" class="btn btn-danger mt-2">Delete All</button>
                                </h3>
                                @if (session('null'))
                                <strong class="text-danger">{{ session('null')}}</strong>
                            @endif
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                    <th><input type="checkbox" id="checkAll"> Check All</th>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>image</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($users as $key=>$user)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="check[]" value={{ $user->id}}>
                                    </td>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>
                                        @if ($user->image == null)
                                        <img src="{{ Avatar::create($user->name)->toBase64() }}" />

                                        @else
                                        <img src="{{ asset('uploads/user')}}/{{ $user->image}}" alt=""></td>

                                        @endif
                                @can('user_delete')
                                    <td>
                                        <a href="{{ route('user.delete', $user->id)}}" class="btn btn-danger">Delete</a>
                                        
                                    </td>
                                @endcan
                                </tr>
                                
                                @endforeach
        
                            </table>
                            <div class="py-2">
                                {{ $users->links() }}
                            </div>
                        </div>


            
                    </form>   
                @else
                    <div class="container">
                            <div class="col-lg-8 m-auto">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h2>Ohh sorry You had'not any acces this section </h2>
                                        <img src="https://i.postimg.cc/3NSnJttC/index.jpg" alt="">

                                    </div>
                                </div>
                            </div>
                    </div>                                 
                @endcan
                </div>

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
