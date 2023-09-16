@extends('fontend.master')
@section('content')
<!-- blog-slider-->
<section class="blog blog-home4 d-flex align-items-center justify-content-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-carousel">
                    <!--post1-->
                    @foreach ($post_slider as $slider)
                    <div class="blog-item" style="background-image: url({{ asset('uploads/post')}}/{{ $slider->feat_image }})">
                        <div class="blog-banner">
                            <div class="post-overly">
                                <div class="post-overly-content">
                                    <div class="entry-cat">
                                        <a href="blog-layout-1.html" class="category-style-2">{{ $slider->rel_to_category->category_name }}</a>
                                    </div>
                                    <h2 class="entry-title">
                                        <a href="{{ route('details.post', $slider->slug) }}">{{ $slider->title }}</a>
                                    </h2>
                                    <ul class="entry-meta">
                                        <li class="post-author"> <a href="{{ route('author.post', $slider->author_id)}}">{{ $slider->rel_to_user->name}}</a></li>
                                        <li class="post-date"> <span class="line"></span> {{ $slider->created_at->format("M-d-Y")}}</li>
                                        <li class="post-timeread"> <span class="line"></span>{{ $slider->created_at->diffForHumans() }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>            
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- top categories-->
<div class="categories">
    <div class="container-fluid">
        <div class="categories-area">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="categories-items">
                        @foreach ($categories as $category)                          
                            <a class="category-item" href="{{ route('category.post', $category->id)}}">
                                <div class="image">
                                    <img src="{{ asset('uploads/category')}}/{{ $category->category_image}}" alt="">
                                </div>
                                <p>{{ $category->category_name}} <span>{{ App\Models\Post::where('category_id', $category->id)->count() }}</span> </p>
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent articles-->
<section class="section-feature-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 oredoo-content">
                <div class="theiaStickySidebar">
                    <div class="section-title">
                        <h3>recent Articles </h3>
                        <p>Discover the most outstanding articles in all topics of life.</p>
                    </div>
                    @foreach ($recent_posts as $recent_post)
                    <!--post1-->
                    <div class="post-list post-list-style4">
                        <div class="post-list-image">
                            <a href="post-single.html">
                                <img src="{{ asset('uploads/post')}}/{{ $recent_post->feat_image}}" alt="">
                            </a>
                        </div>
                        <div class="post-list-content">
                            <ul class="entry-meta">
                                <li class="entry-cat">
                                    <a href="{{ route('category.post', $recent_post->category_id)}}" class="category-style-1">{{ $recent_post->rel_to_category->category_name}}</a>
                                </li>
                                <li class="post-date"> <span class="line"></span>{{ $recent_post->created_at->format('M-y-D') }}</li>
                            </ul>
                            <h5 class="entry-title">
                                <a href="post-single.html">{{ $recent_post->title}}</a>
                            </h5>

                            <div class="post-btn">
                                <a href="post-single.html" class="btn-read-more">Continue Reading <i
                                        class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>                      
                    @endforeach
                    <!--pagination-->
                    {{ $recent_posts->links('vendor.pagination.custompaginate')}}
                </div>
            </div>

            <!--Sidebar-->
            <div class="col-lg-4 oredoo-sidebar">
                <div class="theiaStickySidebar">
                    <div class="sidebar">
                        <!--search-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>Search</h5>
                            </div>
                            <div class=" widget-search">
                                <form action="https://oredoo.assiagroupe.net/Oredoo/search.html">
                                    <input type="search" id="gsearch" name="gsearch" placeholder="Search ....">
                                    <a href="search.html" class="btn-submit"><i class="las la-search"></i></a>
                                </form>
                            </div>
                        </div>

                        <!--popular-posts-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>popular Posts</h5>
                            </div>

                            <ul class="widget-popular-posts">
                                <!--post1-->
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="post-single.html">
                                            <img src="assets/img/blog/1.jpg" alt="">
                                            <small class="nb">1</small>
                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="post-single.html">Everything is designed. Few things are
                                                designed well.</a>
                                        </p>
                                        <small> <span class="slash"></span>3 mounth ago</small>
                                    </div>
                                </li>

                                <!--post2-->
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="post-single.html">
                                            <img src="assets/img/blog/5.jpg" alt="">
                                            <small class="nb">2</small>
                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="post-single.html">Brand yourself for the career you want, not
                                                the job you </a>
                                        </p>
                                        <small> <span class="slash"></span> 3 mounth ago</small>
                                    </div>
                                </li>

                                <!--post3-->
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="post-single.html">
                                            <img src="assets/img/blog/13.jpg" alt="">
                                            <small class="nb">3</small>

                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="post-single.html">It’s easier to ask forgiveness than it is to
                                                get permission.</a>
                                        </p>
                                        <small> <span class="slash"></span>3 mounth ago</small>
                                    </div>
                                </li>

                                <!--post4-->
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="post-single.html">
                                            <img src="assets/img/blog/16.jpg" alt="">
                                            <small class="nb">4</small>
                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="post-single.html">All happiness depends on a leisurely
                                                breakfast</a>
                                        </p>
                                        <small> <span class="slash"></span>
                                            3 mounth ago</small>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!--newslatter-->
                        <div class="widget widget-newsletter">
                            <h5>Subscribe To Our Newsletter</h5>
                            <p>No spam, notifications only about new products, updates.</p>
                            <form action="{{ route('email')}}" method="POST" class="newslettre-form">
                                @csrf
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Your Email Adress"
                                            required="required">
                                    </div>
                                    <button class="btn-custom" type="submit">Subscribe now</button>
                                </div>
                            </form>
                        </div>

                        <!--stay connected-->
                        <div class="widget ">
                            <div class="widget-title">
                                <h5>Stay connected</h5>
                            </div>

                            <div class="widget-stay-connected">
                                <div class="list">
                                    <div class="item color-facebook">
                                        <a href="#"><i class="fab fa-facebook"></i></a>
                                        <p>Facebook</p>
                                    </div>

                                    <div class="item color-instagram">
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <p>instagram</p>
                                    </div>

                                    <div class="item color-twitter">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <p>twitter</p>
                                    </div>

                                    <div class="item color-youtube">
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                        <p>Youtube</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--Tags-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>Tags</h5>
                            </div>
                            <div class="widget-tags">
                                <ul class="list-inline">
                                    @foreach ($tags as $tag)   
                                        <li>
                                            <a href="#">{{ $tag->tag_name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/-->
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