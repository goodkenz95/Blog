@extends('system._layouts.main')

@section('content')
<div class="main-content container-fluid">
  <div class="user-profile">
    <div class="row">
      <div class="col-md-6">
        @include('system._components.notifications')
        <div class="user-display">
          <div class="user-display-bg"><img src="{{asset('assets/img/user-profile-display.png')}}" alt="Profile Background"></div>
          <div class="user-display-bottom">
            <div class="user-display-avatar"><img src="{{$user->avatar}}" alt="{{$user->name}}"></div>
            <div class="user-display-info">
              <div class="name">{{$user->name}}</div>
              <div class="nick"><span class="mdi mdi-account"></span> {{$user->username}}</div>
            </div>
          </div>
        </div>
        <div class="user-info-list panel panel-default">
          <div class="panel-heading panel-heading-divider">About Me
            <span class="pull-right"><a href="{{route('system.account.edit-info')}}"><i class="mdi mdi-edit"></i></a></span>
            <span class="panel-subtitle">
              @if($user->description)
              {{$user->description}}
              @else
              <i>No description provided.</i>
              @endif
            </span>
          </div>
          <div class="panel-body">
            <table class="no-border no-strip skills">
              <tbody class="no-border-x no-border-y">
                <tr>
                  <td class="icon"><span class="mdi mdi-email"></span></td>
                  <td class="item">Email Address<span class="icon s7-portfolio"></span></td>
                  <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                </tr>
                <tr>
                  <td class="icon"><span class="mdi mdi-lock"></span></td>
                  <td class="item">Password<span class="icon s7-portfolio"></span></td>
                  <td>******** <span class="pull-right"><a href="{{route('system.account.edit-password')}}">[Edit Password]</a></span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>
@stop

