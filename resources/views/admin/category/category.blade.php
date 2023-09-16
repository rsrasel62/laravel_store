@extends('layouts.dashboard')
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Category</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <table class="table table-striped">
                <tr>
                    <th>Sl</th>
                    <th>Category name</th>
                    <th>Category Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($categories as $sl=>$category)            
                <tr>
                    <td>{{ $sl+1 }}</td>
                    <td>{{ $category->category_name}}</td>
                    <td><img src="{{ asset('uploads/category')}}/{{ $category->category_image}}" alt=""></td>
                    <td> </td>
                    <td><div class="dropdown mb-2">
                        <button class="btn p-0" type="button" id="dropdownMenuButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg text-muted pb-3px"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7" style="">
                          <a class="dropdown-item d-flex align-items-center" href="{{ route('category.edit', $category->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 icon-sm mr-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> <span class="">Edit</span></a>
                          <a class="dropdown-item d-flex align-items-center delete" data-link="{{ route('category.delete', $category->id)}}" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash icon-sm mr-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> <span class="">Delete</span></a>
                        </div>
                      </div></td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="col-lg-4">
                <div class="card">
                    @can('add_category')
                    <div class="card-body">
                        <h4 class="card-title">Add new category</h4>
                        <form class="cmxform"  method="POST" action="{{ route('category.store')}}" enctype="multipart/form-data">
                            @csrf
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success')}}</div>
                            @endif
                                <div class="form-group">
                                    <label for="name">Category name</label>
                                    <input id="name" class="form-control" name="category_name" type="text" autocompleate="off" value="{{ old('category_name')}}">
                                    @error('category_name')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input id="email" class="form-control" name="category_image" type="file" >
                                    @error('category_image')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success">submit</button>
                            
                        </form>
                    </div> 
                    @endcan

                </div>
        </div>
    </div>
</div>
@endsection



@section('footer_srcipt')
    <script>
        $('.delete').click(function(){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                var link = $(this).attr('data-link');
                window.location.href = link;
            }
            })
        })
    </script>
    @if ( session('success'))
    <script>
     Swal.fire(
        'Deleted!',
        '{{ session('successs') }}',
        'success'
      )
    </script>

    @endif
@endsection