@extends('frontend.layouts.fullwidth')

@section('content')



@include('frontend.coussau.home.banner');

@if(session('cart_success'))
        <div class="alert alert-success">
          {{ __('messages.'.session('cart_success')) }}
        </div> 
    @endif

    {!!$home_part_1->content!!} 
    
     
   <!-- <div class="section section-padding">
        <div class="container">
        

           
            <div class="section-title text-center">
                <h3 class="sub-title">{{ __('messages.Just for you') }}</h3>
                <h2 class="title title-icon-both">{{ __('messages.Top rated products') }}</h2>
            </div>
           
            <div class="row learts-mb-n40">
           
        @if( $top_products->count() > 0)
        @foreach($top_products as $row)
              <div class="col-lg-6 col-md-6 col-12 learts-mb-40">
                    <div class="sale-banner2">
                        <div class="inner">
                            <div class="image"><img src="{{ $row->getFeaturedImage() }}" alt="" style="width: 569px; height: 370px;"></div>
                            <div class="content row justify-content-between mb-n3">
                                <div class="col-auto mb-3">
                                    
                                    <span class="text">{{ $row->name }}</span>
                                </div>
                                <div class="col-auto mb-3">
                                    <a class="btn btn-hover-dark" href="{{ route('product_detail', $row->id) }}">{{ __('messages.SHOP NOW') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        @endif
            </div>
        </div>
    </div>
     Sale Banner Section End -->

    <!-- Category Banner Section Start 
    <div class="section section-fluid section-padding pt-0">
        <div class="container">
           
             <div class="section-title text-center">
                
                <h2 class="title title-icon-both">{{ __('messages.Our Category') }}</h2>
            </div>
           
            <div class="category-banner1-carousel">
            @if( $categories->count() > 0)
        @foreach($categories as $row)
        <?php 
                                $products_count = DB::select('SELECT * FROM products WHERE category_id =' . $row->id);
                               
                                ?>
                <div class="col">
                    <div class="category-banner1">
                        <div class="inner">
                            <a href="{{ route('category_detail', $row->id) }}" class="image"><img src="{{ $row->getCategoryImage() }} " alt="" style="width: 525px; height: 280px;"></a>
                            <div class="content">
                                <h3 class="title">
                                    <a href="{{ route('category_detail', $row->id) }}">{{$row->name}}</a>
                                    <span class="number">{{count($products_count)}}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        @endif
               

            </div>
        </div>
    </div>
     -->

    <!-- Product Section Start 
    <div class="section section-fluid section-padding pt-0">
        <div class="container">

           
            <div class="section-title text-center">
                <h3 class="sub-title">Shop now{{ __('messages.SHOP NOW') }}</h3>
                <h2 class="title title-icon-both">{{ __('messages.Shop our best products') }}</h2>
            </div>
           
            <div class="products row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
            @if( $products->count() > 0)
        @foreach($products as $row)
                <div class="col">
                    <div class="product">
                        <div class="product-thumb">
                            <a href="{{ route('product_detail', $row->id) }}" class="image">
                               
                                
                                @if($row->getFeaturedImage() )<img src=" {{ $row->getFeaturedImage() }} " alt="Product Image" style="width: 328px; height: 437px;"> @endif
                                @if($row->getFeaturedImage() )<img class="image-hover " src=" {{ $row->getFeaturedImage() }} " alt="Product Image" style="width: 328px; height: 437px;"> @endif
                            </a>
                            
                        </div>
                        <div class="product-info">
                            <h6 class="title"><a href="{{ route('product_detail', $row->id) }}">{{$row->name}}</a></h6>
                            <span class="price">
                               
                            <span class="new">{{DEFAULT_CURRENCY}} {{$row->price}}</span>
                            </span>
                            <div class="product-buttons">
                                
                                <a href="{{ route('add.to.cart', $row->id) }}" class="product-button hintT-top" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        @endif

                
         

        </div>
    </div>
    Product Section End -->


@endsection