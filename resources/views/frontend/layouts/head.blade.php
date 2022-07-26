<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@if(trim($__env->yieldContent('meta_title')))@yield('meta_title') | {{ $website_name }}@else {{$website_setting->meta_title}} | {{ $website_name }} @endif</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="@if(trim($__env->yieldContent('meta_description')))@yield('meta_description') @else {{$website_setting->meta_description}} @endif" />
    <meta name="author" content="{{ $website_name }}">
    <meta name="keyword" content="@if(trim($__env->yieldContent('meta_keywords')))@yield('meta_keywords') @else {{$website_setting->meta_keywords}} @endif"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="language" content="de-DE">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/frontend/images/favicon.ico') }}">

    <!-- CSS
	============================================ -->

    <!-- Vendor CSS (Bootstrap & Icon Font) -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/vendor/font-awesome-pro.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/vendor/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/vendor/customFonts.css') }}">

    <!-- Plugins CSS (All Plugins Files) -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/plugins/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/plugins/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/plugins/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/plugins/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/plugins/ion.rangeSlider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/plugins/photoswipe.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/plugins/photoswipe-default-skin.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/plugins/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/plugins/slick.css') }}">

    <!-- Main Style CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}"> -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!-- <link rel="stylesheet" href="{{ asset('frontend/css/vendor/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins/plugins.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/style.min.css') }}">