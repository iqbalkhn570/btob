@extends('admin.layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('public/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/toastr/toastr.min.css') }}">
<style>
.avatar-upload {
  position: relative;
  max-width: 205px;
  /* margin: 50px auto; */
}
.avatar-upload .avatar-edit {
  position: absolute;
  right: 12px;
  z-index: 1;
  top: 10px;
}
.avatar-upload .avatar-edit input {
  display: none;
}
.avatar-upload .avatar-edit input + label {
  display: inline-block;
  width: 34px;
  height: 34px;
  margin-bottom: 0;
  border-radius: 100%;
  background: #FFFFFF;
  border: 1px solid transparent;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
  cursor: pointer;
  font-weight: normal;
  transition: all 0.2s ease-in-out;
}
.avatar-upload .avatar-edit input + label:hover {
  background: #f1f1f1;
  border-color: #d6d6d6;
}
.avatar-upload .avatar-edit input + label:after {
  /* content: "\f040"; */
  font-family: 'FontAwesome';
  color: #757575;
  position: absolute;
  top: 10px;
  left: 0;
  right: 0;
  text-align: center;
  margin: auto;
}
.avatar-upload .avatar-preview {
  width: 192px;
  height: 192px;
  position: relative;
  border-radius: 100%;
  border: 6px solid #F8F8F8;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}
.avatar-upload .avatar-preview > div {
  width: 100%;
  height: 100%;
  border-radius: 100%;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}
.avatar-upload .avatar-edit {
    position: absolute;
    right: 51px;
    z-index: 1;
    top: 10px;
}
.avatar-upload .avatar-preview {
    width: 40px;
    height: 40px;
    position: relative;
    border-radius: 100%;
    border: 6px solid #F8F8F8;
    box-shadow: 0px 2px 4px 0px rgb(0 0 0 / 10%);
} 

@media screen and (min-width: 480px) {
        span#hideandshowtoggle {
            margin-right: 35px;
        }
    }
</style>
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
            {{-- <a href="{{route($add_action)}}" class="btn btn-primary"><i class="fas fa-plus"></i> {{ __('messages.Add') }} {{ __('messages.'.$heading) }} </a> --}}
            
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
                    <section class="card">

                    <div class="row">
                        <div class="col-lg-12">
                          <section class="card">
                            <div class="card-body row">
                                <form class="col-md-8" class="" method="post" action="{{ route('brand_add') }}" id="form_add" enctype="multipart/form-data">
                                  @csrf

                                  <div class="modal fade" id="myModal0" role="dialog">
                                    <div class="modal-dialog">
                                      <!-- Modal content-->
                                      <div class="modal-content">
                                          <div class="modal-body">
                                            <div class="avatar-upload" style="text-align: -webkit-center;max-width: 100%;margin: 50px auto;">
                                              <div class="avatar-edit">
                                                <input onchange="imageUploadFunction(this,0)" type='file' name="image" id="ssimageUpload-0" accept=".png, .jpg, .jpeg" />
                                                <label style=" width: 60px; height: 60px; " id="ssimageUploadNew-0" for="ssimageUpload-0">
                                                  <i style="margin-left: 10px;margin-top: 8px;font-size: 40px;" class="fa fa-edit" ></i>
                                                </label>
                                              </div>
                                              <div class="avatar-preview" style="width: 300px;height: 300px;position: relative;border-radius: 100%;border: 6px solid #F8F8F8;box-shadow: 0px 2px 4px 0px rgb(0 0 0 / 10%);border-radius: 0;">
                                                  <div class="imagePreview-0" id="ssimagePreview-0" style="background-image: url({{ asset('public/admin/samples/choose-image.png') }});border-radius: 0%;"></div>
                                              </div>
                                            </div> 
                                          </div>
                                          <div class="modal-footer">
                                              <p class="help-block">{{ __('messages.Upload max 2mb image file') }}.</p>
                                              <p class="help-block">{{ __('messages.Image should be jpeg,png,jpg,gif,svg format') }}.</p>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div @if (count($errors) > 0) @else style="display: none;" @endif id="removehideandshow" class="row">
                                      <div class="col-md-1">
                                          {{-- <label class=" control-label">{{ __('messages.Enter Business Title') }}*</label> --}}
                                      </div>
                                    <div class="col-sm-6 form-group">
                                      {{-- <label class=" control-label">{{ __('messages.Title') }}*</label> --}}
                                      <input placeholder="Enter Game Title" maxlength="30" minlength="3" autofocus type="text" class="form-control" name="name1" maxlength="255" minlength="1"   value="{{old('name1',$data1->name) }}" />
                                    </div>

                                      <div class="col-md-1 form-group ">

                                        {{-- <label class=" control-label"> {{ __('messages.Image') }} </label> --}}

                                        <div class="avatar-upload">
                                          <div class="avatar-edit" style="right: 0; ">
                                              <label id="imageUploadNew-0"
                                                  data-toggle="modal" data-target="#myModal0">
                                              <i style=" cursor: pointer; " class="fa fa-edit" ></i></label>
                                          </div>
                                          <div class="avatar-preview">
                                              <div id="imagePreview-0" class="imagePreview-0" style="background-image: url({{ asset('public/admin/samples/choose-image.png') }});"></div>
                                          </div>
                                        </div>  
                                      </div>
              
                                      <div class="col-sm-3 form-group">
                                        @if($data1->id=="")
                                            <a href="#" onclick="document.getElementById('form_add').reset(); document.getElementById('form_add').value = null; $('.imagePreview-0').css('background-image', 'url({{ asset('public/admin/samples/choose-image.png') }})');  return false;" class="btn btn-warning text-light reset">
                                              <i class="fas fa-sync-alt"></i>
                                            </a>
                                            <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                                  {{-- <input type="submit" class="btn btn-primary" name="submit" value="{{ __('messages.Submit') }}" /> --}}
                                            @else
                                            <a href="#" onclick="document.getElementById('form_add').reset(); document.getElementById('form_add').value = null; $('.imagePreview-0').css('background-image', 'url({{ asset('public/admin/samples/choose-image.png') }})'); return false;" class="btn btn-warning text-light">
                                              <i class="fas fa-sync-alt"></i>
                                            </a>
                                            <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                            {{-- <input type="submit" class="btn btn-primary" name="submit" value="{{ __('messages.Update') }}" /> --}}
                                        @endif
                                      </div>
                                    </div>
                                </form>
                                <div class="col-sm-3 form-group">
                                    <div class="text-right">
                                        <span class="btn btn-primary" id="hideandshowtoggle">Add Games</span>
                                    </div>
                                </div>
                            </div>
                          </section>
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
                              
                              <form class="" method="post" action="{{ route('brand_edit',['id'=>$info->id]) }}" id="form_add" enctype="multipart/form-data">
                                  @csrf
                                  <tr>
                                  <td>{{ $data->firstItem() + $key  }}</td>     

                              <td>
                                  <input maxlength="30" minlength="3" type="text" name="name" class="form-control" readonly value="{{ $info->name }}" id="FreeToUpdate{{ $info->id }}"></td>
                              </td>

                                      <td>
                                        <div class="modal fade" id="myModal{{ $info->id }}" role="dialog">
                                          <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                  <div class="avatar-upload" style="text-align: -webkit-center;max-width: 100%;margin: 50px auto;">
                                                    <div class="avatar-edit">
                                                      <input onchange="imageUploadFunction(this,{{ $info->id }})" type='file' name="image" id="ssimageUpload-{{ $info->id }}" accept=".png, .jpg, .jpeg" />
                                                      <label style=" width: 60px; height: 60px; " id="ssimageUploadNew-{{ $info->id }}" for="ssimageUpload-{{ $info->id }}">
                                                        <i style="margin-left: 10px;margin-top: 8px;font-size: 40px;" class="fa fa-edit" ></i>
                                                      </label>
                                                    </div>
                                                    <div class="avatar-preview" style="width: 300px;height: 300px;position: relative;border-radius: 100%;border: 6px solid #F8F8F8;box-shadow: 0px 2px 4px 0px rgb(0 0 0 / 10%);border-radius: 0;">
                                                        <div id="ssimagePreview-{{ $info->id }}" style="background-image: url({{  $info->getBrandImage() }} );border-radius: 0%;"></div>
                                                    </div>
                                                  </div> 
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
                                                </div>
                                            </div>
                                          </div>
                                        </div>

                                      @if($info->image && $info->getBrandImage() )
                                      
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <label id="imageUploadNew-{{ $info->id }}" data-toggle="modal" data-target="#myModal{{ $info->id }}" style="display: none;"><i style=" cursor: pointer; " class="fa fa-edit" ></i></label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview-{{ $info->id }}" style="background-image: url({{  $info->getBrandImage() }} );"></div>
                                            </div>
                                        </div>

                                      @else

                                      <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <label id="imageUploadNew-{{ $info->id }}"
                                               data-toggle="modal" data-target="#myModal{{ $info->id }}" style="display: none;">
                                            <i style=" cursor: pointer; " class="fa fa-edit" ></i></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview-{{ $info->id }}" style="background-image: url({{ asset('public/admin/samples/choose-image.png') }});"></div>
                                        </div>
                                      </div>                                     

                                      @endif
                                  
                                      
                                  </td>
                                  <td>{{ $info->created_at }}</td>
                                  <td>{{ $info->updated_at }}</td>
                            <!-- <td>{{date('d-M  Y',strtotime($info->created_at))}}</td>-->
                              <td>
                              <div class="btn-group">
                              @can('brand-edit')
                              
                              <button type="button" class="btn btn-warning btn-sm text-light mr-1" onclick="freeToEditable({{$info->id}});">
                                  <i class="fa fas fa-edit"></i>
                              </button>

                              <button disabled type="submit" class="btn btn-sm btn-primary mr-1" id="onsubmit_Save_pns{{$info->id}}">
                                  <i class="fa fas fa-save"></i>
                              </button>

                              {{-- <input class="btn btn-sm btn-primary" type="submit" class="btn btn-primary" name="submit" value="{{ __('messages.Submit') }}" /><i class="fa fas fa-edit"></i> --}}
                                  {{-- <a title="{{ __('messages.Edit') }}" class="btn btn-sm btn-primary" href="{{route($edit_action,['id'=>$info->id])}}">
                                      <i class="fa fas fa-edit"></i>
                                  </a> --}}
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

<script src="{{ asset('public/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('public/admin/plugins/toastr/toastr.min.js') }}"></script>
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
    $(function () {
        $('#form_add').validate({
        rules: {
          name: {
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
    

    function imageUploadFunction(input,id){
        if (input.files && input.files[0]) {
          const file = input.files[0];
          const file_size = input.files[0].size;
          const  fileType = file['type'];
          
          const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
          if (!validImageTypes.includes(fileType)) {
            toastr.error('{{ __("messages.The image type must be .jpeg, .png,.jpg,.gif,.svg") }}.');
            $("#ssimageUpload-"+id).val('');
            $('#imagePreview-'+id).css('background-image', "url({{ asset('public/admin/samples/choose-image.png') }})");
            $('#ssimagePreview-'+id).css('background-image', "url({{ asset('public/admin/samples/choose-image.png') }})");
          }
          else if(file_size > 1024000){
            toastr.error('{{ __("messages.The image must not be greater than 1024 kilobytes") }}.');
            $("#ssimageUpload-"+id).val('');
            $('#imagePreview-'+id).css('background-image', "url({{ asset('public/admin/samples/choose-image.png') }})");
            $('#ssimagePreview-'+id).css('background-image', "url({{ asset('public/admin/samples/choose-image.png') }})");
          }else{
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview-'+id).css('background-image', 'url('+e.target.result +')');
                $('#ssimagePreview-'+id).css('background-image', 'url('+e.target.result +')');
                $('#imagePreview-'+id).hide();
                $('#imagePreview-'+id).fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
          }
        }
    }

</script>

@endsection