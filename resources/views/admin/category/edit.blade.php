@extends('layouts/dashboard')
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Category/edit</li>
    </ol>
</nav>
<div class="container-fluid">
    @can('category_update')
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add new category</h4>
                <form class="cmxform"  method="POST" action="{{ route('category.update')}}" enctype="multipart/form-data">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success')}}</div>
                    @endif
                    <input type="hidden" name="category_id" value="{{ $category->id}}">
                        <div class="form-group">
                            <label for="name">Category name</label>
                            <input id="name" class="form-control" name="category_name" type="text" autocompleate="off" value="{{ $category->category_name}}">
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
                            <div class="mt-2">
                                <img src="{{ asset('uploads/category')}}/{{$category->category_image}}" alt="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">submit</button>
                    
                </form>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection
