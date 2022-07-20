@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> {{ __('messages.Admin') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <a href="{{route('user_add')}}" class="btn btn-primary"> {{ __('messages.Add Admin') }}</a>
            
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
                    if (!empty($user[0]->id)) {
                ?>
                        <p class="alert alert-success">Record found.</p> 
                <?php } else { ?>
                        <p class="alert alert-warning">Record not found.</p>
                <?php }} ?>

                @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ __('messages.'.Session::get('message')) }}.</p>
                    @endif
                    <section class="card">
                   <!-- <div class="card-header">
                    
                        <h3 class="card-title"></h3>

                        <div class="card-tools">
                        <form action="{{ route('user') }}" method="get">
                        <div class="input-group input-group-sm" style="width: 250px;">
                       
                            <input type="text" name="search_term" class="form-control float-right" placeholder="{{ __('messages.Search') }}" value="{{ app('request')->input('search_term') }}">

                            <div class="input-group-append">
                            <button type="submit" class="btn btn-default" title="{{ __('messages.Search') }}">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('user') }}" class="btn btn-warning" title="{{ __('messages.Reset') }}">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                            </div>
                        
                        </div>
                        </form>
                        </div>
                    </div>-->
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                   
                        <table class="table table-striped">
                        <thead>
                        <tr>
                            
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td> <td></td> <td></td> <td></td>
                              <!--<form>
                              <td>
                              <select class="form-control form-control-sm select2 select2-danger " data-dropdown-css-class="select2-danger" style="width: 100%;" name="role_id">
                              <option value=''>Select</option>
                                @foreach($roles as $role)
                                  <option value="{{$role->id}}" @if($role->id ==  app('request')->input('role_id')) selected="selected" @endif >{{$role->name}}</option>
                                @endforeach
                                </select>
                              </td>
                              <td>
                              <select class="form-control form-control-sm select2 select2-danger " data-dropdown-css-class="select2-danger" style="width: 100%;" name="created_by">
                              <option value=''>Select</option>
                                @foreach($user as $usr)
                                  <option value="{{$usr->id}}" @if($usr->id ==  app('request')->input('created_by')) selected="selected" @endif >{{$usr->name}}</option>
                                @endforeach
                                </select>
                              </td>
                              <td><button class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Search</button>
                              <a class="btn btn-sm btn-warning" href="{{ route('user') }}"><i class="fas fa-sync-alt"></i> Reset</a></td>

                              </form>-->
                              <td colspan="3"><form action="{{ route('user') }}" method="get">
                        <div class="input-group input-group-sm" style="width: 250px;">
                       
                            <input type="text" name="search_term" class="form-control float-right" placeholder="{{ __('messages.Search') }}" value="{{ app('request')->input('search_term') }}">

                            <div class="input-group-append">
                            <button type="submit" class="btn btn-default" title="{{ __('messages.Search') }}">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('user') }}" class="btn btn-warning" title="{{ __('messages.Reset') }}">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                            </div>
                        
                        </div>
                        </form></td>
                </tr>
                            <tr>
							<th>#</th>
                           <!-- <th><i class="fas fa-image"></i></th>-->
                            <th>@sortablelink('name',__('messages.Name'))</th>
                            <th>@sortablelink('email',__('messages.User ID'))</th>
                            <th>@sortablelink('role.name',__('messages.Role'))</th>
                            <th>@sortablelink('created_by', __('messages.Created By'))</th>
                            <th>@sortablelink('created_at',__('messages.Created Date'))</th>
                            <th>@sortablelink('updated_at', __('messages.Updated Date'))</th>
                            <th> {{ __('messages.Last Seen') }}</th>
                            
                            <th>{{ __('messages.Action') }}</th>
                            </tr>
                            
                        </thead>
                        <tbody>
			@if($user->count() > 0)			
                        @foreach ($user as $key=>$usr)
                        <?php 
                            $child_users = DB::select('SELECT * FROM users WHERE created_by =' .$usr->id);
                
               
                ?>
                            <tr data-widget="expandable-table" aria-expanded="false">
							<td> @if(!empty($child_users))      <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>@endif {{ $user->firstItem() + $key  }}</td>
                           <!-- <td>@if($usr->image)<img src="{{ asset('public/admin/images/user/'.$usr->image) }}" width="70"/>@endif</td>-->
                            <td>{{ $usr->name }}</td>
							              <td>{{ $usr->email }}</td>
                            <td> @if($usr->role()->count()){{ $usr->role->name }}@endif</td>
                            <td> @if($usr->parent()->count()){{ $usr->parent->name }}@endif</td>
                            <td>{{date('d-M  Y',strtotime($usr->created_at))}}</td>
                            <td>{{date('d-M  Y',strtotime($usr->updated_at))}}</td>
                            <td>
                                            @if(Cache::has('user-is-online-' . $usr->id))
                                                <span class="text-success">Online</span>
                                            @else
                                                <span class="text-secondary">Offline ({{ \Carbon\Carbon::parse($usr->last_seen)->diffForHumans() }})</span>
                                            @endif
                                        </td>
                                       
                            
                            <td>
                            <div class="btn-group">
                                <a class="btn btn-sm btn-primary" href="{{route('user_edit',['user_id'=>$usr->id])}}"><i class="fa fas fa-edit"></i></a>
                           
                                &nbsp;
                                <a onclick="return confirm('Are You Sure, You Want To change status {{$usr->name}} ?');" class="btn btn-sm {{ ($usr->status == 'enabled') ? 'btn-success' :  'btn-danger' }}  changestatus" href="{{ route('admin_user_changeStatus', ['id'=>$usr->id , 'status' => $usr->status ]) }}"  title="{{ ($usr->status == 'enabled') ? 'Disable' :  'Enable' }}" >
                                <i class="fa fas fa-check"></i>
                                </a>
                                &nbsp;
                                <a onclick="return confirm('Are You Sure, You Want To Delete {{$usr->name}} ?');" class="btn btn-sm btn-danger" href="{{route('admin_user_delete', ['id'=>$usr->id] )}}"><i class="fa fas fa-trash-alt" title="Delete" ></i></a>
                                &nbsp;
                                @if(Auth::user()->role_id==1)
                                <a onclick="return confirm('Are You Sure, You Want To Reset Google 2FA for {{$usr->name}} ?');" class="btn btn-sm btn-danger" href="{{route('admin_user_reset', ['id'=>$usr->id] )}}"><i class="fas fa-sync-alt" title="Reset Google 2FA" ></i></a>
                                &nbsp;
                               
                                <a onclick="return confirm('Are You Sure, You Want To Force Delete {{$usr->name}} ?');" class="btn btn-sm btn-danger" href="{{route('admin_user_force_delete', ['id'=>$usr->id] )}}">Force Delate</a>
                                &nbsp;
                                @if($usr->deleted_at!="")			
                                <a onclick="return confirm('Are You Sure, You Want To Restore {{$usr->name}} ?');" class="btn btn-sm btn-danger" href="{{route('admin_user_restore', ['id'=>$usr->id] )}}">Restore</a>
                                @endif
                                @endif
                            </div>
                            </td>
                            </tr>
                           
                            @if(!empty($child_users)) 
                            <tr class="expandable-body">
      <td colspan="10">
      
        <p>
      
        <table class="table table-striped">
                                      <tbody>
                                      @foreach ($child_users as $key=>$child_user)
                                     @php 
                                     $u = DB::table('users')->where('id', $child_user->created_by)->first();
                                     $r = DB::table('roles')->where('id', $child_user->role_id)->first();
                                      @endphp
                                        <tr>
                                        <td>#</td>
                            <!--<td>@if($child_user->image)<img src="{{ asset('public/admin/images/user/'.$child_user->image) }}" width="70"/>@endif</td>-->
                            <td>{{ $child_user->name }}</td>
							              <td>{{ $child_user->email }}</td>
                            <td> {{ $r->name }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{date('d-M  Y',strtotime($child_user->created_at))}}</td>
                            <td>{{date('d-M  Y',strtotime($child_user->updated_at))}}</td>
                            <td>
                            <div class="btn-group">
                                <a class="btn btn-sm btn-primary" href="{{route('user_edit',['user_id'=>$child_user->id])}}"><i class="fa fas fa-edit"></i></a>
                           
                                &nbsp;
                                <a onclick="return confirm('Are You Sure, You Want To change status {{$child_user->name}} ?');" class="btn btn-sm {{ ($child_user->status == 'enabled') ? 'btn-success' :  'btn-danger' }}  changestatus" href="{{ route('admin_user_changeStatus', ['id'=>$child_user->id , 'status' => $child_user->status ]) }}"  title="{{ ($child_user->status == 'enabled') ? 'Disable' :  'Enable' }}" >
                                <i class="fa fas fa-check"></i>
                                </a>&nbsp;
                                <a onclick="return confirm('Are You Sure, You Want To Delete {{$child_user->name}} ?');" class="btn btn-sm btn-danger" href="{{route('admin_user_delete', ['id'=>$child_user->id] )}}"><i class="fa fas fa-trash-alt" title="Delete" ></i></a>
                                &nbsp;
                                @if(Auth::user()->role_id==1 || Auth::user()->role_id==2)
                                <!--<a onclick="return confirm('Are You Sure, You Want To Force Delete {{$child_user->name}} ?');" class="btn btn-sm btn-danger" href="{{route('admin_user_force_delete', ['id'=>$child_user->id] )}}">Force Delete</a>-->
                                &nbsp;
                                @if($child_user->deleted_at!="")			
                                <a onclick="return confirm('Are You Sure, You Want To Restore {{$child_user->name}} ?');" class="btn btn-sm btn-danger" href="{{route('admin_user_restore', ['id'=>$child_user->id] )}}">Restore</a>
                                @endif
                                @endif
                            </div>
                            </td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                   
        </p>
      </td>
    </tr>
    @endif

                            

                        @endforeach
                         @else
                                <tr><td colspan="9" class="text-center">No record found.</td></tr>
                              @endif
                             
                        </tbody>
                        </table>
                        {{$user->links()}}

                        
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
    $(function () {
      
      $('.select2').select2();
    });
   </script>
@endsection