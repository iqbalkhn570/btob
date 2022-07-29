@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0">Dashboard v2</h1>
          </div><!-- /.col -->

          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Filters</h3>
            
            <div class="card-tools">
            <form class="row" method="get" action="" id="search_brands" >
            <div class="form-group col-md-8">
                 

                  
                  <div class="float-right mr-3">
                     <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text">
                           <i class="far fa-calendar-alt"></i>
                        </span>
                     </div>
                     <input type="text" class="form-control  form-control-sm float-right"  name="filter_date_range" id="filter_date_range" value="{{ request()->input('filter_date_range')  }}">
                     </div>
                     <!-- /.input group -->
                  </div>
                </div>
                  <select class="form-control col-md-4" name="brands" onchange="this.form.submit()">
                       @foreach($company as $row)

                      <option value="{{ $row->id }}" {{ $selectCountry == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                      @endforeach

                    </select>
                    <input type="hidden" name="chart_for" id="chart_for"> 
                    </form>     
            </div>
            
          </div>
          <!-- /.card-header -->
          

        </div>
        
        <div class="row">
          <div class="col-lg-3 col-6 tabclss" style="cursor:pointer">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3> <i class="fas fa-dollar-sign" aria-hidden="true"></i>{{$dashboardData->turnover ?? '0'}}</h3>

                <p>Turnover</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <input type="hidden" name="turnover" id="turnover" value="{{__('turnover')}}">
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 tabclss" style="cursor:pointer">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><i class="fas fa-dollar-sign" aria-hidden="true"></i>{{$dashboardData->total_payout ?? 0}}</h3>

                <p>Total Payout</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <input type="hidden" name="turnover" id="turnover" value="{{__('total_payout')}}">
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 tabclss" style="cursor:pointer">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><i class="fas fa-dollar-sign" aria-hidden="true"></i>{{$dashboardData->gross_gaming_revenue??0}}</h3>

                <p>Gross Gaming Revenue (GGR) </p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <input type="hidden" name="turnover" id="turnover" value="{{__('gross_gaming_revenue')}}">
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 tabclss" style="cursor:pointer">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><i class="fas fa-dollar-sign" aria-hidden="true"></i>{{$dashboardData->largest_bets?? 0}}</h3>

                <p>Game with Largest Bets</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <input type="hidden" name="turnover" id="turnover" value="{{__('largest_bets')}}">
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-lg-3 col-6 tabclss" style="cursor:pointer">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><i class="fas fa-dollar-sign" aria-hidden="true"></i>{{$dashboardData->most_amount_bets?? 0}}</h3>

                <p>Game with Most Amount of Bets</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <input type="hidden" name="turnover" id="turnover" value="{{__('most_amount_bets')}}">
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 tabclss" style="cursor:pointer">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><i class="fas fa-dollar-sign" aria-hidden="true"></i>{{$dashboardData->least_amount_bets?? 0}}</h3>

                <p>Game with Least Amount of Bets</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <input type="hidden" name="turnover" id="turnover" value="{{__('least_amount_bets')}}">
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 tabclss" style="cursor:pointer">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><i class="fas fa-dollar-sign" aria-hidden="true"></i>{{$dashboardData->top_game_revenue?? 0}}</h3>

                <p>Top Game Revenue </p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <input type="hidden" name="turnover" id="turnover" value="{{__('top_game_revenue')}}">
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 tabclss" style="cursor:pointer">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><i class="fas fa-dollar-sign" aria-hidden="true"></i>{{$dashboardData->low_game_revenue?? 0}}</h3>

                <p>Low Game Revenue</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <input type="hidden" name="turnover" id="turnover" value="{{__('low_game_revenue')}}">
            </div>
          </div>
          <!-- ./col -->
        </div>


        <div class="row">
          <section class="col-lg-8 connectedSortable">
          <!-- solid sales graph -->
           <div class="card bg-gradient-info">
                  <div class="card-header border-0">
                    <h3 class="card-title">
                      <i class="fas fa-th mr-1"></i>
                      {{ $graphFor ??'Turnover'  }} Graph
                    </h3>

                    <div class="card-tools">
                      <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                  <!-- /.card-body -->
                  <!-- <div class="card-footer bg-transparent">
                    <div class="row">
                      <div class="col-4 text-center">
                        <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                              data-fgColor="#39CCCC">

                        <div class="text-white">Mail-Orders</div>
                      </div>
                      
                      <div class="col-4 text-center">
                        <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                              data-fgColor="#39CCCC">

                        <div class="text-white">Online</div>
                      </div>
                      
                      <div class="col-4 text-center">
                        <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                              data-fgColor="#39CCCC">

                        <div class="text-white">In-Store</div>
                      </div>
                      
                    </div>
                  
                  </div> -->
                
                </div>
                



          </section>


       <section class="col-lg-4 connectedSortable">
       <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="chart-responsive">
                      <canvas id="pieChart" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <!-- <div class="col-md-4">
                    <ul class="chart-legend clearfix">
                      <li><i class="far fa-circle text-danger"></i> Chrome</li>
                      <li><i class="far fa-circle text-success"></i> IE</li>
                      <li><i class="far fa-circle text-warning"></i> FireFox</li>
                      <li><i class="far fa-circle text-info"></i> Safari</li>
                      <li><i class="far fa-circle text-primary"></i> Opera</li>
                      <li><i class="far fa-circle text-secondary"></i> Navigator</li>
                    </ul>
                  </div> -->
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      United States of America
                      <span class="float-right text-danger">
                        <i class="fas fa-arrow-down text-sm"></i>
                        12%</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      India
                      <span class="float-right text-success">
                        <i class="fas fa-arrow-up text-sm"></i> 4%
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      China
                      <span class="float-right text-warning">
                        <i class="fas fa-arrow-left text-sm"></i> 0%
                      </span>
                    </a>
                  </li>
                </ul>
              </div> -->
              <!-- /.footer -->
            </div>
       </section>


       </div>

       <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
           
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53</h3>

                <p>Online Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>OffLine Users </p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Inactive Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('script')

<script type="text/javascript">
      $(function () {

    
       
         $( ".tabclss" ).click(function() {
           $('#chart_for').val($(this).find("input").val());
           $('#search_brands').submit();
            
          });
    var nowDate = new Date();
   var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
    //Date range as a button
    $('#filter_date_range').daterangepicker(
      {
         "maxDate": today,
         "autoApply": true,
        // "startDate" :moment().subtract(29, 'days'),
       //  "endDate" : moment(),
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        
      },
      function (start, end) {
        // $('#search_brands').submit();
       console.log(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
       // $('#filter_date_range').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
     
      }
    )



     // Sales graph chart
  var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
  // $('#revenue-chart').get(0).getContext('2d');

  var salesGraphChartData = {
    //labels: ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2', '2012 Q3', '2012 Q4', '2013 Q1', '2013 Q2'],
    labels: @php echo json_encode($daysArr) @endphp,

    datasets: [
      {
        label: 'Turnover',
        fill: false,
        borderWidth: 2,
        lineTension: 0,
        spanGaps: true,
        borderColor: '#efefef',
        pointRadius: 3,
        pointHoverRadius: 7,
        pointColor: '#efefef',
        pointBackgroundColor: '#efefef',
        //data: [2666, 2778, 4912, 3767, 6810, 5670, 4820, 15073, 10687, 8432]
        data: @php echo json_encode($turnoverArr); @endphp
      }
    ]
  }

  var salesGraphChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        ticks: {
          fontColor: '#efefef'
        },
        gridLines: {
          display: false,
          color: '#efefef',
          drawBorder: false
        }
      }],
      yAxes: [{
        ticks: {
          stepSize: 100,
          fontColor: '#efefef'
        },
        gridLines: {
          display: true,
          color: '#efefef',
          drawBorder: false
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
    type: 'line',
    data: salesGraphChartData,
    options: salesGraphChartOptions
  })


  //-------------
  // - PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
  var pieData = {
    labels: [
      'Total Users',
      'Online Users',
      'OffLine Users',
      'Inactive Users'
      
    ],
    datasets: [
      {
        data: [150, 53, 44, 65],
        backgroundColor: ['#17a2b8', '#28a745', '#ffc107', '#dc3545']
      }
    ]
  }
  var pieOptions = {
    legend: {
      display: false
    }
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart = new Chart(pieChartCanvas, {
    type: 'doughnut',
    data: pieData,
    options: pieOptions
  })

  //-----------------
  // - END PIE CHART -
  //-----------------


      })
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </script>
@endsection
