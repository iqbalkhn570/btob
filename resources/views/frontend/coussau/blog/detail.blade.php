@extends('frontend.layouts.fullwidth')


@section('meta_title')
@if($blog->meta_title){{$blog->meta_title}}@elseif($blog->name){{ ucwords($blog->name)}}@endif
@stop
@section('meta_description')
@if($blog->meta_description){{$blog->meta_description}}@elseif($blog->content){{ \Str::limit(strip_tags($blog->content), 60)}}@endif
@stop
@section('meta_keywords')
@if($blog->meta_keyword){{$blog->meta_keyword}}@endif
@stop

@section('style')
@parent
<style>

</style>  
@stop



@section('content')
       <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="{{ asset('public/frontend/images/bg/page-title-1.webp') }}">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">Blog</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Blog</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- Single Blog Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row learts-mb-n50">

                <div class="col-xl-9 col-lg-8 col-12 order-lg-2 learts-mb-50">
                    <div class="single-blog">
                        <div class="image">
                            <a href="#">@if($blog->getFeaturedImage())  
                    <img src="{{  $blog->getFeaturedImage() }}" alt="{{ucwords($blog->name)}}"> 
                @else
                    <img src="{{ asset('public/frontend/images/1631782804-logo.png') }}" alt="">
                 @endif</a>
                        </div>
                        <div class="content">
                        @if($blog->categories()->count() )
                            <ul class="category">
                            @foreach($blog->categories as $category)
                                <li><a href="{{ route('blogs_category', $category->slug) }}">{{ucwords($category->name)}}</a></li>
                                @endforeach
                               
                            </ul>
                            @endif
                            <h2 class="title">{{ucwords($blog->name)}}</h2>
                            <ul class="meta">
                            @if($blog->author()->count()) <li><i class="fal fa-user"></i> By <a href="#">{{ucwords($blog->author->name)}}</a></li>@endif
                                <li><i class="far fa-calendar"></i><a href="#">{{date('M d, Y', strtotime($blog->publish_date))}}</a></li>
                                <!--<li><i class="fal fa-comment"></i><a href="#">4 Comments</a></li>
                                <li><i class="far fa-eye"></i> 201 views</li>-->
                            </ul>
                            <div class="desc">
                            {!! $blog->content !!}
                                 </div>
                        </div>
                        <!--<div class="blog-footer row g-0 justify-content-between align-items-center">
                            <div class="col-auto">
                                <ul class="tags">
                                    <li class="icon"><i class="fas fa-tags"></i></li>
                                    <li><a href="#">design</a></li>
                                    <li><a href="#">fashion</a></li>
                                    <li><a href="#">learts</a></li>
                                </ul>
                            </div>
                            <div class="col-auto">
                                <div class="post-share">
                                    Share this post
                                    <span class="toggle"><i class="fas fa-share-alt"></i></span>
                                    <ul class="social-list">
                                        <li class="hintT-top" data-hint="Facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="hintT-top" data-hint="Twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li class="hintT-top" data-hint="Pinterest"><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                        <li class="hintT-top" data-hint="Google Plus"><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                        <li class="hintT-top" data-hint="Email"><a href="#"><i class="fal fa-envelope-open"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>-->
                    </div>
                    <!--<div class="blog-author">
                        <div class="thumbnail">
                            <img src="assets/images/comment/comment-1.webp" alt="">
                            <div class="social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="content">
                            <a href="#" class="name">Owen Christ</a>
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laboruLorem ipsum dolor sit amet datat non proident</p>
                        </div>
                    </div>-->
                   <!-- <div class="related-blog">
                        <div class="block-title pb-0 border-bottom-0">
                            <h2 class="title">Related Blog</h2>
                        </div>
                        <div class="row learts-mb-n40">
                            <div class="col-md-6 col-12 learts-mb-40">
                                <div class="blog">
                                    <div class="image">
                                        <a href="blog-details-right-sidebar.html"><img src="assets/images/blog/s370/blog-2.webp" alt="Blog Image"></a>
                                    </div>
                                    <div class="content">
                                        <ul class="meta">
                                            <li><i class="far fa-calendar"></i><a href="#">January 22, 2020</a></li>
                                            <li><i class="far fa-eye"></i> 158 views</li>
                                        </ul>
                                        <h5 class="title mb-0"><a href="blog-details-right-sidebar.html">Tile Tray with Brass Handles</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 learts-mb-40">
                                <div class="blog">
                                    <div class="image">
                                        <a href="blog-details-right-sidebar.html"><img src="assets/images/blog/s370/blog-3.webp" alt="Blog Image"></a>
                                    </div>
                                    <div class="content">
                                        <ul class="meta">
                                            <li><i class="far fa-calendar"></i><a href="#">January 22, 2020</a></li>
                                            <li><i class="far fa-eye"></i> 119 views</li>
                                        </ul>
                                        <h5 class="title mb-0"><a href="blog-details-right-sidebar.html">Dining Table Chairs Makeover</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Comments-wrapper">
                        <div class="block-title pb-0 border-bottom-0">
                            <h2 class="title">Comments <span class="text-muted">(4)</span></h2>
                        </div>
                        <ul class="comment-list">
                            <li>
                                <div class="comment">
                                    <div class="thumbnail">
                                        <img src="assets/images/comment/comment-2.webp" alt="">
                                    </div>
                                    <div class="content">
                                        <h4 class="name">Scott James</h4>
                                        <p>Thanks for always keeping your WordPress themes up to date. Your level of support and dedication is second to none.</p>
                                        <div class="actions">
                                            <span class="date">April 22, 2020 at 2:10 am</span>
                                            <a class="reply-link" href="#">Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="child-comment">
                                    <li>
                                        <div class="comment">
                                            <div class="thumbnail">
                                                <img src="assets/images/comment/comment-3.webp" alt="">
                                            </div>
                                            <div class="content">
                                                <h4 class="name">Edna Watson</h4>
                                                <p>Thanks for always keeping your WordPress themes up to date. Your level of support and dedication is second to none.</p>
                                                <div class="actions">
                                                    <span class="date">April 22, 2020 at 2:10 am</span>
                                                    <a class="reply-link" href="#">Reply</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div class="comment">
                                    <div class="thumbnail">
                                        <img src="assets/images/comment/comment-4.webp" alt="">
                                    </div>
                                    <div class="content">
                                        <h4 class="name">Gerhard</h4>
                                        <p>Thanks for always keeping your WordPress themes up to date. Your level of support and dedication is second to none.</p>
                                        <div class="actions">
                                            <span class="date">April 22, 2020 at 2:10 am</span>
                                            <a class="reply-link" href="#">Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="comment">
                                    <div class="thumbnail">
                                        <img src="assets/images/comment/comment-1.webp" alt="">
                                    </div>
                                    <div class="content">
                                        <h4 class="name">Owen Christ</h4>
                                        <p>Thank you very much!</p>
                                        <div class="actions">
                                            <span class="date">April 22, 2020 at 2:10 am</span>
                                            <a class="reply-link" href="#">Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="block-title pb-0 border-bottom-0">
                            <h2 class="title">Leave your thought here</h2>
                        </div>
                        <div class="comment-form">
                            <form action="#">
                                <div class="row learts-mb-n20">
                                    <div class="col-md-6 col-12 learts-mb-20">
                                        <input type="text" placeholder="Your name (*)">
                                    </div>
                                    <div class="col-md-6 col-12 learts-mb-20">
                                        <input type="text" placeholder="Mail (*)">
                                    </div>
                                    <div class="col-12 learts-mb-20">
                                        <textarea placeholder="Message"></textarea>
                                    </div>
                                    <div class="col-12 text-center learts-mb-20 learts-mt-20">
                                        <button class="btn btn-dark btn-outline-hover-dark">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>-->
                </div>

                <div class="col-xl-3 col-lg-4 col-12 order-lg-1 learts-mb-10">
                    <!-- Search Start 
                    <div class="single-widget learts-mb-40">
                        <div class="widget-search">
                            <form action="#">
                                <input type="text" placeholder="Search products....">
                                <button><i class="fal fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    Search End -->

                    <!-- Blog Post Widget Start -->
                    @if($topratedBlogs->count() == 3)
                    <div class="single-widget learts-mb-40">
                        <h3 class="widget-title product-filter-widget-title">Recent Post</h3>
                        <ul class="widget-blogs">
                        @foreach($topratedBlogs as $blog)
                            <li class="widget-blog">
                                <div class="thumbnail">
                                    <a href="{{ route('blog_detail', $blog->slug) }}">@if($blog->getFeaturedImage()) <img src="{{  $blog->getFeaturedImage() }}" alt="{{ ucwords($blog->name) }}">
                        @else <img src="{{ asset('public/frontend/images/1631782804-logo.png') }}" alt=""> @endif  </a>
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="{{ route('blog_detail', $blog->slug) }}">{{ucwords($blog->name)}}</a></h6>
                                    <span class="date">{{date('M d, Y', strtotime($blog->publish_date))}}</span>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    <!-- Blog Post Widget End -->

                    <!-- Categories Start 
                    <div class="single-widget learts-mb-40">
                        <div class="widget-banner">
                            <img src="{{ asset('public/frontend/images/banner/widget-banner.webp') }}" alt="">
                        </div>
                    </div>
                    Categories End -->

                    <!-- Categories Start -->
                    <div class="single-widget learts-mb-40">
                        <h3 class="widget-title product-filter-widget-title">Categories</h3>
                        @if($categories->count() > 0)
                        <ul class="widget-list">
                        @foreach($categories as $category)
                            <li><a href="{{  route('blogs_category', $category->slug) }}">{{ucwords($category->name)}}</a>
                             <!--<span class="count">4</span>-->
                            </li>
                            @endforeach
                           
                        </ul>
                        @endif
                    </div>
                    <!-- Categories End -->

                    <!-- Tags Start 
                    <div class="single-widget learts-mb-40">
                        <h3 class="widget-title product-filter-widget-title">Product Tags</h3>
                        <div class="widget-tags">
                            <a href="#">design</a>
                            <a href="#">fashion</a>
                            <a href="#">learts</a>
                        </div>
                    </div>
                   Tags End -->
                </div>

            </div>
        </div>

    </div>
    <!-- Single Blog Section End -->
 
        

@endsection