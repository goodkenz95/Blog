@extends('system._layouts.main')

@section('content')
<div class="main-content container-fluid">
  <div class="row">
    <div class="col-md-8">
      @include('system._components.notifications')
      <div class="panel panel-default panel-border-color panel-border-color-success">
        <div class="panel-heading panel-heading-divider">Update Record Form<span class="panel-subtitle">Page information.</span></div>
        <div class="panel-body">
          <form method="POST" action="" enctype="multipart/form-data">
            {!!csrf_field()!!}
            <div class="form-group {{$errors->first('title') ? 'has-error' : NULL}}">
              <label>Title</label>
              <input type="text" placeholder="Page title" class="form-control" name="title" value="{{old('title',$page->title)}}">
              @if($errors->first('title'))
              <span class="help-block">{{$errors->first('title')}}</span>
              @endif
            </div>


            <div class="form-group {{$errors->first('content') ? 'has-error' : NULL}}">
              <label>Content</label>
              <textarea name="content" id="content" cols="30" rows="10" class="form-control editor">{!!old('content',$page->content)!!}</textarea>
              @if($errors->first('content'))
              <span class="help-block">{{$errors->first('content')}}</span>
              @endif
            </div>

            <div class="row xs-pt-15">
              <div class="col-xs-6">
                  <button type="submit" class="btn btn-space btn-success">Update Record</button>
                  <a href="{{route('system.page.index')}}" class="btn btn-space btn-default">Cancel</a>
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
<link rel="stylesheet" type="text/css" href="{{asset('assets/lib/summernote/summernote.css')}}"/>
@stop

@section('page-scripts')
<script src="{{asset('assets/lib/summernote/summernote.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  $(function(){
    $('.editor').summernote({height:300})
  })
</script>
@stop