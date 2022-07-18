@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> {{ __('messages.Undertake Limit Setting') }}</h1>
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
                        
                            
                            <div class="card card-secondary">
                            <header class="card-header">{{ __('messages.General Settings') }}</header>
                            <form action="{{route('undertake_limit')}}" method="post" id="setting_form" autocomplete="off" enctype="multipart/form-data">
                            @csrf 
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                    
                                        </div>
                                        <div class="col-2">
                                        {{ __('messages.USD') }}
                                        </div>
                                        <div class="col-2">
                                        {{ __('messages.MYR') }}
                                        </div>
                                        <div class="col-2">
                                        {{ __('messages.THB') }}
                                        </div>
                                        <div class="col-2">
                                        {{ __('messages.VND') }}
                                        </div>
                                        <div class="col-2">
                                        {{ __('messages.SGD') }}
                                        </div>
                                    </div>
                               
                                    

                                    <div class="row">
                                        <div class="col-2">
                                        <label class=" control-label"> {{ __('messages.Senior Manager undertake limit') }} *</label>
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="sm_u_usd_amnt" id="sm_u_usd_amnt" value="{{old('sm_u_usd_amnt',$setting->sm_u_usd_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="sm_u_myr_amnt" id="sm_u_myr_amnt" value="{{old('sm_u_myr_amnt',$setting->sm_u_myr_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="sm_u_thb_amnt" id="sm_u_thb_amnt" value="{{old('sm_u_thb_amnt',$setting->sm_u_thb_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="sm_u_vnd_amnt" id="sm_u_vnd_amnt" value="{{old('sm_u_vnd_amnt',$setting->sm_u_vnd_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="sm_u_sgd_amnt" id="sm_u_sgd_amnt" value="{{old('sm_u_sgd_amnt',$setting->sm_u_sgd_amnt) }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-2">
                                        <label class=" control-label"> {{ __('messages.Master Agent undertake limit') }} *</label>
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="ma_u_usd_amnt" id="ma_u_usd_amnt" value="{{old('ma_u_usd_amnt',$setting->ma_u_usd_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="ma_u_myr_amnt" id="ma_u_myr_amnt" value="{{old('ma_u_myr_amnt',$setting->ma_u_myr_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="ma_u_thb_amnt" id="ma_u_thb_amnt" value="{{old('ma_u_thb_amnt',$setting->ma_u_thb_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="ma_u_vnd_amnt" id="ma_u_vnd_amnt" value="{{old('ma_u_vnd_amnt',$setting->ma_u_vnd_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="ma_u_sgd_amnt" id="ma_u_sgd_amnt" value="{{old('ma_u_sgd_amnt',$setting->ma_u_sgd_amnt) }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-2">
                                        <label class=" control-label"> {{ __('messages.Agent undertake limit') }} *</label>
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="a_u_usd_amnt" id="a_u_usd_amnt" value="{{old('a_u_usd_amnt',$setting->a_u_usd_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="a_u_myr_amnt" id="a_u_myr_amnt" value="{{old('a_u_myr_amnt',$setting->a_u_myr_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="a_u_thb_amnt" id="a_u_thb_amnt" value="{{old('a_u_thb_amnt',$setting->a_u_thb_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="a_u_vnd_amnt" id="a_u_vnd_amnt" value="{{old('a_u_vnd_amnt',$setting->a_u_vnd_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="a_u_sgd_amnt" id="a_u_sgd_amnt" value="{{old('a_u_sgd_amnt',$setting->a_u_sgd_amnt) }}">
                                        </div>
                                    </div>
                                    

                                </div>
                                <div class="form-group ">
                                    <div class="col-sm-12 text-right">
                                    <a href="#" onclick="document.getElementById('setting_form').reset(); document.getElementById('setting_form').value = null; return false;" class="btn btn-secondary">Reset</a>
                                    @can('setting-edit')
                                    <input type="submit" class="btn btn-primary" name="submit" value="{{ __('messages.Submit') }}" />
                                    @endcan
                                    </div>
                                </div>
                            </form>      
                        </div>
                        
                            <div class="card card-secondary">
                            <header class="card-header">{{ __('messages.Specific Settings') }}</header>
                            <form action="{{route('undertake_limit1')}}" method="post" id="setting_form2" autocomplete="off" enctype="multipart/form-data">
                            @csrf 
                               
                                <div class="card-body">
                                <div class="row">
                                        <div class="col-2">
                                    
                                        </div>
                                        <div class="col-2">
                                        {{ __('messages.USD') }}
                                        </div>
                                        <div class="col-2">
                                        {{ __('messages.MYR') }}
                                        </div>
                                        <div class="col-2">
                                        {{ __('messages.THB') }}
                                        </div>
                                        <div class="col-2">
                                        {{ __('messages.VND') }}
                                        </div>
                                        <div class="col-2">
                                        {{ __('messages.SGD') }}
                                        </div>
                                    </div>
                                   
                                      
                                        @foreach ($setting2 as $key=>$setting)

                                    <div class="row">
                                        <div class="col-2">
                                        <label class=" control-label"> {{ __('messages.Senior Manager undertake limit') }} *</label>
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="sm_u_usd_amnt" id="sm_u_usd_amnt" value="{{old('sm_u_usd_amnt',$setting->sm_u_usd_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="sm_u_myr_amnt" id="sm_u_myr_amnt" value="{{old('sm_u_myr_amnt',$setting->sm_u_myr_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="sm_u_thb_amnt" id="sm_u_thb_amnt" value="{{old('sm_u_thb_amnt',$setting->sm_u_thb_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="sm_u_vnd_amnt" id="sm_u_vnd_amnt" value="{{old('sm_u_vnd_amnt',$setting->sm_u_vnd_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="sm_u_sgd_amnt" id="sm_u_sgd_amnt" value="{{old('sm_u_sgd_amnt',$setting->sm_u_sgd_amnt) }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-2">
                                        <label class=" control-label"> {{ __('messages.Master Agent undertake limit') }} *</label>
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="ma_u_usd_amnt" id="ma_u_usd_amnt" value="{{old('ma_u_usd_amnt',$setting->ma_u_usd_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="ma_u_myr_amnt" id="ma_u_myr_amnt" value="{{old('ma_u_myr_amnt',$setting->ma_u_myr_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="ma_u_thb_amnt" id="c_u_sgma_u_thb_amnt" value="{{old('ma_u_thb_amnt',$setting->ma_u_thb_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="ma_u_vnd_amnt" id="ma_u_vnd_amnt" value="{{old('ma_u_vnd_amnt',$setting->ma_u_vnd_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="ma_u_sgd_amnt" id="ma_u_sgd_amnt" value="{{old('ma_u_sgd_amnt',$setting->ma_u_sgd_amnt) }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-2">
                                        <label class=" control-label"> {{ __('messages.Agent undertake limit') }} *</label>
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="a_u_usd_amnt" id="a_u_usd_amnt" value="{{old('a_u_usd_amnt',$setting->a_u_usd_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="a_u_myr_amnt" id="a_u_myr_amnt" value="{{old('a_u_myr_amnt',$setting->a_u_myr_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="a_u_thb_amnt" id="a_u_thb_amnt" value="{{old('a_u_thb_amnt',$setting->a_u_thb_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="a_u_vnd_amnt" id="a_u_vnd_amnt" value="{{old('a_u_vnd_amnt',$setting->a_u_vnd_amnt) }}">
                                        </div>
                                        <div class="col-2">
                                        <input type="text" class="form-control" name="a_u_sgd_amnt" id="a_u_sgd_amnt" value="{{old('a_u_sgd_amnt',$setting->a_u_sgd_amnt) }}">
                                        </div>
                                    </div> 
                                   
                                    @endforeach
                                </div>
                                <div class="form-group ">
                                <div class="col-sm-12 text-right">
                                <a href="#" onclick="document.getElementById('setting_form2').reset(); document.getElementById('setting_form2').value = null; return false;" class="btn btn-secondary">Reset</a>
                                @can('setting-edit')
                                <input type="submit" class="btn btn-primary" name="submit" value="{{ __('messages.Submit') }}" />
                                @endcan
                                </div>
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