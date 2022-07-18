@extends('frontend.layouts.fullwidth')


@section('meta_title')
@if($selectedCategory){{ ucwords($selectedCategory->name) }}@else Blogs @endif
@stop
@section('meta_description')

@stop
@section('meta_keywords')

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

    <!-- Blog Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row learts-mb-n50">

                <div class="col-xl-9 col-lg-8 col-12 order-lg-2 learts-mb-50">
                    <div class="row learts-mb-n40 blogresults">
                    @if($blogs->total() > 0)
            @foreach($blogs as $blog)
                        <div class="col-md-6 col-12 learts-mb-40">
                            <div class="blog">
                                <div class="image">
                                    <a href="{{ route('blog_detail', $blog->slug) }}">
                                    @if($blog->getFeaturedImage()) <img src="{{  $blog->getFeaturedImage() }}" alt="{{ ucwords($blog->name) }}">
                        @else <img src="{{ asset('public/frontend/images/1631782804-logo.png') }}" alt=""> @endif  
                                    </a>
                                </div>
                                <div class="content">
                                    <ul class="meta">
                                        <li><i class="far fa-calendar"></i><a href="#">{{date('M d, Y', strtotime($blog->publish_date))}}</a></li>
                                        <li> @if($blog->activeCategories()->count() )
                        <ul class="meta">
                            @foreach($blog->activeCategories as $category)
                            <li><a
                                    href="{{ route('blogs_category', $category->slug) }}">{{ucwords($category->name)}}</a>
                            </li>
                            @endforeach

                        </ul>
                        @endif</li>
                                    </ul>
                                    
                                    <h5 class="title"><a href="{{ route('blog_detail', $blog->slug) }}">{{ ucwords($blog->name) }}</a></h5>
                                    <div class="desc">
                                        <p>{{ \Str::limit(strip_tags($blog->content), 200, '...')}}</p>
                                    </div>
                                    <a href="{{ route('blog_detail', $blog->slug) }}" class="link">Read More</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif

                        

                       

                    </div>
                  
                    <div class="row learts-mt-50">
                    @if($blogs->lastPage() > 1)
                        <div class="col text-center loadingButn">
                            <a href="#" class="loadMore btn btn-dark btn-outline-hover-dark">Load More</a>
                            
                        </div>
                        @endif
                    </div>
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
    <!-- Blog Section End -->



@endsection

    @section('script')
    @parent
    <script>
  
        $(document).ready(function(){
            var currentPage = 1;
            var totalPages = {{ $blogs->lastPage() }} ;
            var resultDiv = $(".blogresults") ;
            $(".loadMore").on('click', function(){
               
                if(currentPage < totalPages){
                    currentPage ++;
                    load_more(currentPage);
                }
                if(currentPage >= totalPages){
                    $(".loadMore").addClass('disabled');
                }
            });
            function load_more(page){
                $.ajax({
                    url: "?page=" + page,
                    type: "get",
                    datatype: "html"
            
                })
                .done(function(data)
                {          
                    if(data.length == 0){
                    
                         return;
                    }
                   
                    resultDiv.append(data);
                    
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('No response from server');
                });
            }
        });
    </script>
    @stop