<div class="footer1-section section section-padding">
        <div class="container">
            <div class="row text-center row-cols-1">
                <div class="footer1-menu col">
                    <ul class="widget-menu justify-content-center">
                        <li><a href="{{route('about_us') }}">{{ __('messages.about_us') }}</a></li>
                        
                        <li><a href="{{route('contact_us') }}">{{ __('messages.contact_us') }}</a></li>
                        <li><a href="{{route('impressum') }}">{{ __('messages.imprint') }}</a></li>
                        <li><a href="{{route('privacy_policy') }}">{{ __('messages.privacy_policy') }}</a></li>
                        <li><a href="{{route('terms_conditions') }}">{{ __('messages.term_condition') }}</a></li>
                        
                    </ul>
                </div>
                
                <!--<div class="footer1-social col">
                    <ul class="widget-social justify-content-center">
                        @if($website_setting->twitter_link)
                        <li class="hintT-top" data-hint="Twitter"> <a href="{{$website_setting->twitter_link}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        @endif
                        @if($website_setting->facebook_link)
                        <li class="hintT-top" data-hint="Facebook"> <a href="{{$website_setting->facebook_link}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        @endif
                        @if($website_setting->instagram_link)
                        <li class="hintT-top" data-hint="Instagram"> <a href="{{$website_setting->instagram_link}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        @endif
                        @if($website_setting->youtube_link)
                        <li class="hintT-top" data-hint="Youtube"> <a href="{{$website_setting->youtube_link}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        @endif
                    </ul>
                </div>-->
                <div class="footer1-copyright col">
                    <p class="copyright">&copy; {{date("Y")}} Coussau von Au. {{ __('messages.all_rights_reserved') }} | 
                    @if($website_setting->contact_phone1)    
                    <strong>{{$website_setting->contact_phone1}}</strong> | 
                    @endif
                    @if($website_setting->contact_email_id)
                    <a href="mailto:{{$website_setting->contact_email_id}}">{{$website_setting->contact_email_id}}</a>
                    @endif
                </p>
                </div>

            </div>
        </div>
    </div>
    

    <!-- JS
============================================ -->

    <!-- Vendors JS -->
    <script src="{{ asset('public/frontend/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/vendor/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/vendor/jquery-migrate-3.1.0.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/vendor/bootstrap.bundle.min.js') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('public/frontend/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/slick.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/mo.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/jquery.matchHeight-min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/photoswipe.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/photoswipe-ui-default.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/ResizeSensor.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/jquery.sticky-sidebar.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/product360.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/scrollax.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins/instafeed.min.js') }}"></script>

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!-- <script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script> -->

    <!-- Main Activation JS -->
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script type="text/javascript">
  
    $(".update-cart-plus").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                sign: 'plus', 
                quantity: ele.parents("tr").find(".input-qty").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
    $(".update-cart-minus").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                sign: 'minus', 
                quantity: ele.parents("tr").find(".input-qty").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
  
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
    
    $(".offcanvas-remove-from-cart").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("li").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
    $("#category_id").change(function() {
    var end = this.value;
    var category_id = $('#category_id').val();
    window.location.href = '{{ route('home') }}' + '/' + category_id;
});


function filterResults(p1, p2) {
    let href = '{{ route('search') }}' + '/filter?'
    category_id = $("#category_id").val();
    //alert(category_id);
    if (category_id != "produkte") {
        href += '&cid=' + category_id;
    }
    if (p1 == "pd") {
        href += '&pd=' + p2;
    }
    if (p1 == "mr") {
        href += '&mr=' + p2;
    }
    document.location.href = href;
}

function product_sorting(id) {
    let href = '{{ route('search') }}' + '/filter?'
    href += '&order=' + id;
    document.location.href = href;
    //alert(id);
}


var slider = $('.range-slider');
slider.on("change", function() {
    category_id = $("#category_id").val();
    var slider = $(".range-slider").data("ionRangeSlider");
    var irsfrom = slider.result.from;
    var irsto = slider.result.to;
    //alert(irsto);alert(irsfrom);
    $.ajax({
        url: '{{route('pricesearch')}}',
        type: "GET",
        data: {
            irsfrom: irsfrom,
            irsto: irsto,
            category_id: category_id
        },
        success: function(result) {
            $("#shop-products").html(result);
        }
    });

});
</script>

<script type="text/javascript">
    (function() {
      if (!localStorage.getItem('cookieconsent')) {
        document.body.innerHTML += '\
        <div class="cookieConsentContainer cookieconsent" id="cookieConsentContainer" style="opacity: 1; display: block;"><div class="cookieTitle"><a>Cookies.</a></div><div class="cookieDesc"><p>Wir speichern nur notwendige Sessioncookies die zum Betrieb der Webseite notwendig sind, die nach Ihrem Besuch gelöscht werden. </p></div><div class="cookieButton"><a href="javascript:;" class="closecookie">Einverstanden</a></div></div>\
        ';  
        document.querySelector('.closecookie').onclick = function(e) {
          e.preventDefault();
          document.querySelector('.cookieconsent').style.display = 'none';
          localStorage.setItem('cookieconsent', true);
        };
      }
    })();  
  </script>