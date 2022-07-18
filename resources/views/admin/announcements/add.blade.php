@extends('admin.layouts.app')
@section('style')
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
<a href="{{ url()->previous() }}" class="btn btn-warning" ><i class="fa fa-angle-double-left" ></i> Back</a>          </div>
        </div>
      </div>
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
                        <input autofocus type="text" class="form-control" name="name"   value="{{old('name',$data->name) }}" />
                      </div>
                    </div>
                    <div class=" row">
                        <div class="col-sm-12 form-group">
                            <label class=" control-label"> {{ __('messages.Description') }} ({{ __('messages.English') }})*</label>
                            <textarea class="form-control" name="content" id="content" >{{old('content',$data->content) }}</textarea>
                            
                    </div>
                    </div>
                    <div class=" row">
                        <div class="col-sm-12 form-group">
                            <label class=" control-label"> {{ __('messages.Description') }} ({{ __('messages.Chinese') }})*</label>
                            <textarea class="form-control" name="content_chinese" id="content_chinese" >{{old('content_chinese',$data->content_chinese) }}</textarea>
                            
                    </div>
                    </div>
                    <div class=" row">
                        <div class="col-sm-12 form-group">
                            <label class=" control-label"> {{ __('messages.Description') }} ({{ __('messages.Thai') }})*</label>
                            <textarea class="form-control" name="content_thai" id="content_thai" >{{old('content_thai',$data->content_thai) }}</textarea>
                            
                    </div>
                    </div>
                    <div class=" row">
                        <div class="col-sm-12 form-group">
                            <label class=" control-label"> {{ __('messages.Description') }} ({{ __('messages.Khmer') }})*</label>
                            <textarea class="form-control" name="content_khmer" id="content_khmer" >{{old('content_khmer',$data->content_khmer) }}</textarea>
                            
                    </div>
                    </div>
                    <div class=" row">
                        <div class="col-sm-12 form-group">
                            <label class=" control-label"> {{ __('messages.Description') }} ({{ __('messages.Viet') }})*</label>
                            <textarea class="form-control" name="content_viet" id="content_viet" >{{old('content_viet',$data->content_viet) }}</textarea>
                            
                    </div>
                    </div>
                    <div class=" row">
                        <div class="col-sm-12 form-group">
                            <label class=" control-label"> {{ __('messages.Description') }} ({{ __('messages.Korean') }})*</label>
                            <textarea class="form-control" name="content_korean" id="content_korean" >{{old('content_korean',$data->content_korean) }}</textarea>
                            
                    </div>
                    </div>
										
 

 

					

                    
                  
                
                     
                      <div class=" row">
                        <div class="col-sm-12 form-group text-right">
                                                    <a href="{{ route($search_action) }}" class="btn btn-warning" ><i class="fa fa-angle-double-left" ></i> {{ __('messages.Back') }}</a>          

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

<script>
    $(function () {
        // Summernote
        $('#content').summernote({
            tabsize:2,
            height:250
        });
        $('#content_chinese').summernote({
            tabsize:2,
            height:250
        });
        $('#content_thai').summernote({
            tabsize:2,
            height:250
        });
        $('#content_khmer').summernote({
            tabsize:2,
            height:250
        });
        $('#content_viet').summernote({
            tabsize:2,
            height:250
        });
        $('#content_korean').summernote({
            tabsize:2,
            height:250
        });


        $('#form_add').validate({
        rules: {
          name: {
                required: true,
            
            },
            content: {
               required: true,
            }
        },
        messages: {
          name: {
              required: "Please enter title",
              
          },
          content: {
              required: "Please enter  content",
              
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