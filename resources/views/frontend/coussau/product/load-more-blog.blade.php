@if($blogs->count() > 0)
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