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
