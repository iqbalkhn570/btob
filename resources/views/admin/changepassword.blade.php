@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Change Password</h1>
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
                        <form action="{{route('admin_change_password')}}" method="post" id="change_password_form" autocomplete="off">
                            
                            @csrf
                            
                            <div class="card card-secondary">
                                    
                                <header class="card-header">Change Password</header>
                                <div class="card-body">
                                    <div class=" row">
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label">Current Password*</label>
                                            <input type="password" class="form-control" name="current_password" id="current_password" autocomplete="off"  />
											<input type="hidden" name="hidden_id" value="{{old('id',$profile->id) }}" >
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label">New Password*</label>
                                            <input type="password" class="form-control" name="new_password" id="new_password" />
                                        </div>
										
										<div class="col-sm-12 form-group">
                                            <label class=" control-label">New Confirm Password*</label>
                                            <input type="password" class="form-control" name="new_confirm_password" id="new_confirm_password" />
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
     $('#change_password_form').validate({
    rules: {
    current_password: {
        required: true,
       
      },
      new_password: {
        required: true,
      },
	  new_confirm_password: {
        required: true,
      },
      
      
    },
    messages: {
		current_password: {
        required: "Please enter current password"
        
      },
    new_password: {
        required: "Please enter new password"
      },
	  new_confirm_password: {
        required: "Please enter new confirm password"
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