@extends('frontend.layouts.twocolumnleft')


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
    .loadingButn {
    margin: 20px 0;
    text-align: center;
}
.centrText {
    max-width: 900px;
    margin: 20px auto;
}

.centrText h2 {
    margin-bottom: 20px;
}

h2.page-title:after {
    display: block;
    width: 92px;
    height: 3px;
    background: var(--green);
    content: "";
    margin: 10px auto 0;
}

.centrText * {
    text-align: center;
}

.row.blogs {
    display: flex;
    flex-wrap: wrap;
}

.row.blogs .content {
    border: 1px solid #ADADAD;
    min-height: 100%;
}

.row.blogs .content .details {
    padding: 10px 20px;
}

.row.blogs .content .image {
    height: calc((226/364) * 20vw);
    display: flex;
    justify-content: center;
}

.row.blogs .content .image img {
    object-position: center center;
    object-fit: cover;
}

.row.blogs .content .details h3 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

ul.tags {
    margin-bottom: 10px;
}

.actions {
    position: absolute;
    padding-top: 20px;
    margin-top: 20px;
    border-top: 1px solid #ccc;
    width: calc(100% - 40px);
    left: 20px;
    padding-bottom: 20px;
    bottom: 0;
}

.row.blogs .content .details {
    padding-bottom: 80px;
}

.row.blogs .content {
    position: relative;
}

.actions a {
    color: var(--blue);
    font-size: var(--headdingH4);
}

.row.blogs .content .details h3 {
    margin-bottom: 15px;
}

.single-top-topic-imgb {
    margin-bottom: 15px;
}

.knowledge-center-listing .knowledge-center-listing-single a.read-article-btn:hover {
    color: var(--dark-grey);
}

.knowledge-center-navigation {
    border: 1px solid #ADADAD;
    padding: 15px 25px;
    margin-right: 30px;
}

.knowledge-center-navigation h3 {
    font-size: var(--headdingH2);
    color: var(--blue);
    margin-bottom: 15px;
    position: relative;
    line-height: 1.4;
}

.knowledge-center-navigation h3::after {
    content: '';
    display: block;
    width: 100px;
    height: 2px;
    background: var(--blue);
    margin-top: 10px;
}

.knowledge-center-navigation ul {
    list-style-type: none;
}

.knowledge-center-navigation ul li {
    font-size: var(--headdingH4);
    padding-bottom: 15px;
    display: block;
}

.knowledge-center-navigation ul li a {
    color: var(--dark-grey);
    display: block;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.knowledge-center-navigation ul li a:hover,
.knowledge-center-navigation ul li a.active {
    color: var(--blue);
}

.row.bloging {
    margin-top: 40px;
}

.row.blogs .content .details p {
    font-size: var(--headdingH4);
}
    .topTopics h4 a{
            color: #606060;
    }
    .single-top-topic .single-top-topic-imgb a {
    height: calc((226/364) * 20vw);
    display: flex;
}

.single-top-topic .single-top-topic-imgb a img {object-position: center center;object-fit: cover;}

@media only screen and (max-width: 767px) {
    .knowledge-center-navigation {
        width: 100%;
    }
    .topTopics h4 {
        text-align: center;
    }
}
    @media only screen and (max-width: 567px) {
        .row.blogs .content .image{
            height: auto;
        }
    }
</style>
@stop

@section('content')

@if($topratedBlogs->count() == 3)
    <div class="topTopics">

        <div class="centrText">
            <h2 class="page-title">Top Topics</h2>
        </div>
        <div class="row">
            @foreach($topratedBlogs as $blog)
            <div class="col span_4">
                <div class="single-top-topic">
                    <div class="single-top-topic-imgb">
                        <a href="{{ route('blog_detail', $blog->slug) }}" title="">
                        @if($blog->getFeaturedImage()) <img src="{{  $blog->getFeaturedImage() }}" alt="">
                        @else <img src="{{ asset('frontend/images/Mortage-Loan.jpg') }}" alt=""> @endif
                        </a>
                    </div>
                    @if($blog->activeCategories()->count() )
                        <ul class="tags">
                            @foreach($blog->activeCategories as $category)
                            <li><a
                                    href="{{ route('blogs_category', $category->slug) }}">{{ucwords($category->name)}}</a>
                            </li>
                            @endforeach

                        </ul>
                        @endif
                    
                    <h4><a href="{{ route('blog_detail', $blog->slug) }}" title="{{ route('blog_detail', $blog->slug) }}">{{ ucwords($blog->name) }}</a></h4>
                </div>
            </div>
            @endforeach
           
        </div><!-- .row -->
    </div>
@endif

<div class="centrText">
    <h2 class="page-title">Knowledge Center</h2>
    <p>All the latest breaking news on coussaus. Browse the complete collection of articles on Monrtages.</p>
</div>
<div class="row bloging">
    <div class="col span_4">
        <div class="knowledge-center-navigation">
            @if($categories->count() > 0)
            <ul>
                <li>
                    <h3>Knowledge Center <br> by categories</h3>
                </li>
                @foreach($categories as $category)
                <li> <a href="{{  route('blogs_category', $category->slug) }}">{{ucwords($category->name)}}</a></li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
    <div class="col span_8">
        <div class="row blogs blogresults">

            @if($blogs->total() > 0)
            @foreach($blogs as $blog)
            <div class="col span_6">
                <div class="content">
                    <div class="image">
                        @if($blog->getFeaturedImage()) <img src="{{  $blog->getFeaturedImage() }}" alt="{{ ucwords($blog->name) }}">
                        @else <img src="{{ asset('frontend/images/Mortage-Loan.jpg') }}" alt=""> @endif
                    </div>
                    <div class="details">
                        @if($blog->activeCategories()->count() )
                        <ul class="tags">
                            @foreach($blog->activeCategories as $category)
                            <li><a
                                    href="{{ route('blogs_category', $category->slug) }}">{{ucwords($category->name)}}</a>
                            </li>
                            @endforeach

                        </ul>
                        @endif
                        <h3><a href="{{ route('blog_detail', $blog->slug) }}"  title="{{ ucwords($blog->name) }}">{{ ucwords($blog->name) }}</a></h3>

                        <p>{{ \Str::limit(strip_tags($blog->content), 200, '...')}}</p>
                        <div class="actions">
                            <small> <a href="{{ route('blog_detail', $blog->slug) }}" class="blue" title="{{ ucwords($blog->name) }}">Read
                                    article</a></small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            
            @endif
            
        </div>

        @if($blogs->lastPage() > 1)
           <div class="loadingButn">
            <a href="javascript:void(0);" class="loadMore btn green" >Load More </a>
            </div>
            @endif
    </div>




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