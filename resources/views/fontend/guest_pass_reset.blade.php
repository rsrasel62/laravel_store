@extends('fontend.master')
@section('content')
<!--Login-->
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Password Reset</h4>
                    @if (session('resend'))
                      <div class="alert alert-success">
                        {{ session('resend')}}    
                    </div>  
                    @endif
                    <form  action="{{ route('guest.pass.reset.send')}}" class="sign-form widget-form " method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="email" name="email" value="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Password request send</button>
                        </div>

                    </form>
                </div> 
            </div>
        </div>
    </div>
</section>       


@endsection
