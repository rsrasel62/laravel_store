@extends('fontend.master')
@section('content')
    <!--Login-->
<!--Login-->
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Sign up</h4>
                    @if (session('maill'))
                    <div class="alert alert-success">
                      {{ session('maill')}}    
                  </div> 
                  @endif
                    <!--form-->              
                    <form action="{{ route('guest.store')}}" class="sign-form widget-form " method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username*" name="name" value="">
                            @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Address*" name="email" value="">
                            @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        </div>


                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password*" name="password" value="">
                            @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn-custom">Sign Up</button>
                        </div>
                        <p class="form-group text-center">Already have an account? <a href="{{ route('guest.login.me')}}" class="btn-link">Login</a> </p>
                    </form>
                       <!--/-->
                </div> 
            </div>
         </div>
    </div>
</section>       
 

@endsection