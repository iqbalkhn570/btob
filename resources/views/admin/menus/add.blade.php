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
                        <label class=" control-label">{{ __('messages.Title') }}*</label>
                        <input type="text" class="form-control" name="title"   value="{{old('title',$data->title) }}" />
                      </div>
                    </div>
					<div class=" row">
                      <div class="col-sm-12 form-group">
                        <label class=" control-label">{{ __('messages.Parent') }}</label>
<select autofocus name="parent_id" id="parent_id" class="form-control">
  <option value="0" <?php if($data->parent_id==0){ echo "selected";}   ?>>-</option>

						@foreach ($parent_menu as $pm)
  <option value="{{$pm['id']}}" <?php if($pm['id']==$data->parent_id && $data->parent_id!=0){ echo "selected";}   ?>>{{$pm['title']}}</option>
  @endforeach
 
  </select>                      </div>
                    </div>
					<div class=" row">
                      <div class="col-sm-12 form-group">
                        <label class=" control-label">{{ __('messages.Link') }}</label>
                        <input type="text" class="form-control" name="url"   value="{{old('url',$data->url) }}" />
                      </div>
                    </div>
					<div class=" row">
                      <div class="col-sm-12 form-group">
                        <label class=" control-label"> {{ __('messages.Nav Icon') }}</label>
<select name="nav_icon" id="nav_icon" class="form-control">

						@foreach ($nav_icon as $ni)
  <option value="{{$ni['title']}}" <?php if($ni['title']==$data->nav_icon){ echo "selected";}   ?>>{{$ni['title']}}</option>
  @endforeach
 
  </select>                      </div>
                    </div>
					
					

                    
                    <div class=" clearfix row">
                      <div class="col-sm-2 form-group">
                        <label class=" control-label">  {{ __('messages.Position') }}</label>
                        <input min="1" type="number" class="form-control" name="position"  value="{{old('position',$data->position) ?old('position',$data->position) : 1 }}" />
                      </div>
                    </div>

                  
                
                     
                      <div class=" row">
                        <div class="col-sm-12 form-group text-right">
                                                    <a href="{{ route('menu') }}" class="btn btn-warning" ><i class="fa fa-angle-double-left" ></i>  {{ __('messages.Back') }}</a>          
                                                    <a href="#" onclick="document.getElementById('form_add').reset(); document.getElementById('form_add').value = null; return false;" class="btn btn-secondary">{{ __('messages.Reset') }}</a>
                          <input type="submit" class="btn btn-primary" name="submit" value=" {{ __('messages.Submit') }}" />
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
              required: "{{ __('messages.Please enter a title') }}",
              
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