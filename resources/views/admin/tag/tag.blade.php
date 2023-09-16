@extends('layouts/dashboard')
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Category/edit</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        @can('show_tag')
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Tag list</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td>Sl</td>
                            <td>Tag name</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($tags as $sl=>$tag)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $tag->tag_name}}</td>
                            <td>
                                <a href="{{ route('tag.delete', $tag->id )}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        @endcan
        @can('add_tag')           
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h3>Add tag</h3>
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('tag.store') }}" method="POST">
                    @csrf
                    
                    @if (session('success'))
                        
                        <strong class="text-success">{{ session('success') }}</strong>
                    @endif
                    <div class="form-group">
                        <label for="image">Tag name:</label>
                        <input  class="form-control" name="tag_name" type="text" >
                        @error('tag_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @endcan
    </div>
</div>
@endsection