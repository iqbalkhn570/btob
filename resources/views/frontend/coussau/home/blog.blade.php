<!--<div class="knowledgecenter">
            <div class="container">
                <h2>Knowledge Center</h2>
                           <p> All the latest breaking news on coussaus. Browse the complete collection of articles on Monrtages.</p>
                <div class="row d-flex">
                    @foreach($blogs as $blog)
                    <div class="col span_4">
                      
                        <div class="content">
                        @if($blog->getFeaturedImage()) <img src="{{  $blog->getFeaturedImage() }}" alt="{{ ucwords($blog->name) }}">
                        @else <img src="{{ asset('frontend/images/Mortage-Loan.jpg') }}" alt=""> @endif
                           <div class="texts">
                           @if($blog->categories()->count() )
                           <ul class="tags">

                                @foreach($blog->categories as $category)
                                    <li><a href="{{ route('blogs_category', $category->slug) }}">{{ucwords($category->name)}}</a></li>
                                @endforeach
                           </ul>
                           @endif
                            <h3>{{  \Str::limit($blog->name , 60, '...')}}</h3>
                            <p>{{ \Str::limit(strip_tags($blog->content), 100, '...')}}</p>
                               
                               <div class="dateAuthour">
                                  <span class="date">{{date('M d, Y', strtotime($blog->publish_date))}}</span>     @if($blog->author()->count()) <span>by: <span class="author">{{$blog->author->name}} </span>@endif </span>
                               </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    
                     <div class="col span_4">
                         @foreach($blogsv as $blog)
                        <div class="content">
                           
                           <div class="texts">
                            @if($blog->categories()->count() )
                            <ul class="tags">

                            @foreach($blog->categories as $category)
                                <li><a href="{{ route('blogs_category', $category->slug) }}">{{ucwords($category->name)}}</a></li>
                            @endforeach
                            </ul>
                            @endif
                            <h3>{{  \Str::limit($blog->name , 60, '...')}}</h3>
                            <p>{{ \Str::limit(strip_tags($blog->content), 100, '...')}}</p>
                               
                               <div class="dateAuthour">
                                  <span class="date">{{date('M d, Y', strtotime($blog->publish_date))}}</span>        @if($blog->author()->count()) <span>by: <span class="author">{{$blog->author->name}} </span>@endif </span>
                               </div>
                            </div>
                        </div>
                        @endforeach
                        
                        
                    </div>
                  
                </div>
                
                <p><a href="{{ route('blogs') }}" class="btn viewall">View All Article</a></p>
            </div>
        </div>-->