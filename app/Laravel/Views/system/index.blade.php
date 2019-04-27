@extends('system._layouts.main')

@section('content')
<div class="main-content container-fluid">
  <div class="row">
    @include('system._components.notifications')
    <div class="col-xs-12 col-md-6 col-lg-4">
      <div class="widget widget-tile">
          <div  class="chart sparkline icon-container">
            <div class="icon">
              <span class="mdi mdi-account-add"></span>
            </div>
          </div>
        <div class="data-info">
          <div class="desc">New Users</div>
          <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="{{$new_users}}" class="number">0</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4">
      <div class="widget widget-tile">
          <div  class="chart sparkline icon-container">
            <div class="icon">
              <span class="mdi mdi-account-circle"></span>
            </div>
          </div>
        <div class="data-info">
          <div class="desc">Daily Active Mentors</div>
          <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="{{$daily_mentors}}" class="number">0</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4">
      <div class="widget widget-tile">
          <div  class="chart sparkline icon-container">
            <div class="icon">
              <span class="mdi mdi-account-o"></span>
            </div>
          </div>
        <div class="data-info">
          <div class="desc">Daily Active Mentees</div>
          <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="{{$daily_mentees}}" class="number">0</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4">
      <div class="widget widget-tile">
          <div  class="chart sparkline icon-container">
            <div class="icon">
              <span class="mdi mdi-attachment"></span>
            </div>
          </div>
        <div class="data-info">
          <div class="desc">Published Articles</div>
          <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="{{$articles}}" class="number">0</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4">
      <div class="widget widget-tile">
          <div  class="chart sparkline icon-container">
            <div class="icon">
              <span class="mdi mdi-accounts-list-alt"></span>
            </div>
          </div>
        <div class="data-info">
          <div class="desc">Pending Approval</div>
          <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="{{$pending_mentors}}" class="number">0</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-4">
      <div class="widget widget-tile">
          <div  class="chart sparkline icon-container">
            <div class="icon">
              <span class="mdi mdi-assignment-alert"></span>
            </div>
          </div>
        <div class="data-info">
          <div class="desc">Pending Articles</div>
          <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="{{$pending_articles}}" class="number">0</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading panel-heading-divider">
          <span class="title">User Statistics</span><span class="panel-subtitle">Mentors vs Mentees</span>
        </div>
        <div class="panel-body">
          <div id="user_stat" style="height: 250px;"></div>
        </div>
        <div class="panel-footer">
          <div><strong>Active Mentors</strong> : <a href="{{route('system.app_user.mentor')}}"><strong>{{Helper::nice_number($active_mentors)}}</strong></a></div>
          <div><strong>Active Mentees</strong> : <a href="{{route('system.app_user.mentee')}}"><strong>{{Helper::nice_number($active_mentees)}}</strong></a></div>
          
          <div><strong>Mentors</strong> : <a href="{{route('system.app_user.mentor')}}"><strong>{{Helper::nice_number($mentors)}}</strong></a></div>
          <div><strong>Mentors for approval</strong> : <a href="{{route('system.app_user.mentor')}}"><strong>{{Helper::nice_number($pending_mentors)}}</strong></a></div>
          <div><strong>Mentees</strong> : <a href="{{route('system.app_user.mentee')}}"><strong>{{Helper::nice_number($mentees)}}</strong></a></div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading panel-heading-divider">
          <span class="title">New Users Today</span><span class="panel-subtitle">App users registrant for today in hourly based</span>
        </div>
        <div class="panel-body">
          <div id="hourly_registrant" style="height: 250px;"></div>
        </div>
        <div class="panel-footer">
          <table class="table table-hover table-bordered table-striped table-condensed">
            <thead>
              <tr>
                <th width="25%">Hour</th>
                <th width="25%">Mentors</th>
                <th width="25%">Mentees</th>
                <th width="25%">Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach(array_reverse(json_decode($hourly_registrants)) AS $index => $data)
              <tr>
                <td>{{$data->date}}</td>
                <td>{{Helper::nice_number($data->mentor)}}</td>
                <td>{{Helper::nice_number($data->mentee)}}</td>
                <td>{{Helper::nice_number($data->mentor+$data->mentee)}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading panel-heading-divider">
          <span class="title">New Users Last 7 Days</span><span class="panel-subtitle">App users registrant from the last 7 days</span>
        </div>
        <div class="panel-body">
          <div id="last_7days" style="height: 250px;"></div>
        </div>
        <div class="panel-footer">
          <table class="table table-hover table-bordered table-striped table-condensed">
            <thead>
              <tr>
                <th width="25%">Date</th>
                <th width="25%">Mentors</th>
                <th width="25%">Mentees</th>
                <th width="25%">Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach(array_reverse(json_decode($area_chart)) AS $index => $data)
              <tr>
                <td>{{Carbon::parse($data->date)->format("m/d/Y")}}</td>
                <td>{{Helper::nice_number($data->mentor)}}</td>
                <td>{{Helper::nice_number($data->mentee)}}</td>
                <td>{{Helper::nice_number($data->mentor+$data->mentee)}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading panel-heading-divider">
          <span class="title">Mentorship Last 7 Days</span><span class="panel-subtitle">Mentorship from the last 7 days</span>
        </div>
        <div class="panel-body">
          <div id="mentorship_last_7days" style="height: 250px;"></div>
        </div>
        <div class="panel-footer">
          <table class="table table-hover table-bordered table-striped table-condensed">
            <thead>
              <tr>
                <th width="25%">Date</th>
                <th width="75%">No. Mentorship</th>
              </tr>
            </thead>
            <tbody>
              @foreach(array_reverse(json_decode($mentorship_chart)) AS $index => $data)
              <tr>
                <td>{{$data->date}}</td>
                <td>{{Helper::nice_number($data->mentorship)}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/lib/morrisjs/morris.css')}}"/>
@stop


@section('page-scripts')
<script src="{{asset('assets/lib/countup/countUp.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/jquery-flot/jquery.flot.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/jquery-flot/jquery.flot.pie.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/jquery-flot/jquery.flot.resize.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/jquery-flot/plugins/jquery.flot.orderBars.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/jquery-flot/plugins/curvedLines.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/jquery-flot/jquery.flot.tooltip.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/chartjs/Chart.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/raphael/raphael-min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/morrisjs/morris.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
  $(function(){
      Morris.Donut({element:"user_stat",
          data:[{label:"Mentors",value:"{{$mentors_percentage}}"},
                {label:"Mentees",value:"{{$mentees_percentage}}"}],
          colors:["#227b43","#4285f4"],
          formatter:function(a){return a+"%";}
        })

      Morris.Area({element:"last_7days",
            data:{!!$area_chart!!},
            xkey:"date",ykeys:["mentor","mentee"],
            labels:["Mentor","Mentee"],
            lineColors:["#227b43","#4285f4"],
            pointSize:2,hideHover:"auto"});

      Morris.Area({element:"mentorship_last_7days",
            data:{!!$mentorship_chart!!},
            xkey:"date",ykeys:["mentorship"],
            labels:["Mentorship"],
            lineColors:["#227b43"],
            pointSize:2,hideHover:"auto"});
      Morris.Area({element:"hourly_registrant",
            data:{!!$hourly_registrants!!},
            xkey:"date",ykeys:["mentor","mentee"],
            labels:["Mentor","Mentee"],
            lineColors:["#227b43","#4285f4"],
            parseTime: false,
            pointSize:2,hideHover:"auto"});
      a();
      function a(){$('[data-toggle="counter"]').each(function(a,b){var c=$(this),d="",e="",f=0,g=0,h=0,i=2.5;c.data("prefix")&&(d=c.data("prefix")),c.data("suffix")&&(e=c.data("suffix")),c.data("start")&&(f=c.data("start")),c.data("end")&&(g=c.data("end")),c.data("decimals")&&(h=c.data("decimals")),c.data("duration")&&(i=c.data("duration"));var j=new CountUp(c.get(0),f,g,h,i,{suffix:e,prefix:d});j.start()})}


    });
</script>
@stop