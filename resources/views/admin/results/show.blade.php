@extends('admin.layouts.app')
@section('style')
<!-- summernote -->
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
                    {{ __('messages.Show') }}
                
                    {{ __('messages.'.$heading) }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
<a href="{{ url()->previous() }}" class="btn btn-warning" ><i class="fa fa-angle-double-left" ></i>  {{ __('messages.Back') }}</a>          </div>
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
                   
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ __('messages.Title') }}:</strong>
               
                {{ $data->name }}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ __('messages.Status') }}:</strong>
                {{ $data->status }}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ __('messages.Created Date') }}:</strong>
                
                {{ $data->created_at }}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{ __('messages.Updated Date') }}:</strong>
                {{ $data->updated_at }}
            </div>
        </div>
    </div>
                      
              </div>
            </section>
          </div>
        </div>
    </section>

                             
@endsection
