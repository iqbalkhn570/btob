@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('messages.Import') }} {{ __('messages.'.$heading) }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <!-- <a href="{{ url()->previous() }}" class="btn btn-warning" ><i class="fa fa-angle-double-left" ></i> Back</a> -->
          </div><!-- /.col -->
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
                  <form class="" method="post" action="{{route($import_action)}}" id="import" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                   

                  
                
                      <div class=" clearfix row">
                        <div class="col-sm-6 form-group ">
                          <label class=" control-label">{{ __('messages.Select file') }}</label>
                          <input type="file" class="" name="select_file" id="select_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" data-msg="Please browse excel file"/>
                          <p class="help-block">{{ __('messages.Only xls or xlsx files acceptable') }}.</p>
                          <p class="help-block text-bold">{{ __('messages.Please download sample xlsx file for reference, and do not change columns names') }}.</p>
                          
                         
                        </div>
                        <div class="col-sm-6">
                            <a href="{{route($import_sample_action)}}" class="">{{ __('messages.Download Sample xlsx file') }}</a>
                        </div>
                        
                      </div>


                      <div class=" row">
                        <div class="col-sm-12 form-group text-right">
                        <a href="{{ url()->previous() }}" class="btn btn-warning" ><i class="fa fa-angle-double-left" ></i> {{ __('messages.Back') }}</a>          

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

        $('#import').validate({
            rules: {
                
                select_file: {
                    required: true
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