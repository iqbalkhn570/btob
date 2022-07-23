@extends('admin.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('public/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('public/admin/plugins/toastr/toastr.min.css') }}">

<link rel="stylesheet" href="{{ asset('public/admin/plugins/select2/css/select2.min.css') }}">


<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('public/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"> --}}
<style>
    span.select2-selection.select2-selection--single {
        height: 40px;
    }
    input.form-control.form-control-sm {
        margin-left: 484px;
        width: 266px;
    }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0"> {{ __('messages.Odd Settings') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <section class="card">
            <div class="card-body">
         
                <div class="card card-primary card-outline">
                    <span id="onsavealert"></span>
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
                    <div class="card-body">
                        
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
                        <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link @if(isset($_GET['work'])) @if($_GET['work'] != 'populer') active @endif @else active @endif" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">Rates Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false">Commission Drop & Limit Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(isset($_GET['work'])) @if($_GET['work'] == 'populer') active @endif  @endif" id="custom-content-above-profile2-tab" data-toggle="pill" href="#custom-content-above-profile2" role="tab" aria-controls="custom-content-above-profile2" aria-selected="false">Popular Number Settings</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="custom-content-above-tabContent">
                            <div class="tab-pane fade @if(isset($_GET['work'])) @if($_GET['work'] != 'populer') active show @endif @else active show @endif" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
                                <div id="info" class="tab-pane active ">
                                        <!-- form start -->
                                        @php $x = 1; @endphp
                                            @forelse ($company as $info)
                                            
                                                <form id="myForm-{{$info->id}}" action="{{route('changestatus')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                                                    @csrf
                                                        <div class="card card-secondary @if ($x != 1) collapsed-card @endif">
                                                            <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                                                                <h3 class="card-title">
                                                                    {{$info->name}}
                                                                </h3>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-warning btn-sm text-light mr-1" onclick="freeToEditable({{$info->id}});">
                                                                        <i class="fa fas fa-edit"></i>
                                                                    </button>
                                                                    <button disabled type="button" id="onsubmit_Save" class="btn btn-success btn-sm mr-3" onclick="onsubmitSave({{$info->id}});"><i class="fas fa-save"></i></button>
                                                                    {{-- <button type="button" class="btn btn-success btn-sm mr-3">
                                                                        <i class="fas fa-save"></i>
                                                                    </button> --}}
                                                                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                                                        @if ($x != 1) <i class="fas fa-plus"></i> @else <i class="fas fa-minus"></i> @endif
                                                                    </button>
                                                                </div>
                                                            </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">
                                                                    <table class="table table-sm border">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>1st Prizes</th>
                                                                                <th>2nd Prizes</th>
                                                                                <th>3rd Prizes</th>
                                                                                <th>Special Prizes</th>
                                                                                <th>Consolation Prizes</th>
                                                                            </tr>
                                                                        </thead>


                                                                        <tbody>
                                                                    @forelse ($brand as $brandinfo)
                                                                        @php
                                                                            $brand_company = DB::table('brand_company')->where('company_id',$info->id)->where('brand_id',$brandinfo->id)->first();
                                                                        @endphp
                                                                    @if(DB::table('brand_company')->where('company_id',$info->id)->where('brand_id',$brandinfo->id)->where('status','enabled')->exists()) 
                                                                    
                                                                        <tr>
                                                                            <td style=" width: 300px; "><b>{{$brandinfo->name}}</b></td>
                                                                            <input type="hidden" value="{{ $brand_company->id }}" name="brand_company_id[]">
                                                                            <td>
                                                                                <input name="first_prize{{$brand_company->id}}" type="number" class="form-control free_to_edit-{{$info->id}}" readonly value="{{ $brand_company->first_prize }}">
                                                                            </td>
                                                                            <td>
                                                                                <input name="second_prize{{$brand_company->id}}" type="number" class="form-control free_to_edit-{{$info->id}}" readonly value="{{ $brand_company->second_prize }}">
                                                                            </td>
                                                                            <td>
                                                                                <input name="third_prize{{$brand_company->id}}" type="number" class="form-control free_to_edit-{{$info->id}}" readonly value="{{ $brand_company->third_prize }}">
                                                                            </td>
                                                                            <td>
                                                                                <input name="special_prize{{$brand_company->id}}" type="number" class="form-control free_to_edit-{{$info->id}}" readonly value="{{ $brand_company->special_prize }}">
                                                                            </td>
                                                                            <td>
                                                                                <input name="consolation_prize{{$brand_company->id}}" type="number" class="form-control free_to_edit-{{$info->id}}" readonly value="{{ $brand_company->consolation_prize }}">
                                                                            </td>
                                                                        </tr>
                                                                    
                                                                    @else

                                                                    <tr style=" background-color: rgba(0,0,0,.05); cursor: not-allowed; ">
                                                                        <td style=" width: 300px; ">{{$brandinfo->name}}</td>
                                                                        <td>
                                                                            <input type="number" class="form-control" readonly value="{{ $brand_company->first_prize }}" style=" cursor: not-allowed; ">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" class="form-control" readonly value="{{ $brand_company->second_prize }}" style=" cursor: not-allowed; ">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" class="form-control" readonly value="{{ $brand_company->third_prize }}" style=" cursor: not-allowed; ">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" class="form-control" readonly value="{{ $brand_company->special_prize }}" style=" cursor: not-allowed; ">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" class="form-control" readonly value="{{ $brand_company->consolation_prize }}" style=" cursor: not-allowed; ">
                                                                        </td>
                                                                    </tr>

                                                                    @endif 
                                                                        
                                                                    @empty
                                                                        
                                                                    @endforelse


                                                                    </tbody>
                                                                        </table>
                                                                </div>
                                                                <!-- /.card-body -->
                                                        </div>
                                                    @php
                                                        $x++;
                                                    @endphp   
                                                </form>
                                        @empty
                                            
                                        @endforelse
                                        {{-- <div class="card-footer">
                                            <button disabled type="submit" class="btn btn-primary">Submit</button>
                                        </div> --}}
                                </div> <!-- info -->
                            </div>
                            <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                                
                                

                                
                                <div id="info" class="tab-pane active ">
                                    <!-- form start -->
                                    @php $x = 1; @endphp
                                        @forelse ($company as $info)
                                        
                                            <form id="myForm2-{{$info->id}}" action="{{route('changestatus')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                                                @csrf
                                                    <div class="card card-secondary @if ($x != 1) collapsed-card @endif">
                                                        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                                                            <h3 class="card-title">
                                                                {{$info->name}}
                                                            </h3>
                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-warning btn-sm text-light mr-1" onclick="freeToEditable2({{$info->id}});">
                                                                    <i class="fa fas fa-edit"></i>
                                                                </button>
                                                                <button disabled type="button" id="onsubmit_Save2" class="btn btn-success btn-sm mr-3" onclick="onsubmitSave2({{$info->id}});"><i class="fas fa-save"></i></button>
                                                                {{-- <button type="button" class="btn btn-success btn-sm mr-3">
                                                                    <i class="fas fa-save"></i>
                                                                </button> --}}
                                                                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                                                    @if ($x != 1) <i class="fas fa-plus"></i> @else <i class="fas fa-minus"></i> @endif
                                                                </button>
                                                            </div>
                                                        </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body">
                                                                <table class="table table-sm border">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Commission drop off number</th>
                                                                            <th>Max allowed limit per number</th>
                                                                            <th>Decremental Percentage Rate</th>
                                                                        </tr>
                                                                    </thead>
                                                                    

                                                                    <tbody>
                                                                @forelse ($brand as $brandinfo)
                                                                    @php
                                                                        $brand_company = DB::table('brand_company')->where('company_id',$info->id)->where('brand_id',$brandinfo->id)->first();
                                                                    @endphp
                                                                @if(DB::table('brand_company')->where('company_id',$info->id)->where('brand_id',$brandinfo->id)->where('status','enabled')->exists()) 
                                                                
                                                                    <tr>
                                                                        <td style=" width: 300px; "><b>{{$brandinfo->name}}</b></td>
                                                                        <input type="hidden" value="{{ $brand_company->id }}" name="brand_company_id[]">
                                                                        <td>
                                                                            <input name="prize_drop_off{{$brand_company->id}}" type="number" class="form-control free_to_edit2-{{$info->id}}" readonly value="{{ $brand_company->prize_drop_off }}">
                                                                        </td>
                                                                        <td>
                                                                            <input name="max_allowed_limit{{$brand_company->id}}" type="number" class="form-control free_to_edit2-{{$info->id}}" readonly value="{{ $brand_company->max_allowed_limit }}">
                                                                        </td>
                                                                        <td>
                                                                            <input name="decremental_percentage_value{{$brand_company->id}}" type="text" class="form-control free_to_edit2-{{$info->id}}" readonly value="{{ $brand_company->decremental_percentage_value }}" maxlength="5" min="0.01" step="0.01" onkeyup="this.value = minmax(this.value, 0, 100)">
                                                                        </td>
                                                                    </tr>
                                                                
                                                                @else

                                                                <tr style=" background-color: rgba(0,0,0,.05); cursor: not-allowed; ">
                                                                    <td style=" width: 300px; ">{{$brandinfo->name}}</td>
                                                                    <td>
                                                                        <input type="number" class="form-control" readonly value="{{ $brand_company->prize_drop_off }}" style=" cursor: not-allowed; ">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control" readonly value="{{ $brand_company->max_allowed_limit }}" style=" cursor: not-allowed; ">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control" readonly value="{{ $brand_company->decremental_percentage_value }}" style=" cursor: not-allowed; ">
                                                                    </td>
                                                                </tr>

                                                                @endif 
                                                                    
                                                                @empty
                                                                    
                                                                @endforelse


                                                                </tbody>
                                                                    </table>
                                                            </div>
                                                            <!-- /.card-body -->
                                                    </div>
                                                @php
                                                    $x++;
                                                @endphp   
                                            </form>
                                    @empty
                                        
                                    @endforelse
                                </div> <!-- info -->


                            </div>


                            <div class="tab-pane fade @if(isset($_GET['work'])) @if($_GET['work'] == 'populer') active show @endif  @endif" id="custom-content-above-profile2" role="tabpanel" aria-labelledby="custom-content-above-profile2-tab">
                                
                                

                                
                                <div id="info" class="tab-pane active ">
                                    <form action="{{route('saveCommissionSettings')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <input type="hidden" id="id" value="1">
                                            <div id="divTxt">
                                                <div class="row">
                                                    <div class="form-group col-md-3 mb-2">
                                                        <b>Popular Number</b>
                                                      </div>
                                                      <div class="form-group col-md-3 mb-2">
                                                        <b>Entity</b>
                                                      </div>
                                                      <div class="form-group col-md-3 mb-2">
                                                        <b>Game Plane</b>
                                                      </div>
                                                </div>
                                                <div class="row" id="allMainData">
                                                    <div class="form-group col-md-3">
                                                        <input required type="text" name="populer_number0" class="form-control" id="PopulerNumber" placeholder="Popular Number">
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                        <div class="form-group">
                                                            <input type="hidden" value="0" name="number_of[]">
                                                            <select required name="entity0" onchange="getGameDetailsVal(this.value,0);" class="form-control" style="width: 100%;">
                                                              <option value="">Please Select Entity</option>
                                                              @forelse ($company as $info)
                                                                <option value="{{$info->id}}">{{$info->name}}</option>
                                                              @empty

                                                              @endforelse
                                                            </select>
                                                        </div>
                                                      </div>
                                                      <div class="form-group col-md-3">
                                                        <div class="form-group">
                                                            <select required id="gamePlaneAppend0" name="game_plane0" class="form-control" style="width: 100%;">
                                                                <option value="">Please Select Game Plane</option>
                                                            </select>
                                                        </div>
                                                      </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <a href="#" onClick="addFormField(); return false;" class="btn btn-success">Add More</a>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-warning text-light">Reset</button>
                                        </div>
                                    </form>



                                    <div class="card">
                                        {{-- <div class="card-header">
                                          <h3 class="card-title">DataTable with default features</h3>
                                        </div> --}}
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                          <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Sr. No.</th>
                                                    <th>Popular Number</th>
                                                    <th>Entity</th>
                                                    <th>Game Plane</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $sr = 1;
                                                @endphp
                                        @forelse ($populerNumberSettings as $pnsVal)
                                            <form id="formPns{{ $pnsVal->id }}">
                                                @csrf
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $sr }}
                                                    </td>
                                                    <td style=" width: 300px; ">
                                                        <input type="hidden" name="id" value="{{ $pnsVal->id }}">
                                                        <input type="number" name="populer_number" class="form-control" readonly value="{{ $pnsVal->populer_number }}" id="pnsFreeToUpdate{{ $pnsVal->id }}"></td>
                                                    <td>
                                                        {{ $pnsVal->c_name }}
                                                    </td>
                                                    <td>
                                                        {{ $pnsVal->b_name }}
                                                    </td>
                                                    <td>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-warning btn-sm text-light mr-1" onclick="freeToEditablePns({{ $pnsVal->id }});">
                                                                <i class="fa fas fa-edit"></i>
                                                            </button>
                                                            <button disabled="" type="button" id="onsubmit_Save_pns{{ $pnsVal->id }}" class="btn btn-success btn-sm mr-3" onclick="onsubmitSavePns({{ $pnsVal->id }});">
                                                                <i class="fas fa-save"></i>
                                                            </button>
                                                            <a onclick="onDeletePns({{ $pnsVal->id }});" class="btn btn-danger btn-sm mr-3">
                                                                <i class="fas fa-trash"></i>
                                                            </a> 
                                                        </div>
                                                    </td>
                                                </tr> 
                                            </form>
                                            @php
                                                $sr++;
                                            @endphp                                           
                                        @empty

                                        @endforelse


                                        </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center">Sr. No.</th>
                                                    <th>Popular Number</th>
                                                    <th>Entity</th>
                                                    <th>Game Plane</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                          </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>









                                    
                                      
                                </div> <!-- info -->


                            </div>
                        </div>
                    </div>
                </div>

                <!-- tab-content -->
            </div><!-- panel-body -->
        </section>
    </div>
</section>
@endsection

@section('script')

<script src="{{ asset('public/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('public/admin/plugins/toastr/toastr.min.js') }}"></script>


<script src="{{ asset('public/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


{{-- <script src="{{ asset('public/admin/plugins/select2/js/select2.full.min.js') }}"></script> --}}
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script>
    // var $label = document.getElementsByTagName("INPUT")[2].closest("label");
    // $label.replaceWith(document.getElementsByTagName("INPUT")[0]);
//  $('#stats-table').DataTable({
//      language: { search: '', searchPlaceholder: "Search..." },
//  });
$("#example1").dataTable({
   "initComplete": function(){
      $("#datatableit_filter").detach().appendTo('#newSearch');
   },
   "language": { 
        "search": "" ,
        searchPlaceholder: "Search Here"
    },
   "responsive": true, "lengthChange": false, "autoWidth": false,
   
}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    function minmax(value, min, max) 
    {
        if(parseFloat(value) < min || isNaN(value)){
            return 0;
        }     
        else if(parseFloat(value) > max) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Percentage value is should be 0 to 100 !'
            })
            return 0;
        }
             
        else return value;
    }
    function freeToEditablePns(id){
        $("#pnsFreeToUpdate"+id).prop("readonly", false);
        $("#onsubmit_Save_pns"+id).prop('disabled', false);
    }
    function freeToEditable(id){
        $(".free_to_edit-"+id).prop("readonly", false);
        $("#myForm-"+id).find(':input[type=button]').prop('disabled', false);
    }
    
    function freeToEditable2(id){
        $(".free_to_edit2-"+id).prop("readonly", false);
        $("#myForm2-"+id).find(':input[type=button]').prop('disabled', false);
    }

    function onsubmitSave(id){
        var datastring = $("#myForm-"+id).serialize();
            $.ajax({
                type: "POST",
                url: '{{route('saveprizes')}}',
                data: datastring,
                dataType: "json",
                success: function(data) {
                    if(data == 1){
                        toastr.success('{{ __("messages.Prizes has been Updated") }}.');
                    }
                    if(data == 0){
                        toastr.error('Somethin Wents Worng');
                    }
                    $("#myForm-"+id).find('#onsubmit_Save').prop('disabled', true);
                    $(".free_to_edit-"+id).prop("readonly", true);
                },
                error: function() {
                    toastr.error('Somethin Wents Worng');
                }
            });
    }

    function onsubmitSave2(id){
        var datastring = $("#myForm2-"+id).serialize();
            $.ajax({
                type: "POST",
                url: '{{route('savedropprizes')}}',
                data: datastring,
                dataType: "json",
                success: function(data) {
                    if(data == 1){
                        toastr.success('{{ __("messages.Prize Drop & Limit Settings") }}.');
                    }
                    if(data == 0){
                        toastr.error('Somethin Wents Worng');
                    }
                    $("#myForm2-"+id).find('#onsubmit_Save2').prop('disabled', true);
                    $(".free_to_edit2-"+id).prop("readonly", true);
                },
                error: function() {
                    toastr.error('Somethin Wents Worng');
                }
            });
    }

    $('.select2').select2();
    
    $(function () {
        jQuery.validator.addMethod("ziprangeCA", function(value, element) {
            return this.optional(element) || /[a-zA-Z][0-9][a-zA-Z](-| |)[0-9][a-zA-Z][0-9]/.test(value);
        }, "Your ZIP-code must be for canada like M5H 3R3 or M5H-3R3");
        jQuery.validator.addMethod("zipcodeUS", function(value, element) {
            return this.optional(element) || /\d{5}-\d{4}$|^\d{5}$/.test(value);
        }, "The specified US ZIP Code is invalid");
        $('#setting_form').validate({
            rules: {
            contact_address1: {
                required: true,
            },
            contact_city: {
                required: true,
            },
            contact_province: {
                required: true
            },
            contact_country: {
                required: true
            },
            contact_zip: {
                required: true,
                maxlength:8,
                minlength:4
            },
            admin_email_id: {
                required: true,
                email: true
            },
            website_name: {
                required: true
            },
            },
            messages: {
            admin_email_id: {
                required: "Please enter a email address",
                email: "Please enter a vaild email address"
            },
            contact_zip: {
                required: "Please provide a Postal Code",
                maxlength: "Your zip must be at max 8 digits long",
                minlength: "Your zip must be at atleast 4 digits long"
            },
            contact_address1: "Please enter contact address",
            website_name: "Please enter website name"
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


    function getGameDetailsVal(c_id,id){
        if(c_id!=''){
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                // document.getElementById("demo").innerHTML = this.responseText;
                $("#gamePlaneAppend"+id).html(this.responseText);
            }
            xhttp.open("GET", "{{url('admin/getGameDetailsVal')}}/"+c_id);
            xhttp.send();
        }
    }    

    function onsubmitSavePns(id){
        var datastring = $("#formPns"+id).serialize();
            $.ajax({
                type: "POST",
                url: '{{route('updateCommissionSettings')}}',
                data: datastring,
                dataType: "json",
                success: function(data) {
                    if(data == 1){
                        toastr.success('{{ __("messages.Prize Drop & Limit Settings Updated") }}.');
                    }
                    if(data == 0){
                        toastr.error('Somethin Wents Worng');
                    }
                        $("#pnsFreeToUpdate"+id).prop("readonly", true);
                        $("#onsubmit_Save_pns"+id).prop('disabled', true);
                },
                error: function() {
                    toastr.error('Somethin Wents Worng');
                }
            });
    }
    function onDeletePns(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            ).then(function () {
                window.location = "{{ url('admin/onDeletePns') }}/"+id;
            });
        }
        })
    }
    function addFormField() {
        var id = document.getElementById("id").value;

        var allData = $("#allMainData").html();

        $("#divTxt").append( "<span style='margin-top: -20px;' class='row' id='row"+id+"'> <div class='form-group col-md-3'> <input required type='text' name='populer_number"+id+"' class='form-control' id='PopulerNumber' placeholder='Popular Number'> </div> <div class='form-group col-md-3'> <div class='form-group'> <input type='hidden' value='"+id+"' name='number_of[]'> <select name='entity"+id+"' onchange='getGameDetailsVal(this.value,"+id+");' class='form-control' style='width: 100%;' required> <option value=''>Please Select Entity</option> @forelse ($company as $info) <option value='{{$info->id}}'>{{$info->name}}</option> @empty @endforelse </select> </div> </div> <div class='form-group col-md-3'> <div class='form-group'> <select id='gamePlaneAppend"+id+"' name='game_plane"+id+"' class='form-control' style='width: 100%;' required> <option value=''>Please Select Game Plane</option> </select> </div> </div> </div> <div class='form-group col-md-3'><a href='#' class='btn btn-outline-danger' onClick='removeFormField("+id+"); return false;'><i class='fas fa-times'></i></a></span>" );

        id = id - 1 + 2;
        document.getElementById("id").value = id;
    }

    function removeFormField(id) {
        $("#row"+id).remove();
    }

</script>
@endsection