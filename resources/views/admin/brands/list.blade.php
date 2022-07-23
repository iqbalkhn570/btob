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
          @can('brand-create')
          <!--<a class="btn btn-warning pull-right" href="{{route('brand_export')}}"><i class="fa fa-download"></i> {{ __('messages.Export') }}</a>
            <a class="btn btn-primary pull-right" href="{{route('brand_import')}}"><i class="fa fa-upload"></i> {{ __('messages.Import') }}</a>-->
            <a href="{{route($add_action)}}" class="btn btn-primary"><i class="fas fa-plus"></i> {{ __('messages.Add') }} {{ __('messages.'.$heading) }} </a>
            
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
                       
                            <input type="text" name="search_term" class="form-control float-right" placeholder="{{ __('messages.Search') }}" value="{{ app('request')->input('search_term') }}">

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
                   
                        <table class="table table-striped table-bodered table-head-fixed table-sm">
                        <thead>
                            <tr>
							<th>#</th>

                            <th>@sortablelink('name',__('messages.Title'))</th>
                            <th>@sortablelink('name',__('messages.Image'))</th>
                            <th>@sortablelink('created_at', __('messages.Created Date'))</th>
                            <th>@sortablelink('updated_at', __('messages.Updated Date'))</th>
                            <!--<th>@sortablelink('created_at','Created Date')</th>-->
                            <th>{{ __('messages.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
@if($data->count() > 0)    
                        @foreach ($data as $key =>$info)
                            <tr>
<td>{{ $data->firstItem() + $key  }}</td>                            <td>{{ $info->name }}</td>
<td>@if($info->image && $info->getBrandImage() )
                                    <img src="{{  $info->getBrandImage() }} " alt="image" class="img-fluid"
                                        style="max-width:140px;max-height:40px;" />
                                    @endif</td>
<td>{{ $info->created_at }}</td>
                                <td>{{ $info->updated_at }}</td>
                           <!-- <td>{{date('d-M  Y',strtotime($info->created_at))}}</td>-->
                            <td>
                            <div class="btn-group">
                            @can('brand-edit')
                                <a title="{{ __('messages.Edit') }}" class="btn btn-sm btn-primary" href="{{route($edit_action,['id'=>$info->id])}}"><i class="fa fas fa-edit"></i></a>
                           @endcan
                               
                                <a onclick="return confirm('{{ __('messages.Are You Sure, You Want To change status') }} {{$info->name}} ?');" class="btn btn-sm {{ ($info->status == 'enabled') ? 'btn-success' :  'btn-danger' }}  changestatus" href="{{ route($status_action, ['id'=>$info->id , 'status' => $info->status ]) }}"  title="{{ ($info->status == 'enabled') ? 'Disable' :  'Enable' }}" >
                                <i class="fa fas fa-check"></i>
                                </a>
                                @can('brand-delete')
                                <!--<a onclick="return confirm('{{ __('messages.Are You Sure, You Want To Delete') }} {{$info->name}} ?');" class="btn btn-sm btn-danger" href="{{route($delete_action, ['id'=>$info->id] )}}"><i class="fa fas fa-trash-alt" title="{{ __('messages.Delete') }}" ></i></a>-->
                                @endcan
                               <!-- <a title="{{ __('messages.Show') }}" href="{{route($show_action,['id'=>$info->id])}}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                @if(Auth::user()->role_id==1 || Auth::user()->role_id==2)
                                <a onclick="return confirm('Are You Sure, You Want To Force Delete {{$info->name}} ?');" class="btn btn-sm btn-danger" href="{{route('admin_brand_force_delete', ['id'=>$info->id] )}}">Force Delate</a>-->
                                &nbsp;
                                @if($info->deleted_at!="")			
                                <a onclick="return confirm('Are You Sure, You Want To Restore {{$info->name}} ?');" class="btn btn-sm btn-danger" href="{{route('admin_brand_restore', ['id'=>$info->id] )}}">Restore</a>
                                @endif
                                @endif
                            </div>
                            </td>
                            </tr>
                        @endforeach
                         @else
                                <tr><td colspan="5" class="text-center">{{ __('messages.Record not found') }}.</td></tr>
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