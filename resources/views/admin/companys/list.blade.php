@extends('admin.layouts.app')

@section('content')
<style>
    @media screen and (min-width: 480px) {
        span#hideandshowtoggle {
            margin-right: 43px;
        }
    }
</style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="">{{ __('messages.'.$heading) }} </h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
          {{-- @can('company-create')
            <a href="{{route($add_action)}}" class="btn btn-primary"><i class="fas fa-plus"></i> {{ __('messages.Add') }} {{ __('messages.'.$heading) }} </a>
            @endcan --}}
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
                    @if (count($errors) > 0)
                       <div class="alert alert-danger">
                           <ul>
                               @foreach ($errors->all() as $error)
                                   <li>{{ $error }}</li>
                               @endforeach
                           </ul>
                       </div>
                   @endif
                   

                   <div class="card-header">
                     
                    <h3 class="card-title"></h3>

                    <div class="card-tools">
                    <form action="{{ route($search_action) }}" method="get">
                    <div class="input-group input-group-sm" style="width: 310px;">
                   
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
                    <section class="card">
                        <div class="">
                            <div class="card-body row">
                                <form class="col-md-8" method="post" action="{{ route('company_add') }}" id="form_add" enctype="multipart/form-data">
                                @csrf
                                <div @if (count($errors) > 0) @else style="display: none;" @endif id="removehideandshow" class="row">
                                    <div class="col-md-1">
                                        {{-- <label class=" control-label">{{ __('messages.Enter Business Title') }}*</label> --}}
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <input placeholder="Enter Business Title" maxlength="30" minlength="3" autofocus type="text" class="form-control" name="name1"   value="{{old('name1',$data1->name) }}" />
                                    </div>
                                    <div class="col-sm-2 form-group">                                                               
                                        @if($data1->id=="")
                                        <a href="#" onclick="document.getElementById('form_add').reset(); document.getElementById('form_add').value = null; return false;" class="btn btn-warning text-light reset">
                                            <i class="fas fa-sync-alt"></i>
                                            {{-- {{ __('messages.Reset') }} --}}
                                        </a>
                                                {{-- <input type="submit" class="btn btn-primary" name="submit" value="{{ __('messages.Add') }}" /> --}}
                                                <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                        @else
                                        <a href="#" onclick="document.getElementById('form_add').reset(); document.getElementById('form_add').value = null; return false;" class="btn btn-warning text-light">
                                            {{-- {{ __('messages.Reset') }} --}}
                                            <i class="fas fa-sync-alt"></i>
                                        </a>
                                        {{-- <input type="submit" class="btn btn-primary" name="submit" value="{{ __('messages.Update') }}" /> --}}
                                        <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                        @endif
                                    </div>
                                </div>
                                </form>
                                <div class="col-sm-3 form-group">
                                    <div class="text-right">
                                        <span class="btn btn-primary" id="hideandshowtoggle">Add Business</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                   
                        <table class="table table-striped table-bodered table-head-fixed table-sm">
                        <thead>
                            <tr>
							<th>#</th>

                            <th>@sortablelink('name',__('messages.Title'))</th>
                            <th>@sortablelink('created_at', __('messages.Created Date'))</th>
                            <th>@sortablelink('updated_at', __('messages.Updated Date'))</th>
                            <!--<th>@sortablelink('created_at','Created Date')</th>-->
                            <th>{{ __('messages.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($data->count() > 0)    
                                                    @foreach ($data as $key =>$info)
                                                    
                                                    <form class="" method="post" action="{{ route('company_edit',['id'=>$info->id]) }}" id="form_add" enctype="multipart/form-data">
                                                        @csrf
                                                        <tr>
                            <td>{{ $data->firstItem() + $key  }}</td>                            
                                                    <td>
                                                        <input maxlength="30" minlength="3" type="text" name="name" class="form-control" readonly value="{{ $info->name }}" id="FreeToUpdate{{ $info->id }}"></td>
                                                    </td>
                            <td>{{ $info->created_at }}</td>
                                <td>{{ $info->updated_at }}</td>
                           <!-- <td>{{date('d-M  Y',strtotime($info->created_at))}}</td>-->
                            <td>
                            <div class="btn-group">
                            @can('company-edit')
                                {{-- <a class="btn btn-sm btn-primary" href="{{route($edit_action,['id'=>$info->id])}}"><i class="fa fas fa-edit"></i></a> --}}
                                
                            <button type="button" class="btn btn-warning btn-sm text-light mr-1" onclick="freeToEditable({{$info->id}});">
                                <i class="fa fas fa-edit"></i>
                            </button>

                            <button disabled type="submit" class="btn btn-sm btn-primary mr-1" id="onsubmit_Save_pns{{$info->id}}">
                                <i class="fa fas fa-save"></i>
                            </button>

                           @endcan
                               
                                <a onclick="return confirm('{{ __('messages.Are You Sure, You Want To change status') }} {{$info->title}} ?');" class="btn btn-sm {{ ($info->status == 'enabled') ? 'btn-success' :  'btn-danger' }}  changestatus" href="{{ route($status_action, ['id'=>$info->id , 'status' => $info->status ]) }}"  title="{{ ($info->status == 'enabled') ? 'Disable' :  'Enable' }}" >
                                <i class="fa fas fa-check"></i>
                                </a>
                                @can('company-delete')
                               <!-- <a onclick="return confirm('{{ __('messages.Are You Sure, You Want To Delete') }} {{$info->title}} ?');" class="btn btn-sm btn-danger" href="{{route($delete_action, ['id'=>$info->id] )}}"><i class="fa fas fa-trash-alt" title="Delete" ></i></a>-->
                                @endcan
                            </div>
                            </td>
                            </tr>
                        </form>
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
<script>
      $(document).ready(function(){
        $("#hideandshowtoggle").click(function(){
            $("#removehideandshow").toggle(function() {
   $(this).animate({ 
     // style change
   }, 500);
   },
   function() {
   $(this).animate({ 
     // style change back
   }, 500);
 });
        });
    });  
    function freeToEditable(id){
        $("#imageUploadNew-"+id).css("display", "block");
        $("#FreeToUpdate"+id).prop("readonly", false);
        $("#onsubmit_Save_pns"+id).prop('disabled', false);
    }
</script>

@endsection