@extends('fontend.master')
@section('content')
<!--contact-->
<section class="contact">
<!--section-heading-->
<div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>Guest Profile</h1>
                         <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> pages</p>
                     </div>
                 </div>  
             </div>
         </div>
     </div>
</div>

<!--contact-->
<section class="contact">
    <div class="container-fluid">
        <div class="contact-area">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-image">
                        <img src="{{ asset('fontend/img/other/contact.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <!--form-->
                    <h6 class="card-title">Guest Profile</h6>
                    <form class="forms-sample" action="{{ route('guest.profile.update')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" name="name" value="{{ Auth::guard('guestlogin')->user()->name}}" class="form-control" id="exampleInputUsername1" autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" value="{{ Auth::guard('guestlogin')->user()->email }}" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Old Password</label>
                            <input type="password" name="old_password" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Password">
                            @if (session('wrong'))
                                <strong class="text-danger">{{ session('wrong') }}</strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</section>        


</section>        

@endsection
@section('footer_script')
@if(session('success'))
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
title: '{{ session('success')}}'
})
</script>
@endif

@endsection
