<?php 
/**
 * full width layout with no sidebar
 */
 ?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie" lang="en-US">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="ie" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="ie" lang="en-US">
<![endif]-->
<!--[if IE 9]>
<html id="ie9" class="ie" lang="en-US">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) | !(IE 9) ]><!-->
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('frontend.layouts.head')
        @yield('style')
</head>
    <body>
       
        @include('frontend.layouts.header')
        <!--main content start-->
       
        @yield('content')
            
        @include('frontend.layouts.footer')
        @yield('script')
    </body>
</html>