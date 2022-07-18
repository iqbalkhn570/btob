@extends('frontend.layouts.fullwidth')


@section('meta_title')
Faq's
@stop
@section('meta_description')

@stop
@section('meta_keywords')

@stop
@section('content')
 <!-- Page Title/Header Start 
 <div class="page-title-section section" data-bg-image="{{ asset('public/frontend/images/bg/page-title-1.webp') }}">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">FAQs</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            
                            <li class="breadcrumb-item active">FAQs</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
     Page Title/Header End -->

    <!-- FAQs Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row row-cols-lg-1 row-cols-1 learts-mb-n40">

                <div class="col learts-mb-40">
                    <!-- Section Title Start -->
                    <div class="section-title2">
                        <h2 class="title">Meistens gestellte Fragen:</h2>
                    </div>
                    <!-- Section Title End -->
                    <div class="row">
                        <div class="col">
                            <div class="accordion" id="faq-accordion">
                              @php $i=1;@endphp
                            @if(count($faqs)>0)
                @foreach($faqs as $faq)
                                <div class="card @if($i==1) active @endif">
                                    <div class="card-header">
                                        <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#faq-accordion-{{$faq->id}}">{{$faq->question}}</button>
                                    </div>

                                    <div id="faq-accordion-{{$faq->id}}" class="collapse @if($i==1) show @endif" data-bs-parent="#faq-accordion">
                                        <div class="card-body">
                                            <p> {{$faq->answer}}</p>
                                        </div>
                                    </div>
                                </div>
                                @php $i++;@endphp
                                @endforeach
            @endif
                               
                              
                            </div>
                        </div>
                    </div>
                </div>

              

            </div>
        </div>
    </div>
    <!-- FAQs Section End -->      
@endsection
