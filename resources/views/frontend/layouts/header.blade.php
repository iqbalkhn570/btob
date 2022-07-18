<?php
$categories = Cache::rememberForever('categories', function () {
    return DB::select('SELECT * FROM categories WHERE status="enabled" order by name asc');
});
?>
<div class="header-section section section-fluid bg-white d-none d-xl-block">
        <div class="container">
            <div class="row align-items-center new-nav-bar">

                <!-- Header Logo Start -->
                <!-- <div class="col-auto">
                    
                </div> -->
                <!-- Header Logo End -->

                <!-- Search Start -->
                <div class="col-auto me-auto new-nav-bar-ul-part">
                    <nav class="site-main-menu site-main-menu-left menu-height-100 justify-content-center">
                        <ul>
                            <li class="no-children"><a href="{{route('home') }}"><span class="menu-text">{{ __('messages.Home') }}</span></a>
                                
                            </li>
                            <li>
                                <a href="{{route('home') }}/produkte"><span class="menu-text">{{ __('messages.Products') }}</span></a>
                                <ul class="sub-menu">
                               
                                @foreach($categories as $row)
                                <?php 
                                        $products_count = DB::select("SELECT * FROM products WHERE status='enabled' and category_id =" . $row->id);
                                       //print_r($products_count);
                                        ?>
                                       @if(count($products_count)>0)
                                    <li>
                                   
                                        <a href="{{ route('category_detail', $row->slug) }}"><span class="menu-text">{{$row->name}} ({{count($products_count)}})</span></a>
                                       
                                        <ul class="sub-menu">
                                            <?php 
                                        $subcategories = DB::select('SELECT * FROM subcategories WHERE category_id =' . $row->id);
                                        ?>
                                         @foreach($subcategories as $rowsub)
                                         <?php 
                                        $products_count = DB::select("SELECT * FROM products WHERE status='enabled' and subcategory_id =" . $rowsub->id);
                                      
                                        ?>
                                         @if(count($products_count)>0)
                                            <li><a href="{{ route('subcategory_detail',['catid' => $row->slug,'subcatid' => $rowsub->slug] ) }}"><span class="menu-text">{{$rowsub->name}} ({{count($products_count)}})</span></a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endif
                                    @endforeach
                                   
                                </ul>
                            </li>
                            <li class="no-children"><a href="{{route('about_us') }}"><span class="menu-text">{{ __('messages.about_us') }}</span></a></li>
                        </ul>
                        <ul>
                            <li>
                                <div class="header-logo">
                                    <a href="{{route('home')}}">
                                        <img src="{{ asset('public/frontend/images/'.$website_setting->logo) }}" alt="{{$website_name}}">
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <ul style="width: 408px;">
                            <li class="no-children"><a href="{{route('contact_us') }}"><span class="menu-text">{{ __('messages.contact_us') }}</span></a></li>
                            <li class="no-children"><a href="{{route('philosophie') }}"><span class="menu-text">Philosophie</span></a></li>
                            <li class="no-children"><a href="{{route('faqpage') }}"><span class="menu-text">{{ __('messages.faq') }}</span></a></li>
                            <!--<li class="no-children"><a href="{{route('blogs') }}"><span class="menu-text">{{ __('messages.blog') }}</span></a></li>-->
                        </ul>
                    </nav>
                </div>
                <!-- Search End -->

                <!-- Search Start -->
                <div class="serach-right-part">
                    <div class="col-auto d-none d-xl-block">
                        <div class="header2-search">
                            
                            <form action="{{ route('category_detail', 'produkte') }}">
                                <input name="search_term" type="text" placeholder="{{ __('messages.Search') }}" value="{{ app('request')->input('search_term') }}"  autocomplete="off"/>
                                <button class="btn" type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- Search End -->

                    <!-- Header Tools Start -->
                    <div class="col-auto">
                        <div class="header-tools justify-content-end">
                            
                           
                            <div class="header-cart">
                                <a href="#offcanvas-cart" class="offcanvas-toggle"><span class="cart-count">{{ count((array) session('cart')) }}</span><i class="fal fa-shopping-cart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header Tools End -->

            </div>
        </div>

    </div>
    <!-- Header Section End -->

    <!-- Header Section Start -->
    <div class="sticky-header section bg-white section-fluid d-none d-xl-block">
        <div class="container">
            <div class="row align-items-center">

                <!-- Header Logo Start 
                <div class="col-xl-auto col">
                    <div class="header-logo">
                        
						<a href="{{route('home')}}"><img src="{{ asset('frontend/images/'.$website_setting->logo) }}" alt="{{$website_name}}"></a>
                    </div>
                </div>
                 Header Logo End -->

                <!-- Search Start -->
                <div class="col-auto me-auto d-none d-xl-block new-nav-bar-ul-part">
                    <nav class="site-main-menu site-main-menu-left menu-height-100 justify-content-center">
                        <ul>
                            <li class="no-children"><a href="{{route('home') }}"><span class="menu-text">{{ __('messages.Home') }}</span></a>
                                
                            </li>
                            <li>
                                <a href="{{route('home') }}/produkte"><span class="menu-text">{{ __('messages.Products') }}</span></a>
                                <ul class="sub-menu">
                               
                                @foreach($categories as $row)
                                <?php 
                                        $products_count = DB::select("SELECT * FROM products WHERE status='enabled' and category_id =" . $row->id);
                                       
                                        ?>
                                    <li>
                                   
                                        <a href="{{ route('category_detail', $row->slug) }}"><span class="menu-text">{{$row->name}} ({{count($products_count)}})</span></a>
                                       
                                        <ul class="sub-menu">
                                            <?php 
                                        $subcategories = DB::select('SELECT * FROM subcategories WHERE category_id =' . $row->id);
                                        ?>
                                         @foreach($subcategories as $rowsub)
                                         <?php 
                                        $products_count = DB::select("SELECT * FROM products WHERE status='enabled' and subcategory_id =" . $rowsub->id);
                                       
                                        ?>
                                            <li><a href="{{ route('subcategory_detail',['catid' => $row->slug,'subcatid' => $rowsub->slug] ) }}"><span class="menu-text">{{$rowsub->name}} ({{count($products_count)}})</span></a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                   
                                </ul>
                            </li>
                            <li class="no-children"><a href="{{route('about_us') }}"><span class="menu-text">{{ __('messages.about_us') }}</span></a></li>
                        </ul>
                        <ul>
                            <li>
                                <div class="header-logo">
                                    <a href="{{route('home')}}">
                                        <img src="{{ asset('public/frontend/images/'.$website_setting->logo) }}" alt="{{$website_name}}">
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <ul style="width: 408px;">
                            <li class="no-children"><a href="{{route('contact_us') }}"><span class="menu-text">{{ __('messages.contact_us') }}</span></a></li>
                            <li class="no-children"><a href="{{route('philosophie') }}"><span class="menu-text">Philosophie</span></a></li>
                            <li class="no-children"><a href="{{route('faqpage') }}"><span class="menu-text">{{ __('messages.faq') }}</span></a></li>
                            <!--<li class="no-children"><a href="{{route('blogs') }}"><span class="menu-text">{{ __('messages.blog') }}</span></a></li>
                        --></ul>
                    </nav>
                </div>
                <!-- Search End -->

                <!-- Search Start -->
                <div class="serach-right-part">
                    <div class="col-auto d-none d-xl-block">
                        <div class="header2-search">
                        <form action="{{ route('category_detail', 'produkte') }}">
                                <input name="search_term" type="text" placeholder="{{ __('messages.Search') }}..." value="{{ app('request')->input('search_term') }}"  autocomplete="off"/>
                                <button class="btn" type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- Search End -->

                    <!-- Header Tools Start -->
                    <div class="col-auto">
                        <div class="header-tools justify-content-end">
                           
                            <div class="header-search d-none d-sm-block d-xl-none">
                                <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fal fa-search"></i></a>
                            </div>
                            
                            <div class="header-cart">
                                <a href="#offcanvas-cart" class="offcanvas-toggle"><span class="cart-count">{{ count((array) session('cart')) }}</span><i class="fal fa-shopping-cart"></i></a>
                            </div>
                            <div class="mobile-menu-toggle d-xl-none">
                                <a href="#" class="offcanvas-toggle">
                                    <svg viewBox="0 0 800 600">
                                        <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" class="top"></path>
                                        <path d="M300,320 L540,320" class="middle"></path>
                                        <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" class="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header Tools End -->

            </div>
        </div>

    </div>
    <!-- Header Section End -->
    <!-- Mobile Header Section Start -->
    <div class="mobile-header bg-white section d-xl-none">
        <div class="container">
            <div class="row align-items-center">

                <!-- Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="{{route('home')}}"><img src="{{ asset('public/frontend/images/'.$website_setting->logo) }}" alt="{{$website_name}}"></a>
                    </div>
                </div>
                <!-- Header Logo End -->

                <!-- Header Tools Start -->
                <div class="col-auto">
                    <div class="header-tools justify-content-end">
                       
                        <div class="header-search d-none d-sm-block">
                            <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fal fa-search"></i></a>
                        </div>
                        
                        <div class="header-cart">
                            <a href="#offcanvas-cart" class="offcanvas-toggle"><span class="cart-count">{{ count((array) session('cart')) }}</span><i class="fal fa-shopping-cart"></i></a>
                        </div>
                        <div class="mobile-menu-toggle">
                            <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                                <svg viewBox="0 0 800 600">
                                    <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" class="top"></path>
                                    <path d="M300,320 L540,320" class="middle"></path>
                                    <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" class="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Header Tools End -->

            </div>
        </div>
    </div>
    <!-- Mobile Header Section End -->

    <!-- Mobile Header Section Start -->
    <div class="mobile-header sticky-header bg-white section d-xl-none">
        <div class="container">
            <div class="row align-items-center">

                <!-- Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="{{route('home')}}"><img src="{{ asset('public/frontend/images/'.$website_setting->logo) }}" alt="{{$website_name}}"></a>
                    </div>
                </div>
                <!-- Header Logo End -->

                <!-- Header Tools Start -->
                <div class="col-auto">
                    <div class="header-tools justify-content-end">
                        
                        <div class="header-search d-none d-sm-block">
                            <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fal fa-search"></i></a>
                        </div>
                       
                        <div class="header-cart">
                            <a href="#offcanvas-cart" class="offcanvas-toggle"><span class="cart-count">{{ count((array) session('cart')) }}</span><i class="fal fa-shopping-cart"></i></a>
                        </div>
                        <div class="mobile-menu-toggle">
                            <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                                <svg viewBox="0 0 800 600">
                                    <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" class="top"></path>
                                    <path d="M300,320 L540,320" class="middle"></path>
                                    <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" class="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Header Tools End -->

            </div>
        </div>
    </div>
    <!-- Mobile Header Section End -->
   

   

    <!-- OffCanvas Cart Start -->
    <div id="offcanvas-cart" class="offcanvas offcanvas-cart">
        <div class="inner">
            <div class="head">
                <span class="title">{{ __('messages.Cart') }}</span>
                <button class="offcanvas-close">×</button>
            </div>
            <div class="body customScroll">
                <ul class="minicart-product-list">
                @php $total = 0; $tot = 0; @endphp
                        @foreach((array) session('cart') as $id => $details)
                            @php
                 $price2=str_replace('.','', $details['price']);
                  $price=str_replace(',', '.', $price2);
                             $tot += $price * $details['quantity'];
                            $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
                $total= $formatter->formatCurrency($tot, 'EUR'); 
                            @endphp
                        @endforeach
                        @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                    <li  data-id="{{ $id }}">
                        <a href="{{ route('product_detail', $details['slug']) }}" class="image"><img src="{{ asset('public/frontend/images/product/'.$details['image']) }}" alt="Cart product Image"></a>
                        <div class="content">
                            <a href="{{ route('product_detail', $details['slug']) }}" class="title">{{ $details['name'] }}</a>
                            <span class="quantity-price">{{ $details['quantity'] }} x <span class="amount">{{DEFAULT_CURRENCY}} {{ $details['price'] }}</span></span>
                            <a href="#" class="remove offcanvas-remove-from-cart">×</a>
                            
                        </div>
                    </li>
                    @endforeach
                    @endif
                   
                </ul>
            </div>
            <div class="foot">
                <div class="sub-total">
                    <strong>{{ __('messages.Total') }} :</strong>
                    <span class="amount"> {{ $total }}</span>
                </div>
                <div class="buttons">
                    <a href="{{ route('cart') }}" class="btn btn-dark btn-hover-primary">{{ __('messages.view cart') }}</a>
                   <!-- <a href="checkout.html" class="btn btn-outline-dark">checkout</a>-->
                </div>
                <!--<p class="minicart-message">Free Shipping on All Orders Over $100!</p>-->
            </div>
        </div>
    </div>
    <!-- OffCanvas Cart End -->

    <!-- OffCanvas Search Start -->
    <div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
        <div class="inner customScroll">
            <div class="offcanvas-menu-search-form">
            <form action="{{ route('category_detail', 'produkte') }}">
                            <input name="search_term" type="text" placeholder="{{ __('messages.Search') }}..." value="{{ app('request')->input('search_term') }}"  autocomplete="off"/>
                            <button class="btn" type="submit"><i class="far fa-search"></i></button>
                        </form>
            </div>
            <div class="offcanvas-menu">
                <ul>
				 <li class="no-children"><a href="{{route('home') }}"><span class="menu-text">{{ __('messages.Home') }}</span></a>
                                
                            </li>
                    <li><a href="{{route('home') }}/produkte"><span class="menu-text">{{ __('messages.Products') }}</span></a>
                        <ul class="sub-menu">
						 @foreach($categories as $row)
                        <?php 
                                $products_count = DB::select("SELECT * FROM products WHERE status='enabled' and category_id =" . $row->id);
                               
                                ?>
                            <li>
                                <a href="{{ route('category_detail', $row->slug) }}"><span class="menu-text">{{$row->name}} ({{count($products_count)}})</span></a>
                                <ul class="sub-menu">
								 <?php 
                                $subcategories = DB::select('SELECT * FROM subcategories WHERE category_id =' . $row->id);
                                ?>
                                 @foreach($subcategories as $rowsub)
                                 <?php 
                                $products_count = DB::select("SELECT * FROM products WHERE status='enabled' and subcategory_id =" . $rowsub->id);
                               
                                ?>
                                    <li><a href="{{ route('subcategory_detail',['catid' => $row->slug,'subcatid' => $rowsub->slug] ) }}"><span class="menu-text">{{$rowsub->name}} ({{count($products_count)}})</span></a></li>
                                    @endforeach
                                </ul>
                            </li>
							  @endforeach
                        </ul>
                    </li>
					 <li class="no-children"><a href="{{route('about_us') }}"><span class="menu-text">{{ __('messages.about_us') }}</span></a></li>
                            <li class="no-children"><a href="{{route('contact_us') }}"><span class="menu-text">{{ __('messages.contact_us') }}</span></a></li>
                </ul>
            </div>
            <div class="offcanvas-buttons">
                <div class="header-tools">
                   
                   
                    <div class="header-cart">
                        <a href="#offcanvas-cart"><span class="cart-count">{{ count((array) session('cart')) }}</span><i class="fal fa-shopping-cart"></i></a>
                    </div>
                </div>
            </div>
            <div class="offcanvas-social">
            @if($website_setting->facebook_link)
                <a href="{{$website_setting->facebook_link}}"><i class="fab fa-facebook-f"></i></a>
                @endif
             @if($website_setting->twitter_link)
                <a href="{{$website_setting->twitter_link}}"><i class="fab fa-twitter"></i></a>
            @endif
            @if($website_setting->instagram_link)
                <a href="{{$website_setting->instagram_link}}"><i class="fab fa-instagram"></i></a>
                @endif
                @if($website_setting->youtube_link)
                <a href="{{$website_setting->youtube_link}}"><i class="fab fa-youtube"></i></a>
                @endif
            </div>
        </div>
    </div>
    <!-- OffCanvas Search End -->

    <div class="offcanvas-overlay"></div>