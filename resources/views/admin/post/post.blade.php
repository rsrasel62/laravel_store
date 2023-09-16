@extends('layouts.dashboard');
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">View post</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>Post list</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Sl</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Tag</th>
                            <th>feat Image</th>
                            <th>action</th>
                        </tr>
                        @foreach ($my_post as $sl=>$post)                         
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{$post->rel_to_category->category_name}}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                                @php
                                    $after_explode = explode(',', $post->tag_id);
                                @endphp
                                @foreach ($after_explode as $tag_id)
                                   @php
                                       $tags = App\Models\Tag::where('id',$tag_id)->get();
                                   @endphp
                                   @foreach ($tags as $tag)
                                       <span class="badge badge-primary">{{ $tag->tag_name}}</span>
                                   @endforeach
                                @endforeach
                            </td>
                            <td>
                                <img src="{{ asset('uploads/post')}}/{{ $post->feat_image}}" alt="">
                            </td>
                            <td>
                                <a href="{{ route('view.post', $post->id)}}" class="btn btn-success">View</a>
                                <a href="{{ route('post.edit', $post->id)}}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('post.delete', $post->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection