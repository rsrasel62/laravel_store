@extends('fontend.master')
@section('content')
    <!--Login-->
<!--Login-->
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Reset password</h4>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!--form-->              
                    <form action="{{ route('guest.pass.reset.confirm')}}" class="sign-form widget-form " method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="new Password*" name="password">
                        </div>
                        <input type="hidden" class="form-control" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="confirm Password*" name="password_confirmation">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn-custom">Reset password</button>
                        </div>
                    </form>
                       <!--/-->
                </div> 
            </div>
         </div>
    </div>
</section>       
 

@endsection