@extends('layouts.dashboard')
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
                    <h2>View Post</h2>
                </div>
                <div class="card-body">
                    <h3>{{ $post->title }}</h3>
                    <div class="my-5">
                        <img width="500" src="{{ asset('uploads/post')}}/{{ $post->feat_image}}" alt="">
                    </div>
                    <p>{!! $post->desp !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection