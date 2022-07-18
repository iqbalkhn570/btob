<?php 
/**
 * Two column layout with right sidebar
 */
 ?><!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('frontend.layouts.head')
        @yield('style')
        <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NVS4KXW');</script>
<!-- End Google Tag Manager -->
    </head>
    <body class="page-layout-2columns-right">
        <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NVS4KXW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
        @include('frontend.layouts.header')
        <!--main content start-->
            <section class="content" >
                @yield('content')
            </section>
            <section class="right-column" >
                @yield('rightsidebar')
            </section>
        @include('frontend.layouts.footer')
        @yield('script')
    </body>
</html>