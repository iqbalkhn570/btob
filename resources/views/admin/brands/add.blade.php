@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
{{-- This comment will not be present in the rendered HTML --}}
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
<!--<a href="{{ url()->previous() }}" class="btn btn-warning" ><i class="fa fa-angle-double-left" ></i>  {{ __('messages.Back') }}</a> -->         </div>
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
                        <label class=" control-label">{{ __('messages.Title') }}*</label>
                        <input maxlength="100" minlength="1" autofocus type="text" class="form-control" name="name" maxlength="255" minlength="1"   value="{{old('name',$data->name) }}" />
                      </div>
                    </div>
                    <div class=" clearfix row">
                                <div class="col-sm-6 form-group ">
                                    <label class=" control-label"> {{ __('messages.Image') }} </label>
                                    <input type="file" class="" name="image" id="image" />
                                    <p class="help-block">{{ __('messages.Upload max 2mb image file') }}.</p>
                                    <p class="help-block">{{ __('messages.Image should be jpeg,png,jpg,gif,svg format') }}.</p>

                                </div>
                                <div class="col-sm-6">
                                    @if($data->image && $data->getBrandImage() )
                                    <img src="{{  $data->getBrandImage() }} " alt="image" class="img-fluid"
                                        style="max-width:140px;" />
                                    @endif
                                </div>

                    </div>
                      <div class=" row">
                        <div class="col-sm-12 form-group text-right">
                          <a href="{{ route($search_action) }}" class="btn btn-warning" ><i class="fa fa-angle-double-left" ></i> {{ __('messages.Back') }}</a> 
                                  
                         
                          
                          @if($data->id=="")
                          <a href="#" onclick="document.getElementById('form_add').reset(); document.getElementById('form_add').value = null; return false;" class="btn btn-secondary reset">{{ __('messages.Reset') }}</a>
                                    <input type="submit" class="btn btn-primary" name="submit" value="{{ __('messages.Submit') }}" />
                    @else
                    <a href="#" onclick="document.getElementById('form_add').reset(); document.getElementById('form_add').value = null; return false;" class="btn btn-secondary">{{ __('messages.Reset') }}</a>
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

<script>
    $(function () {
        $('#form_add').validate({
        rules: {
          name: {
                required: true,
            }
            
        },
        messages: {
          name: {
              required: "{{ __('messages.Please enter a title') }}",
              
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