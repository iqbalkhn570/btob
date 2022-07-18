<?php 
//echo "<pre>"; 
//print_r($product);die;
?>
@if( !empty($product[0]))
@extends('frontend.layouts.fullwidth')
@section('meta_title')
@if($product[0]->meta_title){{$product[0]->meta_title}}@elseif($product[0]->name){{ ucwords($product[0]->name)}}@endif
@stop
@section('meta_description')
@if($product[0]->meta_description){{$product[0]->meta_description}}@elseif($product[0]->content){{ \Str::limit(strip_tags($product[0]->content), 60)}}@endif
@stop
@section('meta_keywords')
@if($product[0]->meta_keyword){{$product[0]->meta_keyword}}@endif
@stop
@endif
@section('style')
@parent
<style>
#shop-products {
    width: 100%;
    float: left;
    height: auto !important;
}
#shop-products .grid-item {
    position: static !important;
}
</style>
@stop

@section('content')
<!-- Page Title/Header Start
<div class="page-title-section section" data-bg-image="{{ asset('public/frontend/images/bg/page-title-1.webp') }}">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="page-title">
                    <h1 class="title">{{__('messages.Shop')}}</h1>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('messages.Home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('messages.Products')}}</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
 Page Title/Header End -->

<!-- Shop Products Section Start -->
<div class="section section-padding pt-0">
@if(session('cart_success'))
        <div class="alert alert-success">
          {{ __('messages.'.session('cart_success')) }}
        </div> 
    @endif
    <!-- Shop Toolbar Start -->
    <div class="shop-toolbar section-fluid border-bottom">
        <div class="container">
            <div class="row learts-mb-n20">

                <!-- Isotop Filter Start -->
                <div class="col-md col-12 align-self-center learts-mb-20">
                    <div class="isotope-filter shop-product-filter" data-target="#shop-products">
                        <button class="active" data-filter="*">{{__('messages.all')}}</button>
                       
                        <button data-filter=".verfugbar">verfügbar </button>
                        <button data-filter=".reserviert">reserviert</button>
                        <button data-filter=".verkauft">verkauft</button>
                       




                    </div>
                </div>
                 <!--Isotop Filter End -->

                <div class="col-md-auto col-12 learts-mb-20">
                    <ul class="shop-toolbar-controls">

                        <li>
                            <div class="product-sorting">
                                <select class="nice-select" onchange="product_sorting(this.value)">
                                    <option value="id" selected="selected">{{__('messages.Default sorting')}}</option>
                                    <option value="id">{{__('messages.Sort by popularity')}}</option>
                                    <!--<option value="id">{{__('messages.Sort by average rating')}}</option>-->
                                    <option value="created_at">{{__('messages.Sort by latest')}}</option>
                                    <option value="price_asc">{{__('messages.Sort by price: low to high')}}</option>
                                    <option value="price_desc">{{__('messages.Sort by price: high to low')}}</option>
                                </select>
                            </div>
                        </li>
                        <!-- <li>
                                <div class="product-column-toggle d-none d-xl-flex">
                                    <button class="toggle hintT-top" data-hint="5 Column" data-column="5"><i class="ti-layout-grid4-alt"></i></button>
                                    <button class="toggle active hintT-top" data-hint="4 Column" data-column="4"><i class="ti-layout-grid3-alt"></i></button>
                                    <button class="toggle hintT-top" data-hint="3 Column" data-column="3"><i class="ti-layout-grid2-alt"></i></button>
                                </div>
                            </li>-->
                        <li>
                            <a class="product-filter-toggle" href="#product-filter">{{__('messages.Filters')}}</a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- Product Filter Start -->
    <div id="product-filter" class="product-filter section-fluid bg-light">
        <div class="container-fluid">
            <div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1 learts-mb-n30">

                <!-- Sort by Start -->
                <div class="col learts-mb-30">
                    <h3 class="widget-title product-filter-widget-title">{{__('messages.sort_by_period')}} </h3>
                    <ul class="widget-list product-filter-widget customScroll">
                        @foreach($periods as $period)
                        <li><a href="#" onclick="filterResults('pd',{{$period->id}});">{{$period->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- Sort by End -->

                <!-- Price filter Start
                    <div class="col learts-mb-30">
                        <h3 class="widget-title product-filter-widget-title">Price filter</h3>
                        <ul class="widget-list product-filter-widget customScroll">
                            <li> <a href="#">All</a></li>
                            <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>0.00</span> - <span class="amount"><span class="cur-symbol">£</span>80.00</span></a></li>
                            <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>80.00</span> - <span class="amount"><span class="cur-symbol">£</span>160.00</span></a></li>
                            <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>160.00</span> - <span class="amount"><span class="cur-symbol">£</span>240.00</span></a></li>
                            <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>240.00</span> - <span class="amount"><span class="cur-symbol">£</span>320.00</span></a></li>
                            <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>320.00</span> +</a></li>
                        </ul>
                    </div>
                     Price filter End -->



                <!-- Filters by colors Start 
                    <div class="col learts-mb-30">
                        <h3 class="widget-title product-filter-widget-title">Filters by colors</h3>
                        <ul class="widget-colors product-filter-widget customScroll">
                            <li><a href="#" class="hintT-top" data-hint="Black"><span data-bg-color="#000000">Black</span></a></li>
                            <li><a href="#" class="hintT-top" data-hint="White"><span data-bg-color="#FFFFFF">White</span></a></li>
                            <li><a href="#" class="hintT-top" data-hint="Dark Red"><span data-bg-color="#b2483c">Dark Red</span></a></li>
                            <li><a href="#" class="hintT-top" data-hint="Flaxen"><span data-bg-color="#d5b85a">Flaxen</span></a></li>
                            <li><a href="#" class="hintT-top" data-hint="Pine"><span data-bg-color="#01796f">Pine</span></a></li>
                            <li><a href="#" class="hintT-top" data-hint="Tortilla"><span data-bg-color="#997950">Tortilla</span></a></li>
                        </ul>
                    </div>
                   Filters by colors End -->

                <!-- Brands Start -->
                <div class="col learts-mb-30">
                    <h3 class="widget-title product-filter-widget-title">{{__('messages.Manufacturers')}}</h3>
                    <ul class="widget-list product-filter-widget customScroll">
                        @if( $manufacturers->count() > 0)
                        @foreach($manufacturers as $row)
                        <?php 
                                $products_count = DB::select("SELECT * FROM products WHERE status='enabled' and manufacturer_id =" . "'$row->id'");
                               
                                ?>
                                @if(count($products_count)>0)
                        <li><a href="#"
                                onclick="filterResults('mr','{{$row->id}}');">{{$row->name}}</a> <span
                                class="count">({{count($products_count)}})</span></li>
                                @endif
                        @endforeach
                        @endif


                    </ul>
                </div>
                <!-- Brands End -->

            </div>
        </div>
    </div>
    <!-- Product Filter End -->
    <div class="section section-fluid learts-mt-70">
        <div class="container">
            <div class="row learts-mb-n50">

                <div class="col-lg-9 col-12 learts-mb-50 order-lg-2">
                    <!-- Products Start -->
                    <div id="shop-products" class="products isotope-grid row row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-1">

                        
                        @if( !empty($product[0]))
                        @foreach($product as $row)
                        
                        <div class="grid-item col {{$row->sale_status}}">
                            <div class="product">
                                <div class="product-thumb">
                                   
                                
                                    <a href="{{ route('product_detail', $row->slug) }}" class="image">

                                        <img src="{{ asset('public/frontend/images/product/'.$row->image) }}"
                                            alt="Product Image">
                                        <img class="image-hover "
                                            src="{{ asset('public/frontend/images/product/'.$row->image) }}"
                                            alt="Product Image">
                                    </a>

                                </div>
                                <div class="product-info">
                                    <h6 class="title"><a
                                            href="{{ route('product_detail', $row->slug) }}">{{ $row->name }}</a></h6>
                                    <span class="price">
                                        {{DEFAULT_CURRENCY}} {{ $row->price }}
                                       
                                    </span>
                                    <!--<span class="price"> {{DEFAULT_VAT}}</span>-->
                                    <?php
                        $cartitem = DB::select("SELECT sum(quantity) as qty FROM carts WHERE mail_status='No' and product_id =" . $row->id);
                
                ?>
                @if($row->quantity>$cartitem[0]->qty && $row->sale_status=="verfugbar")
                                    <div class="product-buttons">
                                        <a href="{{ route('add.to.cart', $row->id) }}" class="product-button hintT-top"
                                            data-hint="{{__('messages.Add to Cart')}}"><i class="fal fa-shopping-cart"></i></a>

                                    </div>
                                    @endif 
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else <span style="color:red">{{__('messages.Data not found')}} .</span>
                        @endif



                    </div>
                    <!-- Products End -->
                    <!--<div class="text-center learts-mt-70">
                            <a href="#" class="btn btn-dark btn-outline-hover-dark"><i class="ti-plus"></i> More</a>
                        </div>-->
                </div>

                <div class="col-lg-3 col-12 learts-mb-10 order-lg-1">

                    <!-- Search Start -->
                    <div class="single-widget learts-mb-40">
                        <div class="widget-search">
                            <form action="{{ route('category_detail', 'produkte') }}">
                                <input name="search_term" type="text" placeholder="{{__('messages.Search')}}..."
                                    value="{{ app('request')->input('search_term') }}" autocomplete="off" />
                                <button type="submit"><i class="fal fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- Price Range Start -->
                    <?php  
                    $products_price = DB::select("SELECT min(price2) as minprice,max(price2) as maxprice FROM products WHERE status='enabled'");
                     // print_r($products_price);  
                     // $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
               // $minprice= $formatter->formatCurrency($products_price[0]->minprice, 'EUR'); 
               //$formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
                //$minprice= $formatter->formatCurrency($products_price[0]->minprice, 'EUR');       
                    ?>
                    <div class="single-widget learts-mb-40">
                        <h3 class="widget-title product-filter-widget-title">{{__('messages.Filters by price')}}</h3>
                        <div class="widget-price-range">
                            <input class="range-slider" type="text" data-min="{{$products_price[0]->minprice}}" data-max="{{$products_price[0]->maxprice}}" data-from="{{$products_price[0]->minprice}}"
                                data-to="{{$products_price[0]->maxprice}}" />
                        </div>
                    </div>
                    <!-- Price Range End -->
                    <div class="single-widget learts-mb-40">

                        <select class="nice-select" name="category_id" id="category_id">
                            <option value="produkte">{{__('messages.Select Product Category')}}</option>
                            @if( $categories->count() > 0)
                            @foreach($categories as $row)
                            <?php 
                                $products_count = DB::select("SELECT * FROM products WHERE status='enabled' and category_id =" . $row->id);
                               
                                ?>
                                @if(count($products_count)>0)
                            <option value="{{$row->slug}}" @if($selected_category==$row->id) selected="selected"
                                @endif>{{$row->name}} ({{count($products_count)}})</option>
                                @endif
                            @endforeach
                            @endif

                        </select>

                    </div>
                    <div class="single-widget learts-mb-40">
                        <select class="nice-select" name="period_id" id="period_id" onchange="filterResults('pd',this.value);">
                            <option value="produkte">{{__('messages.Select a period')}}</option>
                            @if( $periods->count() > 0)
                            @foreach($periods as $row)
                            <?php 
                                $products_count = DB::select("SELECT * FROM products WHERE status='enabled' and period_id =" . $row->id);
                               
                                ?>
                                @if(count($products_count)>0)
                            <option value="{{$row->id}}" @if($selected_period==$row->id) selected="selected"
                                @endif>{{$row->name}}  ({{count($products_count)}})</option>
                                @endif
                            @endforeach
                            @endif

                        </select>

                    </div>
                    <!-- subCategories Start -->
                    <div class="single-widget learts-mb-40">
                        <h3 class="widget-title product-filter-widget-title">{{__('messages.Product sub categories')}}
                        </h3>
                        <ul class="widget-list">
                            @if( $subcategories->count() > 0)
                            @foreach($subcategories as $row)
                            <?php 
                                $products_count_sub = DB::select("SELECT * FROM products WHERE status='enabled' and subcategory_id =" . $row->id);
                                $category = DB::select("SELECT * FROM categories WHERE id =" . $row->category_id);
                                $category_id=$category[0]->slug;
                               
                                ?>
                                @if(count($products_count_sub)>0)
                            <li><a
                                    href="{{ route('subcategory_detail',['catid' => $category_id,'subcatid' => $row->slug] ) }}">{{$row->name}}
                                </a> <span class="count">{{count($products_count_sub)}}</span></li>
                                @endif
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <!-- subCategories End -->
                </div>

            </div>
        </div>
    </div>

</div>
<!-- Shop Products Section End -->


@endsection
