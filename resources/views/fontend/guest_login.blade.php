@extends('fontend.master')
@section('content')
<!--Login-->
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Login</h4>
                    @if (session('success'))
                    <div class="alert alert-success">
                      {{ session('success')}}    
                  </div> 
                  @endif

                  @if (session('verified'))
                  <div class="alert alert-success">
                    {{ session('verified')}}
                  </div>
                  @endif

                    <form  action="{{ route('guest.login.req')}}" class="sign-form widget-form " method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="email*" name="email" value="">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password*" name="password" value="">
                        </div>
                        <div class="sign-controls form-group">
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                                <label class="custom-control-label" for="rememberMe">Remember Me</label>
                            </div>
                            <a href="{{ route('guest.pass.reset')}}" class="btn-link ">Forgot Password?</a>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Login in</button>
                        </div>
                        <div>
                            <a href="{{ route('github.redirect')}}" class="btn btn-light w-100 my-3">login with <img width="30" src="https://i.postimg.cc/DyyST3cd/001-github.png" alt=""></a>
                        </div>
                        <div>
                            <a href="{{ route('google.redirect')}}" class="btn btn-light w-100">login with <img width="30" src="https://i.postimg.cc/J46G7Y6w/002-google.png" alt=""></a>
                        </div>
                        <p class="form-group text-center">Don't have an account? <a href="{{ route('guest.reg.me')}}" class="btn-link">Create One</a> </p>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</section>       


@endsection
@section('footer_script')
@if (session('login_success'))
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: '{{ session('login_success') }}'
        })
    </script>
@endif
@endsection