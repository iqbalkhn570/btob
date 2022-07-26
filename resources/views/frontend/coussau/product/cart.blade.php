@extends('frontend.layouts.fullwidth')

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
                        <h1 class="title">{{ __('messages.Cart') }}</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">{{ __('messages.Home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('messages.Cart') }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
     Page Title/Header End -->
  
    <!-- Shopping Cart Section Start -->
    <div class="section section-padding">
    @if(session('cart_success'))
        <div class="alert alert-success">
          {{ __('messages.'.session('cart_success')) }}
        </div> 
    @endif
        <div class="container">
            <form class="cart-form" action="#">
                <table class="cart-wishlist-table table">
                    <thead>
                        <tr>
                            <th class="name" colspan="2">{{ __('messages.Products') }}</th>
                            <th class="price">{{ __('messages.Price') }}</th>
                            <th class="quantity">{{ __('messages.Quantity') }}</th>
                            <th class="subtotal">{{ __('messages.Total') }}</th>
                            <th class="remove">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $total = 0; $tot = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php 
                $price2=str_replace('.', '', $details['price']);
                $price=str_replace(',', '.', $price2);
                $totalsingle= $price * $details['quantity'];
                $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
                $totalsingle= $formatter->formatCurrency($totalsingle, 'EUR');
                $tot += $price * $details['quantity']; 
                $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
                $total= $formatter->formatCurrency($tot, 'EUR');
                @endphp
                        <tr data-id="{{ $id }}">
                            <td class="thumbnail"><a href="{{ route('product_detail', $details['slug']) }}"><img src="{{ asset('public/frontend/images/product/'.$details['image']) }}" alt="cart-product-1"></a></td>
                            <td class="name"> <a href="{{ route('product_detail', $details['slug']) }}">{{ $details['name'] }}</a></td>
                            <td class="price"><span> {{ $details['price'] }} {{DEFAULT_CURRENCY}}</span></td>
                            <td class="quantity">
                            {{ $details['quantity'] }}
                                <!--<div class="product-quantity">
                                    <span class="qty-btn minus"><i class="ti-minus update-cart-minus"></i></span>
                                    <input type="text" class="input-qty" value="{{ $details['quantity'] }}" >
                                    <span class="qty-btn plus"><i class="ti-plus update-cart-plus"></i></span>
                                </div>-->
                            </td>
                            <td class="subtotal"><span> {{ $totalsingle }} </span></td>
                            
                            <td class="remove remove-from-cart"><a href="#" class="btn">×</a></td>
                        </tr>
                        @endforeach
        @endif
                       
                    </tbody>
                </table>
                <div class="row justify-content-between mb-n3">
                    <div class="col-auto mb-3">
                        <div class="cart-coupon">
                            <!--<input type="text" placeholder="Enter your coupon code">
                            <button class="btn"><i class="fal fa-gift"></i></button>-->
                        </div>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-light btn-hover-dark mr-3 mb-3" href="{{ route('category_detail', 'produkte') }}">{{ __('messages.Continue Shopping') }}</a>
                        <!--button class="btn btn-dark btn-outline-hover-dark mb-3">Update Cart</button>-->
                    </div>
                </div>
            </form>
            <div class="cart-totals mt-5">
                <h2 class="title">{{ __('messages.Cart totals') }}</h2>
                <table>
                    <tbody>
                        <tr class="subtotal">
                            <th>{{ __('messages.Subtotal') }}</th>
                            <td><span class="amount">{{ $total }}</span></td>
                        </tr>
                        <tr class="total">
                            <th>{{ __('messages.Total') }}</th>
                            <td><strong><span class="amount"> {{ $total }}</span></strong></td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{route('checkout')}}" class="btn btn-dark btn-outline-hover-dark">{{ __('messages.Proceed to checkout') }}</a>
            </div>
        </div>

    </div>
    <!-- Shopping Cart Section End -->
        

@endsection
