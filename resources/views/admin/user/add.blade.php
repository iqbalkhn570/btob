@extends('admin.layouts.app')
@section('style')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')

<?php
//echo "<pre>";
//print_r($role[0]['role']);die;
//ini_set('memory_limit', '-1');
//print_r($role->role); 
?>   
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                @if($user->id=="")
                   {{ __('messages.Add') }}
                    @else
                        {{ __('messages.Edit') }}
                    @endif
                    {{ __('messages.Admin') }}</h1>
            </div><!-- /.col -->

            <div class="col-sm-6 text-right">
                <!--<a href="{{ route('user') }}" class="btn btn-warning" ><i class="fa fa-angle-double-left" ></i> {{ __('messages.Back') }}</a>-->
            </div>
            <!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">


        <div class="row">
            <div class="col-lg-12">
                <section class="card">

                    <div class="card-body">
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ __('messages.'.Session::get('message')) }}</p>
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
                        <form autocomplete="off" class="" method="post" action="" id="user_add" enctype="multipart/form-data">
                            <input autocomplete="false" name="hidden" type="text" style="display:none;">
                            @csrf
                            <div class=" row">
                                <div class="col-sm-12 form-group">
                                    <label class=" control-label">  {{ __('messages.Role') }}*</label>
                                    <select autofocus name="role" id="role" class="form-control" value="{{old('role',$user->role) }}">
                                        <!--<option value="">Select {{ __('messages.Role') }}</option>-->
                                        @foreach ($role as $rl)
                                        <option  @if($rl['id'] == old('role',$user->role_id))selected="selected" @endif value="{{$rl['id']}}">{{$rl['name']}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>

                            <div class=" row">
                                <div class="col-sm-12 form-group">
                                    <label class=" control-label"> {{ __('messages.Name') }} * [{{ __('messages.letters and space only allowed') }}]</label>
                                    <input maxlength="30" minlength="3" type="text" class="form-control" name="name"   value="{{old('name',$user->name) }}" />
                                </div>
                            </div>
                            <div class=" row">
                                <div class="col-sm-12 form-group">
                                    <label class=" control-label"> {{ __('messages.Company ID') }} * [{{ __('messages.letters, numbers, dashes and underscores and not space are allowed') }}]</label>
                                    <input maxlength="30" minlength="3" autocomplete="off" type="text" class="form-control" name="email"   value="{{old('email',$user->email) }}" />
                                </div>
                            </div>
                            <div class=" row">
                                <div class="col-sm-12 form-group">
                                    <label class=" control-label"> {{ __('messages.Contact Number') }} [{{ __('messages.Only numbers allowed') }}]</label>
                                    <input maxlength="30" minlength="3" autocomplete="off" type="text" class="form-control" name="contact_number"   value="{{old('contact_number',$user->contact_number) }}" />
                                </div>
                            </div>
                           <!-- <div class=" row">
                                <div class="col-sm-12 form-group">
                                    <label class=" control-label"> {{ __('messages.Account Balance') }} [{{ __('messages.Only numbers allowed') }}]</label>
                                    <input maxlength="30" minlength="0" type="text" class="form-control" name="account_balance"   value="{{old('account_balance',$user->account_balance) }}" />
                                </div>
                            </div>
                            <div class=" row">
                                <div class="col-sm-12 form-group">
                                    <label class=" control-label"> {{ __('messages.Payment Method') }} </label>
                                    <input maxlength="200" minlength="0" type="text" class="form-control" name="payment_method"   value="{{old('payment_method',$user->payment_method) }}" />
                                </div>
                            </div>
                            <div class=" row">
                                <div class="col-sm-12 form-group">
                                    <label class=" control-label"> {{ __('messages.Payment Account') }} </label>
                                    <input maxlength="30" minlength="0" type="text" class="form-control" name="account_number"   value="{{old('account_number',$user->account_number) }}" />
                                </div>
                            </div>
                            <div class=" row">
                                <div class="col-sm-12 form-group">
                                    <label class=" control-label"> {{ __('messages.IP Address') }} [{{ __('messages.Example') }} 0.0.0.0]</label>
                                    <input autocomplete="off" type="text" class="form-control" name="ip_address"   value="{{old('ip_address',$user->ip_address) }}" />
                                </div>
                            </div>
                            <div class=" row">
                                <div class="col-sm-12 form-group">
                                    <label class=" control-label">  {{ __('messages.Nationality') }}</label>
                                    <select  name="nationality_id" id="nationality" class="form-control" value="{{old('nationality_id',$user->nationality_id) }}">
                                        <option value="">Select {{ __('messages.Nationality') }}</option>
                                        @foreach ($countries as $nl)
                                        <option  @if($nl['id'] == old('nationality_id',$user->nationality_id))selected="selected" @endif value="{{$nl['id']}}">{{$nl['name']}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class=" row">
                                <div class="col-sm-12 form-group">
                                    <label class=" control-label">  {{ __('messages.Current Country') }}</label>
                                    <select  name="current_country_id" id="current_country_id" class="form-control" value="{{old('current_country_id',$user->current_country_id) }}">
                                        <option value="">Select {{ __('messages.Current Country') }}</option>
                                        @foreach ($countries as $cl)
                                        <option  @if($cl['id'] == old('current_country_id',$user->current_country_id))selected="selected" @endif value="{{$cl['id']}}">{{$cl['name']}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>-->

                            
                            <div class=" row">
                                <div class="col-sm-12 form-group">
                                    <label class=" control-label"> {{ __('messages.Password') }} * [{{ __('messages.must have minimum 8 characters') }})] <i class="far fa-eye" id="togglePassword"></i></label>
                                    <input maxlength="30" minlength="3" autocomplete="off" type="password" class="form-control" name="password" id="id_password"   />
                                </div>
                            </div>





                            <!--<div class=" clearfix row">
                                <div class="col-sm-6 form-group ">
                                    <label class=" control-label"> {{ __('messages.Image') }}</label>
                                    <input type="file" class="" name="image" id="image" />
                                    <p class="help-block">{{ __('messages.Upload max 2mb image file') }}.</p>

                                </div>
                                <div class="col-sm-6">
                                    @if($user->image && asset('admin/images/user/'.$user->image)  )
                                    <img src="{{ asset('admin/images/user/'.$user->image) }}" alt="image" class="img-fluid" style="max-width:140px;" />
                                    @endif
                                </div>

                            </div>-->

                            <div class=" row">
                                <div class="col-sm-12 form-group text-right">
                                    <a href="{{ route('user') }}" class="btn btn-warning" ><i class="fa fa-angle-double-left" ></i> {{ __('messages.Back') }}</a>          
                                    <a href="#" onclick="document.getElementById('user_add').reset(); document.getElementById('user_add').value = null; return false;" class="btn btn-secondary">{{ __('messages.Reset') }}</a>
                                    
                                    @if($user->id=="")
                                    <input type="submit" class="btn btn-primary" name="submit" value="{{ __('messages.Submit') }}" />
                    @else
                    <input type="submit" class="btn btn-primary" name="submit" value="{{ __('messages.Update') }}" />
                    @endif
                                </div>
                            </div>

                        </form>

                    </div>


                </section>
            </div>




        </div>
</section>


@endsection

@section('script')
<!-- Summernote -->
<script>
    $(function () {


        $('#user_add').validate({
            rules: {
                role: {
                    required: true,

                },
                name: {
                    required: true,

                },
                email: {
                    required: true,
                   // email: true
                },
               // password: {
                  //  required: true
                //},

            },
            messages: {
                role: {
                    required: "{{ __('messages.Please select a role') }}",

                },
                name: {
                    required: "{{ __('messages.Please enter a name') }}",

                },
                email: {
                    required: "{{ __('messages.Please enter a User ID') }}",

                },
                // password: {
                // required: "Please enter a password",

                //},

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

   
const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>

@endsection