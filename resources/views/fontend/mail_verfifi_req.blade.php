@extends('fontend.master')
@section('content')
<!--Login-->
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Mial verify Request</h4>
                    @if (session('resend'))
                      <div class="alert alert-success">
                        {{ session('resend')}}    
                    </div>  
                    @endif
                    @if (session('resendmail'))
                      <div class="alert alert-success">
                        {{ session('resendmail')}}    
                    </div>  
                    @endif
                    <form  action="{{ route('mail.verifi.again') }}" class="sign-form widget-form " method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="email" name="email" value="{{ session('mail')}}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">verifY request send Again</button>
                        </div>

                    </form>
                </div> 
            </div>
        </div>
    </div>
</section>       


@endsection
