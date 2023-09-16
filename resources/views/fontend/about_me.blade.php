@extends('fontend.master')

@section('content')

     <!--section-heading-->
     <div class="section-heading " >
        <div class="container-fluid">
             <div class="section-heading-2">
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="section-heading-2-title">
                             <h1>About us</h1>
                             <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> pages</p>
                         </div>
                     </div>  
                 </div>
             </div>
         </div>
    </div>

    <!--about-us-->
    <section class="about-us">
        <div class="container-fluid">
            <div class="about-us-area">
                <div class="row ">
                    <div class="col-lg-12 ">

                            
     
                        <div class="image">
                            <img src="{{ asset('uploads/about')}}/{{ $abouts->image}}" alt="">
                        </div>
                   
                        <div class="description">
                            <h3 >{{$abouts->title}}</h3>
                            <p>
                                {!! $abouts->desp !!}
                            </p>

                            <a href="{{ route('contact')}}" class="btn-custom">Contact us</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section> 
   
@endsection