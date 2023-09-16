@extends('fontend.master')
@section('content')
    <!--section-heading-->
    <div class="section-heading " >
        <div class="container-fluid">
            <div class="section-heading-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading-2-title ">
                            <h1>All Authors</h1>
                            <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> pages</p>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    <!--blog-layout-1-->
    <div class="authors ">
        <div class="container-fluid">
            <div class="authors-area">
                <div class="row">
                    <!--author-1-->
                    @foreach ($author_lists as $author_list)
                        <div class="col-md-6 ">
                            <div class="authors-single">
                                <div class="authors-single-image">
                                    <a href="author.html">
                                        @if ($author_list->rel_to_user->image == null)
                                        <img src="{{ Avatar::create($author_list->rel_to_user->name)->toBase64() }}" />
                                        @endif
                                        <img src="{{ asset('uploads/user')}}/{{ $author_list->rel_to_user->image}}" alt="">
                                    </a>
                                </div>
                                <div class="authors-single-content ">
                                    <div class="left">
                                        <h6> <a href="author.html">{{ $author_list->rel_to_user->name}}</a></h6>
                                        <p >{{ App\Models\Post::where('author_id', $author_list->author_id)->count(); }} Articles</p>
                                    </div>
                                    <div class="right">
                                        <div class="more-icon">
                                            <i class="las la-angle-double-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                      
                    @endforeach

                    <!--/--> 
                </div>
            </div>
        </div> 
    </div>


    <!--pagination-->
    <div class="pagination">
        <div class="container-fluid">
            <div class="pagination-area">
                <div class="row"> 
                    <div class="col-lg-12">
                        <div class="pagination-list">
                            <ul class="list-inline">
                                <li><a href="#" ><i class="las la-arrow-left"></i></a></li>
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#" ><i class="las la-arrow-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

 
    <!--footer-->
    <div class="footer">
        <div class="footer-area">
            <div class="footer-area-content">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-md-3">
                            <div class="menu">
                                <h6>Menu</h6>
                                <ul>
                                    <li><a href="#">Homepage</a></li>
                                    <li><a href="#">about us</a></li>
                                    <li><a href="#">contact us</a></li>
                                    <li><a href="#">privarcy</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--newslatter-->
                        <div class="col-md-6">
                            <div class="newslettre">
                                <div class="newslettre-info">
                                    <h3>Subscribe To Our Newsletter</h3>
                                    <p>Sign up for free and be the first to get notified about new posts.</p>      
                                </div>
                            
                                <form action="#" class="newslettre-form">
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Your Email Adress" required="required">
                                        </div>
                                        <button class="submit-btn" type="submit">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--/-->
                        <div class="col-md-3">
                            <div class="menu">
                                <h6>Follow us</h6>
                                <ul>
                                    <li><a href="#">facebook</a></li>
                                    <li><a href="#">instagram</a></li>
                                    <li><a href="#">youtube</a></li>
                                    <li><a href="#">twitter</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
@endsection