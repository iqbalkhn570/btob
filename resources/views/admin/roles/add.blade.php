@extends('admin.layouts.app')
@section('style')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@if($data->id=="")
                   {{ __('messages.Add') }}
                    @else
                        {{ __('messages.Edit') }}
                    @endif
                    {{ __('messages.'.$heading) }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
<a href="{{ url()->previous() }}" class="btn btn-warning" ><i class="fa fa-angle-double-left" ></i> Back</a>          </div><!-- /.col -->
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
                  <form class="" method="post" action="" id="form_add" enctype="multipart/form-data">
                    @csrf
                    <div class=" row">
                      <div class="col-sm-12 form-group">
                        <label class=" control-label">{{ __('messages.Role Name') }}*</label>
                        <input autofocus type="text" class="form-control" name="name"   value="{{old('name',$data->name) }}" />
                      </div>
                    </div>

					<div class=" row">
					@foreach ($parent_menu as $pm)
					<div class="col-sm-6 form-group">
					<div class="form-check">
              <input class="form-check-input" <?php if(in_array($pm['id'],explode(",",$data->permission_menu))){echo "checked";}  ?> type="checkbox" name="permission_menu[]"   value="{{$pm['id']}}" >
              <label class="form-check-label">{{$pm['title']}}</label><br/>
              <?php 
              $permission = DB::select('SELECT * FROM permissions WHERE menu_id =' . $pm['id']);
?>
 @foreach($permission as $value)
 
                 
                  {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                {{ $value->name }}
              
              @endforeach

          </div>
					</div>
          @endforeach
				</div>
										
                           

 

					

                    
                  
                
                     
                      <div class=" row">
                        <div class="col-sm-12 form-group text-right">
                                                    <a href="{{ route('role') }}" class="btn btn-warning" ><i class="fa fa-angle-double-left" ></i> {{ __('messages.Back') }}</a>          
                                                    <a href="#" onclick="document.getElementById('form_add').reset(); document.getElementById('form_add').value = null; return false;" class="btn btn-secondary">{{ __('messages.Reset') }}</a>
                          <input type="submit" class="btn btn-primary" name="submit" value="{{ __('messages.Submit') }}" />
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
        $('#form_add').validate({
        rules: {
            title: {
                required: true,
            
            },
            position: {
                digits: true
            }
            
        },
        messages: {
          title: {
              required: "Please enter a title",
              
          }
          
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