@include('frontend.coussau.email.header')
<div>
  <p style="font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:16px; text-align: center; margin-bottom: 15px; margin-top: 0; line-height:1.7; padding-left: 20px; padding-right: 20px;">Hi <b>Admin</b>, We have recieved an information regarding  <b>{{ $coussau_type['name'] }}</b></div>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
  <td><h3 style="font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:24px; text-align: center; margin-bottom: 15px; margin-top: 0; line-height:1.7; padding-left: 20px; padding-right: 20px; color: #019bde;"><b>Information we have received</b> </h3></td>
</tr>
<tr>
<td style="text-align:center"><img src="{{ asset('frontend/images/coussau-email-04.jpg') }}" border="0"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
  <table role=presentation cellspacing="0" cellpadding="0" border="0" width="96%" bgcolor="#ffffff" align="center" style="max-width: 100%; margin: 0 auto; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;">
    <!-- single tr -->
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> Name</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{$customer_name}}</td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> Phone</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{$customer_phone}}</td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> Email</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{$customer_email}}</td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> Enquired For</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{$coussau_type['name']}}</td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> Employement Status</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{ucwords(str_replace('_',' ',$employement_status))}}</td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> Anual Income</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{$your_income}}</td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> Credit Score</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{$your_credit_score}}</td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> Type of Home</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{ucwords(str_replace('_',' ', $property_type))}}</td>
    </tr>
    @if($coussau_type['slug'] == 'new_home')
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> Purchase price?</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{$property_price}}</td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> Down payment</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{$down_payment_percent}}</td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> How do you use this property?</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{ucwords(str_replace('_',' ', $how_you_use_property))}}</td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> Are you a first-time home buyer? </td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{ucwords($are_you_first_time_purchase)}}</td>
    </tr>
    @endif
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> What city is your property in?</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{ucwords($city['name']) .' - '.ucwords($state['name'])}}</td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> When do you want to purchase? </td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{ucwords(str_replace('_',' ', $want_purchase_in)) }}</td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> What amortization term are you looking for? </td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{$coussau_term}}</td>
    </tr>
    @if($coussau_type['slug'] == 'refinance' || $coussau_type['slug'] == 'renew')

    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%"> coussau Balance </td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{$what_is_the_balance_of_your_first_coussau}}</td>
    </tr>
    @endif
    
    
    <tr>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
    </tr>
    <!-- / single tr -->
  </table>
</td></tr>
@include('frontend.coussau.email.footer')
