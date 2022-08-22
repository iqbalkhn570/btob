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
          <a class="btn btn-warning pull-right" href="{{route('result_export')}}"><i class="fa fa-download"></i> {{ __('messages.Export') }}</a>
            <!--<a class="btn btn-primary pull-right" href="{{route('brand_import')}}"><i class="fa fa-upload"></i> {{ __('messages.Import') }}</a>-->
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
                            <th>@sortablelink('result_date',__('messages.Date'))</th>
                            <th>@sortablelink('reference_number',__('messages.Reference No.'))</th>
                            <th>@sortablelink('prize1',__('messages.Prize1'))</th>
                            <th>@sortablelink('prize2',__('messages.Prize2'))</th>
                            <th>@sortablelink('prize3',__('messages.Prize3'))</th>
                            <th>@sortablelink('special1',__('messages.Special1'))</th>
                            <th>@sortablelink('special2',__('messages.Special2'))</th>
                            <th>@sortablelink('special3',__('messages.Special3'))</th>
                            <th>@sortablelink('special4',__('messages.Special4'))</th>
                            <th>@sortablelink('special5',__('messages.Special5'))</th>
                            <th>@sortablelink('special6',__('messages.Special6'))</th>
                            <th>@sortablelink('special7',__('messages.Special7'))</th>
                            <th>@sortablelink('special8',__('messages.Special8'))</th>
                            <th>@sortablelink('special9',__('messages.Special9'))</th>
                            <th>@sortablelink('special10',__('messages.Special10'))</th>
                            <th>@sortablelink('consolation1',__('messages.Consolation1'))</th>
                            <th>@sortablelink('consolation2',__('messages.Consolation2'))</th>
                            <th>@sortablelink('consolation3',__('messages.Consolation3'))</th>
                            <th>@sortablelink('consolation4',__('messages.Consolation4'))</th>
                            <th>@sortablelink('consolation5',__('messages.Consolation5'))</th>
                            <th>@sortablelink('consolation6',__('messages.Consolation6'))</th>
                            <th>@sortablelink('consolation7',__('messages.Consolation7'))</th>
                            <th>@sortablelink('consolation8',__('messages.Consolation8'))</th>
                            <th>@sortablelink('consolation9',__('messages.Consolation9'))</th>
                            <th>@sortablelink('consolation10',__('messages.Consolation10'))</th>
                            <!--<th>@sortablelink('created_at', __('messages.Created Date'))</th>
                            <th>@sortablelink('updated_at', __('messages.Updated Date'))</th>
                            <th>@sortablelink('created_at','Created Date')</th>
                            <th>{{ __('messages.Action') }}</th>-->
                            </tr>
                            <tr>
                            <form>
                              <td></td>
                              <td></td>
                              <td></td>
                              
                              <td colspan="3">
                              <select class="form-control form-control-sm select2 select2-danger " data-dropdown-css-class="select2-danger" style="width: 100%;" name="product_id">
                              <option value=''> {{ __('messages.Select Product') }}</option>
                                @foreach($products as $product)
                                  <option value="{{$product->id}}" @if($product->id ==  app('request')->input('product_id')) selected="selected" @endif >{{$product->name}}</option>
                                @endforeach
                                </select>
                              </td>
                              <td colspan="3">
                              <select class="form-control form-control-sm select2 select2-danger " data-dropdown-css-class="select2-danger" style="width: 100%;" name="brand_id">
                              <option value=''>{{ __('messages.Select Brand') }}</option>
                                @foreach($brands as $brand)
                                  <option value="{{$brand->id}}" @if($brand->id ==  app('request')->input('brand_id')) selected="selected" @endif >{{$brand->name}}</option>
                                @endforeach
                                </select>
                              </td>
                              <td colspan="3">
                             
<div class="input-group date" id="reservationdate" data-target-input="nearest">
<input type="text" name="date_from" value="{{ app('request')->input('date_from') }}" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="{{ __('messages.Date From') }}" />
<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
<div class="input-group-text"><i class="fa fa-calendar"></i></div>
</div>
</div>

</td>
<td colspan="3">
                             
<div class="input-group date" id="reservationdate1" data-target-input="nearest">
<input type="text" name="date_to" value="{{ app('request')->input('date_to') }}" class="form-control datetimepicker-input" data-target="#reservationdate1" placeholder="{{ __('messages.Date To') }}" />
<div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
<div class="input-group-text"><i class="fa fa-calendar"></i></div>
</div>
</div>

</td>


                              <td colspan="8"><button class="btn btn-sm btn-primary"><i class="fa fa-search"></i> {{ __('messages.Search') }}</button>
                              <a class="btn btn-sm btn-warning" href="{{ route('user') }}"><i class="fas fa-sync-alt"></i>{{ __('messages.Reset') }} </a></td>
                              </form>
                </tr>
                        </thead>
                        <tbody>
@if($data->count() > 0)    
                        @foreach ($data as $key =>$info)
                            <tr>
<td>{{ $data->firstItem() + $key  }}</td>                            
<td>{{ $info->name }}</td>
<td>{{ $info->result_date }}</td>
<td>{{ $info->reference_number }}</td>
<td>{{ $info->prize1 }}</td>
<td>{{ $info->prize2 }}</td>
<td>{{ $info->prize3 }}</td>
<td>{{ $info->special1 }}</td>
<td>{{ $info->special2 }}</td>
<td>{{ $info->special3 }}</td>
<td>{{ $info->special4 }}</td>
<td>{{ $info->special5 }}</td>
<td>{{ $info->special6 }}</td>
<td>{{ $info->special7 }}</td>
<td>{{ $info->special8 }}</td>
<td>{{ $info->special9 }}</td>
<td>{{ $info->special10 }}</td>
<td>{{ $info->consolation1 }}</td>
<td>{{ $info->consolation2 }}</td>
<td>{{ $info->consolation3 }}</td>
<td>{{ $info->consolation4 }}</td>
<td>{{ $info->consolation5 }}</td>
<td>{{ $info->consolation6 }}</td>
<td>{{ $info->consolation7 }}</td>
<td>{{ $info->consolation8 }}</td>
<td>{{ $info->consolation9 }}</td>
<td>{{ $info->consolation10 }}</td>
<!--<td>{{ $info->created_at }}</td>
                                <td>{{ $info->updated_at }}</td>
                            <td>{{date('d-M  Y',strtotime($info->created_at))}}</td>-->
                           <!-- <td>
                            <div class="btn-group">
                            @can('brand-edit')
                                <a title="{{ __('messages.Edit') }}" class="btn btn-sm btn-primary" href="{{route($edit_action,['id'=>$info->id])}}"><i class="fa fas fa-edit"></i></a>
                           @endcan
                               
                                <a onclick="return confirm('{{ __('messages.Are You Sure, You Want To change status') }} {{$info->name}} ?');" class="btn btn-sm {{ ($info->status == 'enabled') ? 'btn-success' :  'btn-danger' }}  changestatus" href="{{ route($status_action, ['id'=>$info->id , 'status' => $info->status ]) }}"  title="{{ ($info->status == 'enabled') ? 'Disable' :  'Enable' }}" >
                                <i class="fa fas fa-check"></i>
                                </a>
                                @can('brand-delete')
                                <a onclick="return confirm('{{ __('messages.Are You Sure, You Want To Delete') }} {{$info->name}} ?');" class="btn btn-sm btn-danger" href="{{route($delete_action, ['id'=>$info->id] )}}"><i class="fa fas fa-trash-alt" title="{{ __('messages.Delete') }}" ></i></a>
                                @endcan
                                <a title="{{ __('messages.Show') }}" href="{{route($show_action,['id'=>$info->id])}}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                @if(Auth::user()->role_id==1 || Auth::user()->role_id==2)
                                <a onclick="return confirm('Are You Sure, You Want To Force Delete {{$info->name}} ?');" class="btn btn-sm btn-danger" href="{{route('admin_brand_force_delete', ['id'=>$info->id] )}}">Force Delate</a>
                                &nbsp;
                                @if($info->deleted_at!="")			
                                <a onclick="return confirm('Are You Sure, You Want To Restore {{$info->name}} ?');" class="btn btn-sm btn-danger" href="{{route('admin_brand_restore', ['id'=>$info->id] )}}">Restore</a>
                                @endif
                                @endif
                            </div>
                            </td>-->
                            </tr>
                        @endforeach
                         @else
                                <tr><td colspan="27" class="text-center">{{ __('messages.Record not found') }}.</td></tr>
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

<script>
     
</script>
@endsection