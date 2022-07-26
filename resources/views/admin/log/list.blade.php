@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('messages.'.$heading) }} </h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
          @can('log-create')
            <a href="/lottery/admin/user-activity" class="btn btn-primary"><i class="fas fa-plus"></i> User Activities</a>
            @endcan
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
                
        
            <div class="row">
                <div class="col-12">
                  <?php
                if ($search == "Yes") {
                    if (!empty($data[0]->id)) {
                ?>
                        <p class="alert alert-success">{{ __('messages.Record found') }}.</p> 
                <?php } else { ?>
                        <p class="alert alert-warning">{{ __('messages.Record not found') }}.</p>
                <?php }} ?>

                @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ __('messages.'.Session::get('message')) }}.</p>
                    @endif
                    <section class="card">
                    <div class="card-header">
                    
                        <h3 class="card-title"></h3>

                        <div class="card-tools">
                        <form action="{{ route($search_action) }}" method="get">
                        <div class="input-group input-group-sm" style="width: 250px;">
                       
                            <input type="text" name="search_term" class="form-control float-right" placeholder="{{ __('messages.Search by IP') }}" value="{{ app('request')->input('search_term') }}">
                            <input type="text" name="search_term1" class="form-control float-right" placeholder="{{ __('messages.Search by UID') }}" value="{{ app('request')->input('search_term1') }}">

                            <div class="input-group-append">
                            <button type="submit" class="btn btn-default" title="{{ __('messages.Search') }}">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route($search_action) }}" class="btn btn-warning" title="{{ __('messages.Reset') }}">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                            </div>
                        
                        </div>
                        </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                   
                        <table class="table table-striped  table-bodered table-head-fixed table-sm">
                        <thead>
                            <tr>
							<th>#</th>

                            <th>@sortablelink('uid ', __('messages.UID'))</th>
                            <th>@sortablelink('countryName', __('messages.Location'))</th>
                            <th>@sortablelink('source', __('messages.Source'))</th>
                            <th>@sortablelink('ip', __('messages.Latest login IP'))</th>
                            <th>@sortablelink('updated_at', __('messages.Updated Time'))</th>
                                                       <!-- <th>{{ __('messages.Action') }}</th>-->
                            </tr>
                        </thead>
                        <tbody>
    @if($data->count() > 0)
                        @foreach ($data as $key=>$info)
                            <tr>
<td>{{ $data->firstItem() + $key  }}</td>                            <td>{{ $info->Users->name }}</td>
<td>{{ $info->countryName }}</td>
<td>{{ $info->source }}</td>
<td>{{ $info->ip }}</td>
<td>{{ $info->updated_at }}</td>

                            
                            <td>
                            <div class="btn-group">
                                
                               
                            @can('log-delete')
                               <!-- <a onclick="return confirm('{{ __('messages.Are You Sure, You Want To Delete') }} {{$info->name}} ?');" class="btn btn-sm btn-danger" href="{{route($delete_action, ['id'=>$info->id] )}}"><i class="fa fas fa-trash-alt" title="Delete" ></i></a>-->
                           @endcan
                            </div>
                            </td>
                            </tr>
                        @endforeach
                           @else
                                <tr><td colspan="7" class="text-center">{{ __('messages.No record found') }}.</td></tr>
                              @endif
                           
                        </tbody>
                        </table>
                        {{$data->links()}}
                       <!-- pagination pagination-sm pull-right m-sm-1 -->
                    </div>
                    <!-- /.card-body -->
                    </section>
                    <!-- /.card -->
                </div>
                </div>
                <!-- /.row -->
                   

        </div>
    </section>

                             
@endsection

@section('script')


@endsection