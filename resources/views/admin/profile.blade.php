@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profile</h1>
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
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
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
                        <form action="{{route('admin_profile')}}" method="post" id="profile_form" autocomplete="off" enctype="multipart/form-data">
                            
                            @csrf
                            
                            <div class="card card-secondary">
                                    
                                <header class="card-header">Profile Info</header>
                                <div class="card-body">
                                    <div class=" row">
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label">{{ __('messages.Name') }}*</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{old('name',$profile->name) }}"  />
											<input type="hidden" name="hidden_id" value="{{old('id',$profile->id) }}" >
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label">{{ __('messages.Email') }}*</label>
                                            <input disabled autocomplete="off" type="text" class="form-control" name="email" id="email"  value="{{old('email',$profile->email) }}" />
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label">{{ __('messages.Contact Number') }}</label>
                                            <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Name" value="{{old('contact_number',$profile->contact_number) }}"  />
										
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label">{{ __('messages.Account Balance') }}*</label>
                                            <input disabled type="text" class="form-control" name="account_balance" id="account_balance" placeholder="{{ __('messages.Account Balance') }}" value="{{old('account_balance',$profile->account_balance) }}"  />
											
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label">{{ __('messages.Payment Method') }}*</label>
                                            <input disabled type="text" class="form-control" name="payment_method" id="payment_method" placeholder="{{ __('messages.Payment Method') }}" value="{{old('payment_method',$profile->payment_method) }}"  />
										
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label">{{ __('messages.Payment Account') }}*</label>
                                            <input type="text" disabled class="form-control" name="account_number" id="name" placeholder="{{ __('messages.Payment Account') }}" value="{{old('account_number',$profile->account_number) }}"  />
										
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label">{{ __('messages.IP Address') }}*</label>
                                            <input disabled type="text" class="form-control" name="ip_address" id="ip_address" placeholder="{{ __('messages.IP Address') }}" value="{{old('ip_address',$profile->ip_address) }}"  />
										
                                        </div>
                                       
                                        
                                    <div class=" clearfix row">
                                        <div class="col-sm-8 form-group">
                                            <label class=" control-label">{{ __('messages.Image') }}</label>
                                            <input type="file" class="" name="image"  />
                                            <p class="help-block">{{ __('messages.Upload max 2mb image file') }}.</p>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            @if($profile->image)
                                                <img src="{{ asset('/admin/images/user/'.$profile->image) }}" width="120"/>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-sm-12 text-right">
                                
                                <input type="submit" class="btn btn-primary" name="submit" value="Update" />
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
     $('#profile_form').validate({
    rules: {
    name: {
        required: true,
       
      },
      email: {
        required: true,
		email: true
      },
      
    },
    messages: {
		name: {
        required: "Please enter name"
        
      },
    email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      
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