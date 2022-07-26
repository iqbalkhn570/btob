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
          @can('product-create')
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
                            <th>@sortablelink('first_prize_unit',__('messages.First prize unit'))</th>
                            <th>@sortablelink('first_prize_amnt',__('messages.First prize amount'))</th>
                            <th>@sortablelink('second_prize_unit',__('messages.Second prize unit'))</th>
                            <th>@sortablelink('second_prize_amnt',__('messages.Second prize amount'))</th>
                            <th>@sortablelink('third_prize_unit',__('messages.Third prize unit'))</th>
                            <th>@sortablelink('third_prize_amnt',__('messages.Third prize amount'))</th>
                            <th>@sortablelink('special_prize_unit',__('messages.Special prize unit'))</th>
                            <th>@sortablelink('special_prize_amnt',__('messages.Special prize amount'))</th>
                            <th>@sortablelink('consolation_prize_unit',__('messages.Consolation prize unit'))</th>
                            <th>@sortablelink('consolation_prize_amnt',__('messages.Consolation prize amount'))</th>
                            <!--<th>@sortablelink('created_at', __('messages.Created Date'))</th>
                            <th>@sortablelink('updated_at', __('messages.Updated Date'))</th>
                            <th>@sortablelink('created_at','Created Date')</th>-->
                            <th>{{ __('messages.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
@if($data->count() > 0)    
                        @foreach ($data as $key =>$info)
                            <tr>
<td>{{ $data->firstItem() + $key  }}</td>                           
 <td>{{ $info->name }}</td>
 <td>{{ $info->first_prize_unit }}</td>
 <td>{{ $info->first_prize_amnt }}</td>
 <td>{{ $info->second_prize_unit }}</td>
 <td>{{ $info->second_prize_amnt }}</td>
 <td>{{ $info->third_prize_unit }}</td>
 <td>{{ $info->third_prize_amnt }}</td>
 <td>{{ $info->special_prize_unit }}</td>
 <td>{{ $info->special_prize_amnt }}</td>
 <td>{{ $info->consolation_prize_unit }}</td>
 <td>{{ $info->consolation_prize_amnt }}</td>
    <!-- <td>{{ $info->created_at }}</td>
                                <td>{{ $info->updated_at }}</td>
                            <td>{{date('d-M  Y',strtotime($info->created_at))}}</td>-->
                            <td>
                            <div class="btn-group">
                            @can('product-edit')
                                <a class="btn btn-sm btn-primary" href="{{route($edit_action,['id'=>$info->id])}}"><i class="fa fas fa-edit"></i></a>
                           @endcan
                               
                                <a onclick="return confirm('{{ __('messages.Are You Sure, You Want To change status') }} {{$info->title}} ?');" class="btn btn-sm {{ ($info->status == 'enabled') ? 'btn-success' :  'btn-danger' }}  changestatus" href="{{ route($status_action, ['id'=>$info->id , 'status' => $info->status ]) }}"  title="{{ ($info->status == 'enabled') ? 'Disable' :  'Enable' }}" >
                                <i class="fa fas fa-check"></i>
                                </a>
                                @can('product-delete')
                               <!-- <a onclick="return confirm('{{ __('messages.Are You Sure, You Want To Delete') }} {{$info->title}} ?');" class="btn btn-sm btn-danger" href="{{route($delete_action, ['id'=>$info->id] )}}"><i class="fa fas fa-trash-alt" title="Delete" ></i></a>-->
                                @endcan
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