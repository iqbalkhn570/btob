@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> {{ __('messages.KK Turn ON/OFF') }}</h1>
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
                            @if($company->count()>0)
                            @foreach($company as $key=>$info)
                            <div class="card card-secondary">
                                    <header class="card-header">{{$info->name}}</header>
                         @if($brand->count()>0)
                            @foreach($brand as $brandkey=>$brandinfo)
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4 form-group">
                                                <label class=" control-label">{{$brandinfo->name}}</label>
                                                
                                            </div>
                                            
                                        <div class="col-sm-4 form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    </div>
                                                    <input type="checkbox" name="qq_status"  @if($setting->qq_status=="on") checked  @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                </div>
                                        </div>
                                    </div>
                                    </div>
                                    @endforeach
@endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
@endif
                            <div class="form-group ">
                                <div class="col-sm-12 text-right">
                               
                                <input type="submit" class="btn btn-primary" name="submit" value="{{ __('messages.Submit') }}" />
                               
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
