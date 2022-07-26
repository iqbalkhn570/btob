@extends('frontend.layouts.fullwidth')
@section('meta_title')
Contact Us
@stop
@section('meta_description')
Contact detail of website
@stop
@section('meta_keywords')
contact, contact us
@stop
@section('content')
<!-- Page Title/Header Start 
    <div class="page-title-section section" data-bg-image="{{ asset('public/frontend/images/bg/page-title-1.webp') }}">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-title">
                        <h1 class="title">Kontakt</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Startseite</a></li>
                            <li class="breadcrumb-item active">Kontakt</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
     Page Title/Header End -->

    <!-- Contact Information & Map Section Start -->
    <div class="section section-padding">
        <div class="container">
            <!-- Section Title Start -->
            <div class="section-title2 text-center">
                <h2 class="title">Bleiben Sie mit uns in Kontakt</h2>
                <!--<p>Been tearing your hair out to find the perfect gift for your loved ones? Try visiting our nationwide local stores. You can also contact us to become partner or distributor. Call us, send us an email or make an appointment now.</p>-->
            </div>
            <!-- Section Title End -->

            <!-- Contact Information Start -->
            <div class="row learts-mb-n30">
                <div class="col-lg-4 col-md-6 col-12 learts-mb-30">
                    <div class="contact-info">
                        <h4 class="title">ADRESSE</h4>
                        <!--<span class="info"><i class="icon fal fa-map-marker-alt"></i> {{$website_setting->contact_address1}} {{$website_setting->contact_address2 ? $website_setting->contact_address2 .',' : ''}}  {{$website_setting->contact_city}}, {{$website_setting->contact_province}} {{$website_setting->contact_zip}}</span>-->
                        Sonnenrain 2<br/>
74427 Fichtenberg <br/>
Web: www.antikemoebelkaufen.de<br/>
USt-ID: DE342875478
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 learts-mb-30">
                    <div class="contact-info">
                        <h4 class="title">KONTAKT</h4>
                        @if($website_setting->contact_phone1)
                        <span class="info"><i class="icon fal fa-phone-alt"></i> Tel: {{$website_setting->contact_phone1}} <br> Mob: {{$website_setting->contact_phone2}}</span>
                        @endif
                        @if($website_setting->contact_email_id)
                        <span class="info"><i class="icon fal fa-envelope"></i> Mail: <a href="{{$website_setting->contact_email_id}}">{{$website_setting->contact_email_id}}</a></span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 learts-mb-30">
                    <div class="contact-info">
                        <h4 class="title"> Öffnungszeiten</h4>
                        <span class="info"><i class="icon fal fa-clock"></i> Montag Freitag : 10:00 – 12:00 Uhr<br> Sonntag und Samstag: 14:00 – 17:00 Uhr</span>
                    </div>
                </div>
            </div>
            <!-- Contact Information End -->

            <!-- Contact Map Start 
            <div class="row learts-mt-60 big-img-center">
                <div class="col">
                <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2618.2687681853604!2d9.70699381590619!3d48.986442499635416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x479852e52906f119%3A0xcf277935eb133cca!2sSonnenrain%202%2C%2074427%20Fichtenberg%2C%20Germany!5e0!3m2!1sen!2sin!4v1634287277953!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
               <img src="{{ asset('public/frontend/images/open+sign.jpg') }}" alt="open image">
                </div>
            </div>
            Contact Map End -->

        </div>
    </div>
    <!-- Contact Information & Map Section End -->

    <!-- Contact Form Section Start -->
    <div class="section section-padding pt-0">
        <div class="container">
            <!-- Section Title Start -->
            <div class="section-title2 text-center">
                <h2 class="title">Kontaktieren Sie unseren Kundenservice</h2>
            </div>
            <!-- Section Title End -->

            <div class="row">
                <div class="col-lg-8 col-12 mx-auto">
                    <div class="contact-form">
                         @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ __('messages.'.Session::get('message')) }}</p>
                 @endif
                 @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                        <form action="{{route('contact')}}" id="contact-form" method="post">
                            @csrf
                            <div class="row learts-mb-n30">
                            <div class="col-md-6 col-12 learts-mb-30"><input type="text" placeholder="Vorname *" name="firstname" value="{{old('firstname') }}"></div>
                                <div class="col-md-6 col-12 learts-mb-30"><input type="text" placeholder="Name *" name="name" value="{{old('name') }}"></div>
                                <div class="col-md-6 col-12 learts-mb-30"><input type="email" placeholder="E-Mail *" name="email" value="{{old('email') }}"></div>
                                <div class="col-md-6 col-12 learts-mb-30"><input type="number" placeholder="Mobil *" name="mobile" value="{{old('mobile') }}"></div>
                                <div class="col-12 learts-mb-30"><textarea name="message" placeholder="Nachricht"></textarea></div>
                                
                                <div class="col-12 text-center learts-mb-30"><button type="submit" class="btn btn-dark btn-outline-hover-dark">Senden</button></div>
                            </div>
                        </form>
                       
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Contact Form Section End -->



@endsection