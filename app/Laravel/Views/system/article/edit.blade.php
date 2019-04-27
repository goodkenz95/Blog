@extends('system._layouts.main')

@section('content')
<div class="main-content container-fluid">
  <div class="row">
    <div class="col-md-8">
      @include('system._components.notifications')
      <div class="panel panel-default panel-border-color panel-border-color-success">
        <div class="panel-heading panel-heading-divider">Update Record Form<span class="panel-subtitle">Article information.</span></div>
        <div class="panel-body">
          <form method="POST" action="" enctype="multipart/form-data">
            {!!csrf_field()!!}
            @if($article->filename)
            <div class="form-group">
              <label for="">Current Thumbnail</label>
              <img src="{{"{$article->directory}/resized/$article->filename"}}" alt="" class="img-thumbnail">
            </div>
            @endif
            <div class="form-group {{$errors->first('title') ? 'has-error' : NULL}}">
              <label>Title</label>
              <input type="text" placeholder="Title of the article" class="form-control" name="title" value="{{old('title',$article->title)}}">
              @if($errors->first('title'))
              <span class="help-block">{{$errors->first('title')}}</span>
              @endif
            </div>

            <div class="form-group {{$errors->first('category_id') ? 'has-error' : NULL}}">
              <label>Category</label>
              {!!Form::select('category_id',$categories,old('category_id',$article->category_id),['class' => "form-control"])!!}
              @if($errors->first('category_id'))
              <span class="help-block">{{$errors->first('category_id')}}</span>
              @endif
            </div>

            <div class="form-group {{$errors->first('file') ? 'has-error' : NULL}}">
              <label>Thumbnail</label>
              <input type="file"  class="form-control form-file" name="file" value="{{old('file')}}">
              @if($errors->first('file'))
              <span class="help-block">{{$errors->first('file')}}</span>
              @endif
            </div>

            <div class="form-group {{$errors->first('video_url') ? 'has-error' : NULL}}">
              <label>Video URL</label>
              <input type="text" placeholder="URL of the video eg. https://youtu.be/C0DPdy98e4c" class="form-control" name="video_url" value="{{old('video_url',$article->video_url)}}">
              @if($errors->first('video_url'))
              <span class="help-block">{{$errors->first('video_url')}}</span>
              @endif
            </div>

            <div class="form-group {{$errors->first('content') ? 'has-error' : NULL}}">
              <label>Content</label>
              <textarea name="content" cols="30" id="content" rows="10" class="form-control editor">{!!old('content',$article->content)!!}</textarea>
              @if($errors->first('content'))
              <span class="help-block">{{$errors->first('content')}}</span>
              @endif
            </div>

            @if($auth->type == "editor")
            {!!Form::hidden('is_approved',$article->is_approved)!!}
            @else

            <div class="form-group {{$errors->first('is_approved') ? 'has-error' : NULL}}">
              <label>Status</label>
              {!!Form::select('is_approved',$statuses,old('is_approved',$article->is_approved),['class' => "form-control"])!!}
              @if($errors->first('is_approved'))
              <span class="help-block">{{$errors->first('is_approved')}}</span>
              @endif
            </div>
            @endif
            
            <div class="row xs-pt-15">
              <div class="col-xs-6">
                  <button type="submit" class="btn btn-space btn-success">Update Record</button>
                  <a href="{{route('system.article.index')}}" class="btn btn-space btn-default">Cancel</a>
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
<link rel="stylesheet" type="text/css" href="{{asset('assets/lib/ckeditor/contents.css')}}"/>
@stop

@section('page-scripts')
<script src="{{asset('assets/lib/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  $(function(){
    CKEDITOR.replace( 'content' );

  })
</script>
@stop