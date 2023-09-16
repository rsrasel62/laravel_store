@extends('layouts.dashboard')
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">add post</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>show about</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td>Sl</td>
                            <td>Title</td>
                            <td>Desciption</td>
                            <td>image</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($abouts as $sl=>$about)
                            
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $about->title}}</td>
                            <td>{{ substr($about->desp, 1, 40)}}</td>
                            <td>
                                <img src="{{ asset('uploads/about')}}/{{ $about->image}}" alt="">
                            </td>
                            <td>
                                <a href="{{ route('delete.us', $about->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h2>Add about</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('add.about')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                                <div class="mb-3">
                                    <label for="" class="">Title:</label>
                                    <input type="text" class="form-control" name="title">
                                    @error('title')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="" class="">Description:</label>
                                    <textarea name="desp" class="form-control" id="summernote" cols="30" rows="10"></textarea>
                                    @error('desp')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="">Image:</label>
                                    <input type="file" class="form-control" name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                                <div class="mb-3">
                                    <img width="200" id="blah" src="" alt="">
                                </div>
                                <button class="btn btn-success">Submit</button>
    
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
        $('#summernote').summernote();
        });
    </script>
@endsection