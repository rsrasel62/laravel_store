@extends('layouts.dashboard')
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
            <form action="{{ route('post.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">    
                            <label for="">category</label>
                            <select name="category_id" class="form-control search">
                                <option value="">--select category--</option>                 
                                    @foreach ($categories as $category)
                                        <option {{ ($post_info->category_id == $category->id)?'selected':''}} value="{{ $category->id}}">{{ $category->category_name}}</option>                                  
                                    @endforeach              
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" value="{{ $post_info->id}}" name="post_id">
                            <label for="">Post Titile</label>
                            <input type="text" name="title" value="{{ $post_info->title }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">short_desp</label>
                            <textarea name="desp" id='summernote' class="form-control" cols="30" rows="10">{!! $post_info->short_desp!!}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Post Description</label>
                            <textarea name="desp" id='summernote' class="form-control" cols="30" rows="10">{!! $post_info->desp!!}</textarea>
                        </div>
                        <div class="mb-3">
                            <h2>Select Tag</h2>
                            @php
                                $explode = explode(',',$post_info->tag_id);
                            @endphp
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" 
                                         @foreach ($explode as $tag_id)
                                             {{ ($tag_id == $tag->id?'checked':'')}}
                                         @endforeach
                                        value="{{ $tag->id}}" name="tag_id[]" class="form-check-input">
                                        {{ $tag->tag_name}}
                                    <i class="input-frame"></i></label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="">Featured Image</label>
                            <input type="file" name="feat_image" class="form-control"     onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"> 
                            <div class="my-3">
                                <img id="blah" width="500" src="{{ asset('uploads/post/'.$post_info->feat_image)}}" alt="">
                            </div>
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