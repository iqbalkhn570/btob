@extends('frontend.layouts.fullwidth')





@section('content')
    <!-- Page Title/Header Start 
    <div class="page-title-section section" data-bg-image="{{ asset('public/frontend/images/bg/page-title-1.webp') }}">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">{{ __('messages.Thank You') }}</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">{{ __('messages.Home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('messages.Thank You') }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
     Page Title/Header End -->

    <!-- Shopping Cart Section Start -->
    <div class="section section-padding">
        <div class="container">
        @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ __('messages.'.Session::get('message')) }}</p>
                 @endif
                <table class="cart-wishlist-table table">
                    <thead>
                        <tr>
                            <th class="name" colspan="2">{{ __('messages.Products') }}</th>
                            <th class="price">{{ __('messages.Price') }}</th>
                            <th class="quantity">{{ __('messages.Quantity') }}</th>
                            <th class="subtotal">{{ __('messages.Total') }}</th>
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
                            <td class="quantity"><span>{{ $details['quantity'] }}
                            </td>
                            <td class="subtotal"><span> {{ $totalsingle }}</span></td>
                          
                        </tr>
                        @endforeach
                        <tr class="total">
                            <th>{{ __('messages.Total') }}</th>
                            <th></th> <th></th> <th></th> 
                            <td><strong><span class="amount"> {{ $total }}</span></strong></td>
                        </tr>
        @endif
                       
                    </tbody>
                </table>
                <div class="row justify-content-between mb-n3">
                   
                    <div class="col-auto">
                        <a class="btn btn-light btn-hover-dark mr-3 mb-3" href="{{ route('category_detail', 'produkte') }}">{{ __('messages.Continue Shopping') }}</a>
                        <!--button class="btn btn-dark btn-outline-hover-dark mb-3">Update Cart</button>-->
                    </div>
                </div>
           
          
        </div>

    </div>
    <!-- Shopping Cart Section End -->
        

@endsection
