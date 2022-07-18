@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> {{ __('messages.Setting') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

        <section class="card">
             
              <div class="card-body">
                <div class="tab-content" >
                    <div id="info" class="tab-pane active ">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ __('messages.'.Session::get('message')) }}.</p>
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
                        <form action="{{route('setting')}}" method="post" id="setting_form" autocomplete="off" enctype="multipart/form-data">
                            
                            @csrf
                            
                            <div class="card card-secondary">
                                    
                                <header class="card-header">{{ __('messages.Contact Info') }}</header>
                                <div class="card-body">
                                    <div class=" row">
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label"> {{ __('messages.Address line') }} 1*</label>
                                            <input type="text" class="form-control" name="contact_address1" id="contact_address1" placeholder="Flat/building, street number" value="{{old('contact_address1',$setting->contact_address1) }}"  />
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label"> {{ __('messages.Address line') }} 2</label>
                                            <input type="text" class="form-control" name="contact_address2"  value="{{old('contact_address2',$setting->contact_address2) }}" />
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class=" control-label">{{ __('messages.City') }}*</label>
                                            <input type="text" class="form-control" name="contact_city" id="contact_city" value="{{old('contact_city',$setting->contact_city) }}"  />
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class=" control-label">{{ __('messages.Province') }}*</label>
                                            <input type="text" class="form-control" name="contact_province" id="contact_province" value="{{old('contact_province',$setting->contact_province) }}" />
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class=" control-label">{{ __('messages.Country') }}</label>
                                            <input type="text" class="form-control" name="contact_country"  value="{{old('contact_country',$setting->contact_country) }}"  />
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class=" control-label">{{ __('messages.Zip Code') }}</label>
                                            <input type="text" class="form-control ziprangeCA" name="contact_zip"  value="{{old('contact_zip',$setting->contact_zip) }}" />
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-sm-6 form-group">
                                            <label class=" control-label"> {{ __('messages.Contact Phone Number') }} 1</label>
                                            <input type="text" class="form-control" name="contact_phone1"  value="{{old('contact_phone1',$setting->contact_phone1) }}" />
                                        </div>
                                    
                                        <div class="col-sm-6 form-group">
                                            <label class=" control-label"> {{ __('messages.Contact Phone Number') }} 2</label>
                                            <input type="text" class="form-control" name="contact_phone2"  value="{{old('contact_phone2',$setting->contact_phone2) }}" />
                                            
                                        </div>
                                    </div>
                                    </div>
                            </div>
                            <div class="card card-secondary">
                                    
                                <header class="card-header">{{ __('messages.Email Address') }}</header>
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <label class=" control-label">{{ __('messages.Admin Email Id') }}</label>
                                        <input type="text" class="form-control email" name="admin_email_id"  value="{{old('admin_email_id',$setting->admin_email_id) }}" required/>
                                        <help>{{ __('messages.This email is used for enquiry and cc for all mails') }}. </help>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <label class=" control-label">{{ __('messages.Contact Email Id') }}</label>
                                        <input  class="form-control email" name="contact_email_id" value="{{old('contact_email_id',$setting->contact_email_id) }}" >
                                        <help>{{ __('messages.This email is used for contact form') }}. </help>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label">{{ __('messages.General Email Id') }}</label>
                                            <input class="form-control email" name="general_email_id" value="{{old('general_email_id', $setting->general_email_id) }}"  >
                                            <help>{{ __('messages.This email is used for customer registration & password recovery') }}. </help>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-secondary">
                                    
                                <header class="card-header">{{ __('messages.Website Info') }}</header>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label">{{ __('messages.Website Name') }}</label>
                                            <input type="text" class="form-control" name="website_name"  value="{{old('website_name',$setting->website_name) }}" required/>
                                        </div>
                                    </div>
                                
                                    <div class=" clearfix row">
                                        <div class="col-sm-8 form-group">
                                            <label class=" control-label">Logo{{ __('messages.Setting') }}</label>
                                            <input type="file" class="" name="logo"  />
                                            <p class="help-block">{{ __('messages.Upload max 1mb image file') }}.</p>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            @if($setting->logo)
                                                <img src="{{ asset('public/frontend/images/'.$setting->logo) }}" width="120"/>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-secondary">
                                    
                                    <header class="card-header">{{ __('messages.Website Meta Info') }}</header>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12 form-group">
                                                <label class=" control-label">{{ __('messages.Meta Title') }}</label>
                                                <input type="text" class="form-control" name="meta_title"  value="{{old('meta_title',$setting->meta_title) }}" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 form-group">
                                                <label class=" control-label">{{ __('messages.Meta Description') }}</label>
                                                <textarea class="form-control" name="meta_description">  {{old('meta_description',$setting->meta_description) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 form-group">
                                                <label class=" control-label">{{ __('messages.Meta Keyword') }}</label>
                                                <textarea class="form-control" name="meta_keywords">  {{old('meta_keywords',$setting->meta_keywords) }}</textarea>
                                            </div>
                                        </div>
                                    
                                        
                                    </div>
                                </div>
                            <div class="card card-secondary">
                                    
                                    <header class="card-header">Social Media Links{{ __('messages.Setting') }}</header>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.QQ ID') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-qq"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control url" name="qq_link"  value="{{old('qq_link',$setting->qq_link) }}" />
                                                </div>
                                            </div>
                                            

                                            <div class=" clearfix row">
                                        <div class="col-sm-8 form-group">
                                            <label class=" control-label">{{ __('messages.Icon') }}</label>
                                            <input type="file" name="qq_icon"  />
                                            <p class="help-block">{{ __('messages.Upload max 1mb image file') }}.</p>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            @if($setting->qq_icon)
                                                <img src="{{ asset('public/frontend/images/'.$setting->qq_icon) }}" width="120"/>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Status') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        
                                                    </div>
                                                  
                                                    <input type="checkbox" name="qq_status"  @if($setting->qq_status=="on") checked  @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Skype ID') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-skype"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control url" name="skype_link"  value="{{old('skype_link',$setting->skype_link) }}" />
                                                </div>
                                            </div>
                                            

                                            <div class=" clearfix row">
                                        <div class="col-sm-8 form-group">
                                            <label class=" control-label">{{ __('messages.Icon') }}</label>
                                            <input type="file" name="skype_icon"  />
                                            <p class="help-block">{{ __('messages.Upload max 1mb image file') }}.</p>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            @if($setting->skype_icon)
                                                <img src="{{ asset('public/frontend/images/'.$setting->skype_icon) }}" width="120"/>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Status') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        
                                                    </div>
                                                    <input type="checkbox" name="skype_status" @if($setting->skype_status=="on") checked  @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Telegram ID') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-telegram"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control url" name="telegram_link"  value="{{old('telegram_link',$setting->telegram_link) }}" />
                                                </div>
                                            </div>
                                            

                                            <div class=" clearfix row">
                                        <div class="col-sm-8 form-group">
                                            <label class=" control-label">{{ __('messages.Icon') }}</label>
                                            <input type="file" name="telegram_icon"  />
                                            <p class="help-block">{{ __('messages.Upload max 1mb image file') }}.</p>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            @if($setting->telegram_icon)
                                                <img src="{{ asset('public/frontend/images/'.$setting->telegram_icon) }}" width="120"/>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Status') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        
                                                    </div>
                                                    <input type="checkbox" name="telegram_status" @if($setting->telegram_status=="on") checked  @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.WhatsApp ID') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control url" name="whatsapp_link"  value="{{old('whatsapp_link',$setting->whatsapp_link) }}" />
                                                </div>
                                            </div>
                                            

                                            <div class=" clearfix row">
                                        <div class="col-sm-8 form-group">
                                            <label class=" control-label">{{ __('messages.Icon') }}</label>
                                            <input type="file" name="whatsapp_icon"  />
                                            <p class="help-block">{{ __('messages.Upload max 1mb image file') }}.</p>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            @if($setting->whatsapp_icon)
                                                <img src="{{ asset('public/frontend/images/'.$setting->whatsapp_icon) }}" width="120"/>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Status') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        
                                                    </div>
                                                    <input type="checkbox" name="whatsapp_status" @if($setting->whatsapp_status=="on") checked  @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Facebook') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control url" name="facebook_link"  value="{{old('facebook_link',$setting->facebook_link) }}" />
                                                </div>
                                            </div>
                                            

                                            <div class=" clearfix row">
                                        <div class="col-sm-8 form-group">
                                            <label class=" control-label">{{ __('messages.Icon') }}</label>
                                            <input type="file" name="facebook_icon"  />
                                            <p class="help-block">{{ __('messages.Upload max 1mb image file') }}.</p>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            @if($setting->facebook_icon)
                                                <img src="{{ asset('public/frontend/images/'.$setting->facebook_icon) }}" width="120"/>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Status') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        
                                                    </div>
                                                    <input type="checkbox" name="facebook_status" @if($setting->facebook_status=="on") checked  @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Youtube') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control url" name="youtube_link"  value="{{old('youtube_link',$setting->youtube_link) }}" />
                                                </div>
                                            </div>
                                            

                                            <div class=" clearfix row">
                                        <div class="col-sm-8 form-group">
                                            <label class=" control-label">{{ __('messages.Icon') }}</label>
                                            <input type="file" name="youtube_icon"  />
                                            <p class="help-block">{{ __('messages.Upload max 1mb image file') }}.</p>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            @if($setting->youtube_icon)
                                                <img src="{{ asset('public/frontend/images/'.$setting->youtube_icon) }}" width="120"/>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Status') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        
                                                    </div>
                                                    <input type="checkbox" name="youtube_status" @if($setting->youtube_status=="on") checked  @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Pinterest') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-pinterest"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control url" name="pinterest_link"  value="{{old('pinterest_link',$setting->pinterest_link) }}" />
                                                </div>
                                            </div>
                                            

                                            <div class=" clearfix row">
                                        <div class="col-sm-8 form-group">
                                            <label class=" control-label">{{ __('messages.Icon') }}</label>
                                            <input type="file" name="pinterest_icon"  />
                                            <p class="help-block">{{ __('messages.Upload max 1mb image file') }}.</p>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            @if($setting->pinterest_icon)
                                                <img src="{{ asset('public/frontend/images/'.$setting->pinterest_icon) }}" width="120"/>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Status') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        
                                                    </div>
                                                    <input type="checkbox" name="pinterest_status" @if($setting->pinterest_status=="on") checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Twitter') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control url" name="twitter_link"  value="{{old('twitter_link',$setting->twitter_link) }}" />
                                                </div>
                                            </div>
                                            

                                            <div class=" clearfix row">
                                        <div class="col-sm-8 form-group">
                                            <label class=" control-label">{{ __('messages.Icon') }}</label>
                                            <input type="file" name="twitter_icon"  />
                                            <p class="help-block">{{ __('messages.Upload max 1mb image file') }}.</p>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            @if($setting->twitter_icon)
                                                <img src="{{ asset('public/frontend/images/'.$setting->twitter_icon) }}" width="120"/>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Status') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        
                                                    </div>
                                                    <input type="checkbox" name="twitter_status" @if($setting->twitter_status=="on") checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                </div>
                                        </div>
                                    </div>
                                   
                                
                                <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Instagram') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                                    </div>
                                                    <input type="url" class="form-control url" name="instagram_link"  value="{{old('instagram_link',$setting->instagram_link) }}" />
                                                </div>
                                            </div>
                                            

                                            <div class=" clearfix row">
                                        <div class="col-sm-8 form-group">
                                            <label class=" control-label">{{ __('messages.Icon') }}</label>
                                            <input type="file" name="instagram_icon"  />
                                            <p class="help-block">{{ __('messages.Upload max 1mb image file') }}.</p>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            @if($setting->instagram_icon)
                                                <img src="{{ asset('public/frontend/images/'.$setting->instagram_icon) }}" width="120"/>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{ __('messages.Status') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        
                                                    </div>
                                                    <input type="checkbox" name="instagram_status" @if($setting->instagram_status=="on") checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                                </div>
                            <div class="form-group ">
                                <div class="col-sm-12 text-right">
                                @can('setting-edit')
                                <input type="submit" class="btn btn-primary" name="submit" value="{{ __('messages.Submit') }}" />
                                @endcan
                                </div>
                            </div>

                        </form>
                    </div> <!-- info -->


                </div><!-- tab-content -->

                
              </div><!-- panel-body -->

              
            </section> 

        </div>
    </section>

                             
@endsection

@section('script')
<script> 
    $(function () {
        jQuery.validator.addMethod("ziprangeCA", function(value, element) {
            return this.optional(element) || /[a-zA-Z][0-9][a-zA-Z](-| |)[0-9][a-zA-Z][0-9]/.test(value);
        }, "Your ZIP-code must be for canada like M5H 3R3 or M5H-3R3");

        jQuery.validator.addMethod("zipcodeUS", function(value, element) {
            return this.optional(element) || /\d{5}-\d{4}$|^\d{5}$/.test(value);
        }, "The specified US ZIP Code is invalid");
     $('#setting_form').validate({
        rules: {
        contact_address1: {
            required: true,
        
        },
        contact_city: {
            required: true,
        },
        contact_province: {
            required: true
        },
        contact_country: {
            required: true
        },
        contact_zip: {
            required: true,
            maxlength:8,
            minlength:4
        },
        admin_email_id: {
            required: true,
            email: true
        },
        website_name: {
            required: true
        },
        },
        messages: {
        admin_email_id: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
        },
        contact_zip: {
            required: "Please provide a Postal Code",
            maxlength: "Your zip must be at max 8 digits long",
            minlength: "Your zip must be at atleast 4 digits long"
        },
        contact_address1: "Please enter contact address",
        website_name: "Please enter website name"
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
        }
  });
});
</script>
@endsection