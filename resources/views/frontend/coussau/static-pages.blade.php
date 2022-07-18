@extends('frontend.layouts.fullwidth')


@section('meta_title')
@if($data->meta_title)
{{$data->meta_title}}
@endif
@stop
@section('meta_description')
@if($data->meta_description)
{{$data->meta_description}}
@endif

@stop
@section('meta_keywords')
@if($data->meta_keywords)
{{$data->meta_keywords}}
@endif

@stop
@section('style')
<link rel="stylesheet" href="{{ asset('public/frontend/css/coussau-provider.css') }}" type="text/css">

<style>
.text-left{
    text-align: left !important;
}
.text-center{
    text-align: center !important;
}
.letstalk p{
    font-size: 16px;
}
.letstalk p, .letstalk h2{
    line-height: 1.5;
}

/* informed-decision-content-block */

.informed-decision-content-block h3, .about-us-content-block h3{
    text-align: center;
    margin-top: 30px;
    margin-bottom: 20px;
    font-size: var(--headdingH2);
}
.informed-decision-content-block img{
    width: 100%;
    margin: 0 auto;
}
.about-us-content-block h3{
    color: var(--blue);
    margin: 0;
}
.about-us-content-block h4{
    color: var(--blue);
    font-size: var(--headdingH3);
    position: relative;
    margin-bottom: 15px;
}
.about-us-content-block h4::after{
    content: '';
    width: 160px;
    height: 2px;
    background: var(--blue);
    display: block;
    margin-top: 10px;
}
.about-us-content-block p{
    margin-bottom: 15px;
    font-size: 14px;
}
.about-us-content-block ul{
    margin-left: 20px;
}
.about-us-content-block ul li{
    background: url({{ asset('public/frontend/images/list-style-star.png') }}) no-repeat;
    background-position: 0 6px;
    padding-bottom: 10px;
    line-height: 1.7;
    font-size: 14px;
    padding-left: 20px;
}
.mb-2{
    margin-bottom: 2rem;
}
.desktop-right{
    float: right;
}
/* / informed-decision-content-block */

.talk-to-expert-block{
    display: block;
    text-align: left;
}
.talk-to-expert-block h2{
    font-size: 34px;
    font-weight: 700;
}
.talk-to-expert-block p{
    font-size: 16px;
}
.talk-to-expert-block h2, .talk-to-expert-block p{
    margin-bottom: 0;
    color: #FFF;
    text-align: left;
}
.talk-to-expert-block a{
    color: #FFF;
    background: #3544EE;
    padding: 10px 30px;
    border-radius: 50px;
    float: right;
    position: relative;
    top: -60px;
    margin-bottom: -60px;
    font-size: 18px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
.talk-to-expert-block a:hover{
    -webkit-box-shadow: 0 4px 8px #3544EE;
    -moz-box-shadow: 0 4px 8px #3544EE;
    box-shadow: 0 4px 8px #3544EE;
}
.talk-to-expert-container{
    margin-top: 40px;
    background: transparent !important;
    padding: 0 !important;
}
@media all and (min-width: 768px){
  .texts {
    max-width:50%;
  }
}
@media all and (min-width: 768px) and (max-width: 1024px) {
  .financial-advisor-team-wrapper .span_4{
    width: 50%;
  }
  .texts {
    max-width:50%;
  }
  section.homeBanner .item .content .container h2, section.homeBanner .item .content .container p{
    margin-bottom: 10px;
  }
  .tabs-block{
    width: 30%;
  }
  .tab-content{
    width: 65%;
  }
  .about-us-content-block .span_5{
    margin-bottom: 10px;
  }
  .about-us-content-block .span_5, .about-us-content-block .span_5 img, .about-us-content-block .span_7{
    width: 100%;
  }
}
@media all and (max-width: 767px){
  .desktop-right{
    float: left;
  }
  .informed-decision-content-block h3 br, .about-us-content-block h3 br{
    display: none;
  }
  .talk-to-expert-block h2{
    font-size: 28px;
  }
  .talk-to-expert-block a{
    position: static;
    float: none;
    margin-top: 20px;
    display: inline-block;
  }
  .letstalk p, .letstalk h2{
    text-align: center !important;
  }
  .tabs-block{
    float: none;
    width: 100%;
    margin-right: 0;
  }
  .tab-content{
    float: none;
    width: 100%;
  }
  .talk-to-expert-block h2, .talk-to-expert-block p{
    text-align: left !important;
  }
}
b,strong {
    font-weight: bold;
}
.static-pages {
    margin-bottom: 30px;
}
.static-pages ul, .static-pages ol{
  list-style: auto;
  padding-left: 20px;
}
.static-pages  ul li , .static-pages  ol li{
    margin-bottom: 10px;
    font-size: 14px;
    
}
</style>    
@endsection
@section('content')
<div class="static-pages">
       
{!!$data->content!!}      
</div>
        

@endsection