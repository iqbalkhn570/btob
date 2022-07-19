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
                            <!-- form start -->
                        <form action="{{route('changestatus')}}" method="post" id="setting_form" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @forelse ($company as $info)
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h3 class="card-title">{{$info->name}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            @forelse ($brand as $brandinfo)
                                                @php
                                                    $brand_company = DB::table('brand_company')->where('company_id',$info->id)->where('brand_id',$brandinfo->id)->first();
                                                @endphp
                                                <div class="col-md-4 pt-3">
                                                    <label for="brand_company_status-{{ $brand_company->id }}" class=" control-label">{{$brandinfo->name}}</label>
                                                </div>
                                                <div class="col-md-6 pt-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                        </div>
                                                        <input type="hidden" value="{{ $brand_company->id }}" name="brand_company_id[]">
                                                        <input name="brand_id_{{$brand_company->id}}" type="checkbox"  @if(DB::table('brand_company')->where('company_id',$info->id)->where('brand_id',$brandinfo->id)->where('status','enabled')->exists()) checked  @endif data-bootstrap-switch data-off-color="danger" data-on-color="success" id="brand_company_status-{{ $brand_company->id }}">
                                                    </div>
                                                </div>
                                            @empty
                                                
                                            @endforelse
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            @empty
                                
                            @endforelse
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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