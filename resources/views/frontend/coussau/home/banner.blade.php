<!-- Slider main container Start -->
    <div class="home1-slider swiper-container">
        <div class="swiper-wrapper">
    @foreach($banners as $banner) 
    @if($banner->getBannerImage())       
            <div class="home1-slide-item swiper-slide" data-swiper-autoplay="5000" data-bg-image="{{ $banner->getBannerImage() }}">
            @endif
                <div class="home1-slide1-content">
                    <span class="bg"></span>
                    <span class="slide-border"></span>
                    <!--<span class="icon"><img src="{{ asset('public/frontend/images/slider/home1/slide-1-1.webp') }}" alt="Slide Icon"></span>-->
                    @if($banner->name)
                    <!--<h2 class="title">{{$banner->name}}</h2>-->
                    @endif
                    @if($banner->content)
                    <h3 class="sub-title"> {!! $banner->content !!}</h3>
                    @endif
                    <div class="link"><a href="@if($banner->link) {{ $banner->link }} @endif ">{{__('messages.shop now')}}</a></div>
                </div>
            </div>
            @endforeach       
            <!--<div class="home1-slide-item swiper-slide" data-swiper-autoplay="5000" data-bg-image="{{ asset('public/frontend/images/slider/home1/slide-2.jpg') }}">
                <div class="home1-slide2-content">
                    <span class="bg"></span>
                    <span class="slide-border"></span>
                    <span class="icon">
                        <img src="{{ asset('public/frontend/images/slider/home1/slide-2-2.webp') }}" alt="Slide Icon">
                        <img src="{{ asset('public/frontend/images/slider/home1/slide-2-3.webp') }}" alt="Slide Icon">
                    </span>
                    <h2 class="title">Newly arrived</h2>
                    <h3 class="sub-title">Sale up to <br>10%</h3>
                    <div class="link"><a href="shop.html">shop now</a></div>
                </div>
            </div>
            <div class="home1-slide-item swiper-slide slide-3" data-swiper-autoplay="5000" data-bg-image="{{ asset('public/frontend/images/slider/home1/slide-3.jpg') }}">
                <div class="home1-slide3-content">
                    <h2 class="title">Affectious gifts</h2>
                    <h3 class="sub-title">
                        <img class="left-icon " src="{{ asset('public/frontend/images/slider/home1/slide-2-2.webp') }}" alt="Slide Icon">
                        For friends & family
                        <img class="right-icon " src="{{ asset('public/frontend/images/slider/home1/slide-2-3.webp') }}" alt="Slide Icon">
                    </h3>
                    <div class="link"><a href="shop.html">shop now</a></div>
                </div>
            </div>-->
        </div>
        <div class="home1-slider-prev swiper-button-prev"><i class="ti-angle-left"></i></div>
        <div class="home1-slider-next swiper-button-next"><i class="ti-angle-right"></i></div>
    </div>
    <!-- Slider main container End -->