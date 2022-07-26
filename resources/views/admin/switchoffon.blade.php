@extends('admin.layouts.app')

@section('content')
<style>
    .switchSushul[type=checkbox] {
      position: relative;
      margin-top: -0.05em;
      width: 4.6rem;
      height: 2rem;
      outline: none;
      border: none;
      border-radius: 0.3rem;
      background-color: #bfccd9;
      cursor: pointer;
      transition: 0.2s;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background-color: red;
    }
    .switchSushul[type=checkbox]::after {
      position: absolute;
      top: 0.2rem;
      right: 0.2rem;
      width: 2.1rem;
      height: 1.6rem;
      border-radius: 0.2rem;
      background: #fff no-repeat url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 15 15'%3E%3Cpolygon fill='%2324A148' points='12.756 3.162 6.049 9.869 2.38 6.964 1.003 8.706 5.447 12.224 6.223 12.838 14.33 4.73'/%3E%3C/svg%3E%0A");
      
      background-position: center;
      background-size: 0;
      content: "";
      transition: 0.1s transform, 0.2s background cubic-bezier(0.78, 0.96, 0.49, 2.29);
      transform: translateX(-2.1rem);
    }
    .switchSushul[type=checkbox]:checked {
      background-color: #24a148;
    }

    .switchSushul[type=checkbox]:checked::after {
      background-size: 1.5rem;
      transform: translateY(0);
    }

</style>
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
                        <span id="onsavealert"></span>
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
                        <form id="myForm" action="{{route('changestatus')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @php $x = 1; @endphp
                                @forelse ($company as $info)
                                    <div class="card card-secondary @if ($x != 1) collapsed-card @endif">
                                        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                                            <h3 class="card-title">
                                                {{$info->name}}
                                            </h3>
                                            <div class="card-tools">
                                            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                                @if ($x != 1) <i class="fas fa-plus"></i> @else <i class="fas fa-minus"></i> @endif
                                            </button>
                                            </div>
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

                                                            {{-- <input name="brand_id_{{$brand_company->id}}" type="checkbox"  @if(DB::table('brand_company')->where('company_id',$info->id)->where('brand_id',$brandinfo->id)->where('status','enabled')->exists()) checked  @endif data-bootstrap-switch data-off-color="danger" data-on-color="success" id="brand_company_status-{{ $brand_company->id }}"> --}}

                                                            <input name="brand_id_{{$brand_company->id}}" type="checkbox" class="switchSushul disableSave" @if(DB::table('brand_company')->where('company_id',$info->id)->where('brand_id',$brandinfo->id)->where('status','enabled')->exists()) checked  @endif  id="brand_company_status-{{ $brand_company->id }}">


                                                        </div>
                                                    </div>
                                                @empty
                                                    
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                @php
                                    $x++;
                                @endphp
                            @empty
                                
                            @endforelse
                            <div class="card-footer">
                                <button disabled type="submit" class="btn btn-primary">Submit</button>
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
    $('.disableSave').click(function(e) {
        $("#myForm").find(':input[type=submit]').prop('disabled', false);
    });
    $(document).ready(function(){
        $('#myForm').on('submit', function(e){
            // $(this).find(':input[type=submit]').prop('disabled', true);
            e.preventDefault();
            var datastring = $("#myForm").serialize();
            $.ajax({
                type: "POST",
                url: '{{route('changestatus')}}',
                data: datastring,
                dataType: "json",
                success: function(data) {
                    if(data == 1){
                        $('#onsavealert').html('<p class="alert alert-success">{{ __("messages.Status has been Updated") }}.</p>');
                    }
                    if(data == 0){
                        $('#onsavealert').html('<p class="alert alert-danger">{{ __("messages.Something Went Wrong") }}.</p>');
                    }
                    window.scrollTo(0, 0);
                    $("#myForm").find(':input[type=submit]').prop('disabled', true);
                    window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                        });
                    }, 4000);
                },
                error: function() {
                    alert('error handling here');
                }
            });
        });
    });
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
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
</script>
@endsection