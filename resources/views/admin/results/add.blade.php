@extends('admin.layouts.app')
@section('style')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
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
                    <div class="col-sm-2 form-group">
                    <label class=" control-label">Result Date*</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
<input type="text" name="fetching_date" value="{{ $data->fetching_date }}" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Result Date" />
<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
<div class="input-group-text"><i class="fa fa-calendar"></i></div>
</div></div>
                      </div>
                      <div class="col-sm-2 form-group">
                      <label class=" control-label">{{ __('messages.Game') }}*</label>
                      <select class="form-control select2" name="brand_id">
                              <option value=''>Select Game</option>
                                @foreach($brands as $brand)
                                  <option value="{{$brand->id}}" @if($brand->id ==  $data->brand_id) selected="selected" @endif >{{$brand->name}}</option>
                                @endforeach
                                </select>
                      </div>
                    <div class="col-sm-2 form-group">
                        <label class=" control-label">{{ __('messages.Reference No.') }}*</label>
                        <input autofocus type="text" class="form-control" name="reference_number"   value="{{old('reference_number',$data->reference_number) }}" />
                      </div>

                      <div class="col-sm-2 form-group">
                        <label class=" control-label">{{ __('messages.Prize1') }}*</label>
                        <input autofocus type="text" class="form-control" name="prize1"   value="{{old('prize1',$data->prize1) }}" />
                      </div>
                      <div class="col-sm-2 form-group">
                        <label class=" control-label">{{ __('messages.Prize2') }}*</label>
                        <input autofocus type="text" class="form-control" name="prize2"   value="{{old('prize2',$data->prize2) }}" />
                      </div>
                      <div class="col-sm-2 form-group">
                        <label class=" control-label">{{ __('messages.Prize3') }}*</label>
                        <input autofocus type="text" class="form-control" name="prize3"   value="{{old('prize3',$data->prize3) }}" />
                      </div>
                      
                    </div>
                    <div class=" row">
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Special1') }}*</label>
                        <input autofocus type="text" class="form-control" name="special1"   value="{{old('special1',$data->special1) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Special2') }}*</label>
                        <input autofocus type="text" class="form-control" name="special2"   value="{{old('special2',$data->special2) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Special3') }}*</label>
                        <input autofocus type="text" class="form-control" name="special3"   value="{{old('special3',$data->special3) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Special4') }}*</label>
                        <input autofocus type="text" class="form-control" name="special4"   value="{{old('special4',$data->special4) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Special5') }}*</label>
                        <input autofocus type="text" class="form-control" name="special5"   value="{{old('special5',$data->special5) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Special6') }}*</label>
                        <input autofocus type="text" class="form-control" name="special6"   value="{{old('special6',$data->special6) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Special7') }}*</label>
                        <input autofocus type="text" class="form-control" name="special7"   value="{{old('special7',$data->special7) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Special8') }}*</label>
                        <input autofocus type="text" class="form-control" name="special8"   value="{{old('special8',$data->special8) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Special9') }}*</label>
                        <input autofocus type="text" class="form-control" name="special9"   value="{{old('special9',$data->special9) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Special10') }}*</label>
                        <input autofocus type="text" class="form-control" name="special10"   value="{{old('special10',$data->special10) }}" />
                      </div>
                    </div>
                    <div class=" row">
                      
                    </div>
                    <div class=" row">
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Consolation1') }}*</label>
                        <input autofocus type="text" class="form-control" name="consolation1"   value="{{old('consolation1',$data->consolation1) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Consolation2') }}*</label>
                        <input autofocus type="text" class="form-control" name="consolation2"   value="{{old('consolation2',$data->consolation2) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Consolation3') }}*</label>
                        <input autofocus type="text" class="form-control" name="consolation3"   value="{{old('consolation3',$data->consolation3) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Consolation4') }}*</label>
                        <input autofocus type="text" class="form-control" name="consolation4"   value="{{old('consolation4',$data->consolation4) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Consolation5') }}*</label>
                        <input autofocus type="text" class="form-control" name="consolation5"   value="{{old('consolation5',$data->consolation5) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Consolation6') }}*</label>
                        <input autofocus type="text" class="form-control" name="consolation6"   value="{{old('consolation6',$data->consolation6) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Consolation7') }}*</label>
                        <input autofocus type="text" class="form-control" name="consolation7"   value="{{old('consolation7',$data->consolation7) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Consolation8') }}*</label>
                        <input autofocus type="text" class="form-control" name="consolation8"   value="{{old('consolation8',$data->consolation8) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Consolation9') }}*</label>
                        <input autofocus type="text" class="form-control" name="consolation9"   value="{{old('consolation9',$data->consolation9) }}" />
                      </div>
                      <div class="col-sm-1 form-group">
                        <label class=" control-label">{{ __('messages.Consolation10') }}*</label>
                        <input autofocus type="text" class="form-control" name="consolation10"   value="{{old('consolation10',$data->consolation10) }}" />
                      </div>
                    </div>
                   
                 
                    
                   
                  
                      <div class=" row">
                        <div class="col-sm-12 form-group text-right">
                          <a href="{{ route($search_action) }}" class="btn btn-warning" ><i class="fa fa-angle-double-left" ></i> {{ __('messages.Back') }}</a> 
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
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(function () {
        $('#form_add').validate({
        rules: {
          fetching_date: {
                required: true,
            },
            brand_id: {
                required: true,
            },
            reference_number: {
                required: true,
            },
            prize1: {
                required: true,
            },
            prize2: {
                required: true,
            },
            prize3: {
                required: true,
            },
            special1: {
                required: true,
            },
            special2: {
                required: true,
            },
            special3: {
                required: true,
            },
            special4: {
                required: true,
            },
            special5: {
                required: true,
            },
            special6: {
                required: true,
            },
            special7: {
                required: true,
            },
            special8: {
                required: true,
            },
            special9: {
                required: true,
            },
            special10: {
                required: true,
            },
            consolation1: {
                required: true,
            },
            consolation2: {
                required: true,
            },
            consolation3: {
                required: true,
            },
            consolation4: {
                required: true,
            },
            consolation5: {
                required: true,
            },
            consolation6: {
                required: true,
            },
            consolation7: {
                required: true,
            },
            consolation8: {
                required: true,
            },
            consolation9: {
                required: true,
            },
            consolation10: {
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