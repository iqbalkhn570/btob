@include('frontend.coussau.email.header')
<div>
  <p style="font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:16px; text-align: center; margin-bottom: 15px; margin-top: 0; line-height:1.7; padding-left: 20px; padding-right: 20px;">Hi <b>{{$name}}</b>, We have received your information regarding <b>Let’s have a talk
</b></div>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
  <td><h3 style="font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:24px; text-align: center; margin-bottom: 15px; margin-top: 0; line-height:1.7; padding-left: 20px; padding-right: 20px; color: #019bde;"><b>Information we have received</b> </h3></td>
</tr>
<tr>
<td style="text-align:center"><img src="{{ asset('public/frontend/images/coussau-email-04.jpg') }}" border="0"></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
  <table role=presentation cellspacing="0" cellpadding="0" border="0" width="96%" bgcolor="#ffffff" align="center" style="max-width: 100%; margin: 0 auto; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;">
    <!-- single tr -->
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%">Your Name</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('public/frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{$name}}</td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%">Your email</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('public/frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{$email}}</td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%">Your Mobile</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('public/frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{$mobile}}</td>
    </tr>
   
    <tr>
      <td style="border-bottom:1px solid #DDDDDD; color: #666666; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="60%">Your Message</td>
      <td><div><a style="display:block; line-height: 1;" href="#" target="_blank"><img src="{{ asset('public/frontend/images/coussau-email-10.jpg') }}" style="display: block;max-width: 100%;line-height: 0; height: auto" border="0"></a></div></td>
      <td style="border-bottom:1px solid #DDDDDD; color: #000000; text-align: left; padding-top:8px; padding-bottom:8px; padding-left: 8px; font-family:Arial, Helvetica, Gill Sans, Lucida, Helvetica Narrow, sans-serif; font-size:14px;" width="35%">{{$usermessage}}</td>
    </tr>
    
    <tr>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
      <td height="30">&nbsp;</td>
    </tr>
    <!-- / single tr -->
  </table>
</td></tr>
@include('frontend.coussau.email.footer')
