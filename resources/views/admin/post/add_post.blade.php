@extends('layouts.dashboard');
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">add post</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
          <h2>Add new post</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">    
                            <label for="">Add category</label>
                            <select name="category_id" class="form-control search">
                                <option value="">--select category--</option>                 
                                    @foreach ($categories as $category)
                                        <option  value="{{ $category->id}}">{{ $category->category_name}}</option>                                  
                                    @endforeach              
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Post Titile</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">short_desp</label>
                            <textarea name="short_desp" id='summernote' class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Post Description</label>
                            <textarea name="desp" id='summernote' class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <h2>Select Tag</h2>
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox"  value="{{ $tag->id}}" name="tag_id[]" class="form-check-input">
                                        {{ $tag->tag_name}}
                                    <i class="input-frame"></i></label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="">Featured Image</label>
                            <input type="file" name="feat_image" class="form-control"> 
                        </div>
                        <button type="submit" class="btn btn-success form-control"> Add Post</button>

                    </div>

                </div>
           </form>
        </div>
    </div>
</div>
@endsection
@section('footer_srcipt')
<script>
    $(document).ready(function() {
    $('.search').select2();
});
</script>
<script>
    $(document).ready(function() {
  $('#summernote').summernote();
});
</script>
@endsection