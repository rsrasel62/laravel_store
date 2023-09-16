@extends('layouts.dashboard')
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>
</nav>
    <div class="row">


        <div class="col-lg-6">            
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success')}}</div>
                    @endif
                    <h6 class="card-title">Basic Form</h6>
                    <form class="forms-sample" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" name="name" value="{{ Auth::user()->name}}" class="form-control" id="exampleInputUsername1" autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Old Password</label>
                            <input type="password" name="old_password" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Password">
                            @if (session('error'))
                                <strong class="text-danger">{{ session('error') }}</strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
              </div>
        </div>
        <div class="col-lg-6">            
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success')}}</div>
                @endif
                    <form action="{{ route('photo.update')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                    <div class="form-group" >
                        <label>File upload</label>
                        <input type="file" name="photo" class="file-upload-default">

                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
  
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
      
                        </div>
                        @error('photo')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
              </div>
        </div>
                    

    </div>

@endsection