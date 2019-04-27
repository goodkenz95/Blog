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
            <div class="form-group {{$errors->first('fb_id') ? 'has-error' : NULL}}">
              <label>Facebook ID</label>
              <input type="text" placeholder="Your Facebook ID (serve as your avatar)" class="form-control" name="fb_id" value="{{old('fb_id',$auth->fb_id)}}">
              <span class="help-block">Don't know your FB ID? Find it here: <a href="https://findmyfbid.com/" target="_blank">https://findmyfbid.com/</a></span>
              @if($errors->first('fb_id'))
              <span class="help-block">{{$errors->first('fb_id')}}</span>
              @endif
            </div>
            <div class="form-group {{$errors->first('name') ? 'has-error' : NULL}}">
              <label>Account Name</label>
              <input type="text" placeholder="Your complete name" class="form-control" name="name" value="{{old('name',$auth->name)}}">
              @if($errors->first('name'))
              <span class="help-block">{{$errors->first('name')}}</span>
              @endif
            </div>
            <div class="form-group {{$errors->first('email') ? 'has-error' : NULL}}">
              <label>Email Address</label>
              <input type="text" placeholder="email" class="form-control" name="email" value="{{old('email',$auth->email)}}">
              @if($errors->first('email'))
              <span class="help-block">{{$errors->first('email')}}</span>
              @endif
            </div>
            <div class="form-group {{$errors->first('username') ? 'has-error' : NULL}}">
              <label>Username</label>
              <input type="text" placeholder="Username" class="form-control" name="username" value="{{old('username',$auth->username)}}">
              @if($errors->first('username'))
              <span class="help-block">{{$errors->first('username')}}</span>
              @endif
            </div>


            <div class="form-group {{$errors->first('description') ? 'has-error' : NULL}}">
              <label>Description</label>
              <textarea name="description" id="" cols="30" rows="3" class="form-control" placeholder="Tell something about yourself.">{{old('description',$auth->description)}}</textarea>
              @if($errors->first('description'))
              <span class="help-block">{{$errors->first('description')}}</span>
              @endif
            </div>
            <div class="row xs-pt-15">
              <div class="col-xs-6">
                  <button type="submit" class="btn btn-space btn-primary">Update Profile</button>
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
    $('input.datepicker').focus(function(){
        $(this).datetimepicker({autoclose: true,pickTime : false});
        $(this).datetimepicker('show');
        $(this).on('changeDate', function(ev){
            // do stuff
        }).on('hide', function(){
                $(this).datetimepicker('remove');
            });
    });
  });
</script>
@stop

