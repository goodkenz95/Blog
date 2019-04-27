@extends('system._layouts.main')

@section('content')
<div class="main-content container-fluid">
  <div class="row">
    <div class="col-md-6">
      @include('system._components.notifications')
      <div class="panel panel-default panel-border-color panel-border-color-success">
        <div class="panel-heading panel-heading-divider">Create Record Form<span class="panel-subtitle">Article Category information.</span></div>
        <div class="panel-body">
          <form method="POST" action="">
            {!!csrf_field()!!}
            
            <div class="form-group {{$errors->first('name') ? 'has-error' : NULL}}">
              <label>Category Name</label>
              <input type="text" placeholder="Category name" class="form-control" name="name" value="{{old('name')}}">
              @if($errors->first('name'))
              <span class="help-block">{{$errors->first('name')}}</span>
              @endif
            </div>

            <div class="form-group {{$errors->first('status') ? 'has-error' : NULL}}">
              <label>Status</label>
              {!!Form::select('status',$statuses,old('status','active'),['class' => "form-control"])!!}
              @if($errors->first('status'))
              <span class="help-block">{{$errors->first('status')}}</span>
              @endif
            </div>
            
            <div class="row xs-pt-15">
              <div class="col-xs-6">
                  <button type="submit" class="btn btn-space btn-success">Create Record</button>
                  <a href="{{route('system.category.index')}}" class="btn btn-space btn-default">Cancel</a>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@stop


