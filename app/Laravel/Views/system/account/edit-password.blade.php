@extends('system._layouts.main')

@section('content')
<div class="main-content container-fluid">
  <div class="row">
    <div class="col-md-6">
      @include('system._components.notifications')
      <div class="panel panel-default panel-border-color panel-border-color-warning">
        <div class="panel-heading panel-heading-divider">Update Profile Form<span class="panel-subtitle">Some information are uneditable or subject for request in order to update it.</span></div>
        <div class="panel-body">
          <form method="POST" action="">
            {!!csrf_field()!!}

            <div class="form-group {{$errors->first('current_password') ? 'has-error' : NULL}}">
              <label>Current Password</label>
              <input type="password" placeholder="Your current password" class="form-control" name="current_password" >
              @if($errors->first('current_password'))
              <span class="help-block">{{$errors->first('current_password')}}</span>
              @endif
            </div>
            <div class="form-group {{$errors->first('password') ? 'has-error' : NULL}}">
              <label>New Password</label>
              <input type="password" placeholder="Your current password" class="form-control" name="password" >
              @if($errors->first('password'))
              <span class="help-block">{{$errors->first('password')}}</span>
              @endif
            </div>
            <div class="form-group">
              <label>Confirm New Password</label>
              <input type="password" placeholder="Your current password" class="form-control" name="password_confirmation" >
            </div>
            <div class="row xs-pt-15">
              <div class="col-xs-6">
                  <button type="submit" class="btn btn-space btn-primary">Update Password</button>
                  <a href="{{route('system.account.profile',[Str::lower($auth->username)])}}" class="btn btn-space btn-default">Cancel</a>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css')}}"/>
@stop
@section('page-scripts')
<script src="{{asset('assets/lib/moment.js/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  $(function(){
    $('.datepicker').datetimepicker({autoclose: true})
  });
</script>
@stop

