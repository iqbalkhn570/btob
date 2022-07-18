@extends('frontend.layouts.fullwidth')


@section('meta_title')
@if($product->meta_title){{$product->meta_title}}@elseif($product->name){{ ucwords($product->name)}}@endif
@stop
@section('meta_description')
@if($product->meta_description){{$product->meta_description}}@elseif($product->content){{ \Str::limit(strip_tags($product->content), 60)}}@endif
@stop
@section('meta_keywords')
@if($product->meta_keyword){{$product->meta_keyword}}@endif
@stop

@section('style')
@parent
<style>

</style>  
@stop



@section('content')
     <!-- Page Title/Header Start 
    <div class="page-title-section section" data-bg-image="{{ asset('public/frontend/images/bg/page-title-1.webp') }}">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">Shop</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('home') }}/produkte">Products</a></li>
                            <li class="breadcrumb-item active">{{$product->name}}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
     Page Title/Header End -->

    <!-- Single Products Section Start -->
   
    <div class="section section-padding border-bottom">
    @if(session('cart_success'))
        <div class="alert alert-success">
          {{ __('messages.'.session('cart_success')) }}
        </div> 
    @endif
        <div class="container">
            <div class="row learts-mb-n40">

                <!-- Product Images Start -->
                <div class="col-lg-6 col-12 learts-mb-40">
                    <div class="product-images">
                        
                       
                        <div class="product-gallery-slider">
                        @if($product->image && $product->getFeaturedImage() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage() }}">
                                <img src="{{ $product->getFeaturedImage() }}" alt="product image">
                            </div>
                            @endif
                            @if($product->image2 && $product->getFeaturedImage2() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage2() }}">
                                <img src="{{ $product->getFeaturedImage2() }}" alt="product image">
                            </div>
                            @endif
                            @if($product->image3 && $product->getFeaturedImage3() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage3() }}">
                                <img src="{{ $product->getFeaturedImage3() }}" alt="product image">
                            </div>
                            @endif
                            @if($product->image4 && $product->getFeaturedImage4() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage4() }}">
                                <img src="{{ $product->getFeaturedImage4() }}" alt="product image">
                            </div>
                            @endif
                            @if($product->image5 && $product->getFeaturedImage5() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage5() }}">
                                <img src="{{ $product->getFeaturedImage5() }}" alt="product image">
                            </div>
                            @endif
                            @if($product->image6 && $product->getFeaturedImage6() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage6() }}">
                                <img src="{{ $product->getFeaturedImage6() }}" alt="product image">
                            </div>
                            @endif
                            @if($product->image7 && $product->getFeaturedImage7() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage7() }}">
                                <img src="{{ $product->getFeaturedImage7() }}" alt="product image">
                            </div>
                            @endif
                            @if($product->image8 && $product->getFeaturedImage8() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage8() }}">
                                <img src="{{ $product->getFeaturedImage8() }}" alt="product image">
                            </div>
                            @endif
                            @if($product->image9 && $product->getFeaturedImage9() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage9() }}">
                                <img src="{{ $product->getFeaturedImage9() }}" alt="product image">
                            </div>
                            @endif
                            @if($product->image10 && $product->getFeaturedImage10() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage10() }}">
                                <img src="{{ $product->getFeaturedImage10() }}" alt="product image">
                            </div>
                            @endif
                            @if($product->image11 && $product->getFeaturedImage11() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage11() }}">
                                <img src="{{ $product->getFeaturedImage11() }}" alt="product image">
                            </div>
                            @endif
                            @if($product->image12 && $product->getFeaturedImage12() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage4() }}">
                                <img src="{{ $product->getFeaturedImage12() }}" alt="product image">
                            </div>
                            @endif
                            @if($product->image13 && $product->getFeaturedImage13() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage13() }}">
                                <img src="{{ $product->getFeaturedImage13() }}" alt="product image">
                            </div>
                            @endif
                            @if($product->image14 && $product->getFeaturedImage14() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage14() }}">
                                <img src="{{ $product->getFeaturedImage14() }}" alt="product image">
                            </div>
                            @endif
                            @if($product->image15 && $product->getFeaturedImage15() )
                            <div class="product-zoom" data-image="{{ $product->getFeaturedImage15() }}">
                                <img src="{{ $product->getFeaturedImage15() }}" alt="product image">
                            </div>
                            @endif


                        </div>
                        <div class="product-thumb-slider">
                        @if($product->image && $product->getFeaturedImage() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage() }}" alt="">
                            </div>
                            @endif
                            @if($product->image2 && $product->getFeaturedImage2() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage2() }}" alt="">
                            </div>
                            @endif
                            @if($product->image3 && $product->getFeaturedImage3() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage3() }}" alt="">
                            </div>
                            @endif
                            @if($product->image4 && $product->getFeaturedImage4() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage4() }}" alt="">
                            </div>
                            @endif
                            @if($product->image5 && $product->getFeaturedImage5() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage5() }}" alt="">
                            </div>
                            @endif
                            @if($product->image6 && $product->getFeaturedImage6() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage6() }}" alt="">
                            </div>
                            @endif
                            @if($product->image7 && $product->getFeaturedImage7() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage7() }}" alt="">
                            </div>
                            @endif
                            @if($product->image8 && $product->getFeaturedImage8() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage8() }}" alt="">
                            </div>
                            @endif
                            @if($product->image9 && $product->getFeaturedImage9() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage9() }}" alt="">
                            </div>
                            @endif
                            @if($product->image10 && $product->getFeaturedImage10() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage10() }}" alt="">
                            </div>
                            @endif
                            @if($product->image11 && $product->getFeaturedImage11() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage11() }}" alt="">
                            </div>
                            @endif
                            @if($product->image12 && $product->getFeaturedImage12() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage12() }}" alt="">
                            </div>
                            @endif
                            @if($product->image13 && $product->getFeaturedImage13() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage13() }}" alt="">
                            </div>
                            @endif
                            @if($product->image14 && $product->getFeaturedImage14() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage14() }}" alt="">
                            </div>
                            @endif
                            @if($product->image15 && $product->getFeaturedImage15() )
                            <div class="item">
                                <img src="{{ $product->getFeaturedImage15() }}" alt="">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Product Images End -->

                <!-- Product Summery Start -->
                <div class="col-lg-6 col-12 learts-mb-40">
                    <div class="product-summery">
                        <h3 class="product-title">{{$product->name}}</h3>
                        <div class="product-price">{{DEFAULT_CURRENCY}} {{$product->price}} </div>
                        <div class="product-description">
                            <p>{!!$product->content!!}</p>
                        </div>
                        <!--<div class="product-variations">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="label"><span>Quantity</span></td>
                                        <td class="value">
                                            <div class="product-quantity">
                                                <span class="qty-btn minus"><i class="ti-minus"></i></span>
                                                <input type="text" class="input-qty" value="1">
                                                <span class="qty-btn plus"><i class="ti-plus"></i></span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>-->
                        <div class="product-buttons">
                        <?php
                        $cartitem = DB::select("SELECT sum(quantity) as qty FROM carts WHERE mail_status='No' and product_id =" . $product->id);
                //$permission_menu = @$roles[0]->permission_menu;
                //print_r($cartitem[0]->qty);
                //echo $product->quantity;

                ?>
                @if($product->sale_status=="verkauft" )
                <a href="#" class="btn btn-dark btn-outline-hover-dark">Verkauft </a>
                           
                          @elseif($product->quantity>$cartitem[0]->qty)
                          <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-dark btn-outline-hover-dark"><i class="fal fa-shopping-cart"></i>{{ __('messages.Add to Cart') }} </a>
                            @else  
                          <a href="#" class="btn btn-dark btn-outline-hover-dark">Reserviert </a>
                    @endif 
                        </div>
                        
                        <div class="product-meta">
                            <table>
                                <tbody>
                                @if(!empty($product->article_number))
                                        <tr>
                                            <td class="label"><span>{{ __('messages.Article Number') }}</span></td>
                                            <td class="value">{{ $product->article_number }}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($product->color_id))
                                        <tr>
                                            <td class="label"><span>{{ __('messages.Color') }}</span></td>
                                            <td class="value">
                                                <ul class="product-tags">
                                                    @php 
                                                    $colors=explode(',',$product->color_id)  ;
                                                    
                                                    @endphp 
                                                    
                                                    @foreach($colors as $color)
                                                    @if($color!="")
                                                    @php  $colorname = DB::select('SELECT * FROM colors WHERE id =' . $color); 
                                                    @endphp 
                                                    @if(!empty($colorname))
                                                    <li>{{$colorname[0]->name}}</li>
                                                    @endif
                                                    @endif
                                                    @endforeach
                                                   
                                                </ul>
                                            </td>
                                            
                                        </tr>
                                        @endif
                                       
                                    <tr>
                                        <td class="label"><span>{{ __('messages.Category') }}</span></td>
                                        <td class="value">
                                            <ul class="product-category">
                                                <li>@if($product->categories()->count()){{ $product->categories->name }}@endif</li>
                                            </ul>
                                        </td>
                                    </tr>
                                   
                                   
                                    <tr>
                                        <td class="label"><span>{{ __('messages.Sub Category') }}</span></td>
                                        <td class="value">
                                            <ul class="product-category">
                                                <li>@if($product->subcategories()->count()){{ $product->subcategories->name }}@endif</li>
                                            </ul>
                                        </td>
                                    </tr>
                                  
                                    @if(!empty($product->length))
                                    <tr>
                                        <td class="label"><span>{{ __('messages.Length') }}</span></td>
                                        <td class="value">
                                            <ul class="product-tags">
                                                <li>{{ $product->length }} cm</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(!empty($product->height))
                                    <tr>
                                        <td class="label"><span>{{ __('messages.Height') }}</span></td>
                                        <td class="value">
                                            <ul class="product-tags">
                                                <li>{{ $product->height }} cm</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(!empty($product->width))
                                    <tr>
                                        <td class="label"><span>{{ __('messages.Width') }}</span></td>
                                        <td class="value">
                                            <ul class="product-tags">
                                                <li>{{ $product->width }} cm</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(!empty($product->diameter))
                                    <tr>
                                        <td class="label"><span>{{ __('messages.Diameter') }}</span></td>
                                        <td class="value">
                                            <ul class="product-tags">
                                                <li>{{ $product->diameter }} cm</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endif
                                    @if($product->periods()->count())
                                    <tr>
                                        <td class="label"><span>{{ __('messages.By Period') }}</span></td>
                                        <td class="value">
                                            <ul class="product-tags">
                                                <li>@if($product->periods()->count()){{ $product->periods->name }}@endif</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(!empty($product->origin))
                                    <tr>
                                        <td class="label"><span>{{ __('messages.Origin') }}</span></td>
                                        <td class="value">
                                            <ul class="product-tags">
                                                <li>{{ $product->origin }}</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endif
                                    @if($product->materials()->count())
                                    <tr>
                                        <td class="label"><span>{{ __('messages.Material') }}</span></td>
                                        <td class="value">
                                            <ul class="product-tags">
                                                <li>@if($product->materials()->count()){{ $product->materials->name }}@endif</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endif
                                    @if($product->manufacturers()->count())
                                    <tr>
                                        <td class="label"><span>{{ __('messages.Manufacturer') }}</span></td>
                                        <td class="value">
                                            <ul class="product-tags">
                                                <li>@if($product->manufacturers()->count()){{ $product->manufacturers->name }}@endif</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(!empty($product->tag))
                                    <tr>
                                            <td class="label"><span>{{ __('messages.Tags') }}</span></td>
                                            <td class="value">
                                                <ul class="product-tags">
                                                    @php 
                                                    $tags=explode(',',$product->tag)  ;
                                                    
                                                    @endphp 
                                                    
                                                    @foreach($tags as $tag)
                                                    @if($tag!="")
                                                    @php  $tagname = DB::select('SELECT * FROM tags WHERE id =' . $tag); @endphp 
                                                    @if(!empty($tagname))
                                                    <li>{{$tagname[0]->name_ge}}</li>
                                                    @endif
                                                    @endif
                                                    @endforeach
                                                   
                                                </ul>
                                            </td>
                                        </tr>
                                        @endif
                                    
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Product Summery End -->

            </div>
        </div>

    </div>
    <!-- Single Products Section End -->

    <!-- Single Products Infomation Section Start -->
    
    <!-- Single Products Infomation Section End --> 
        

@endsection