@extends('system._layouts.main')

@section('content')
<div class="main-content container-fluid">
  <div class="row">
    <div class="col-md-6">
      @include('system._components.notifications')
      <div class="panel panel-default panel-border-color panel-border-color-success">
        <div class="panel-heading panel-heading-divider">Update Record Form<span class="panel-subtitle">File information.</span></div>
        <div class="panel-body">
          <form method="POST" action="" enctype="multipart/form-data">
            {!!csrf_field()!!}
            
            <div class="form-group {{$errors->first('custom_filename') ? 'has-error' : NULL}}">
              <label>Filename</label>
              <input type="text" placeholder="Custom Filename" class="form-control" name="custom_filename" value="{{old('custom_filename')}}">
              @if($errors->first('custom_filename'))
              <span class="help-block">{{$errors->first('custom_filename')}}</span>
              @endif
            </div>

            <div class="form-group {{$errors->first('file') ? 'has-error' : NULL}}">
              <label>File</label>
              <input type="file"  class="form-control form-file" name="file" value="{{old('file')}}">
              @if($errors->first('file'))
              <span class="help-block">{{$errors->first('file')}}</span>
              @endif
            </div>

            <div class="form-group {{$errors->first('file') ? 'has-error' : NULL}}">
              @if($file->filename)
              <label>Current {{$file->type == "image" ? "Image Uploaded" : "File Uploaded"}}</label>
              <input type="text" value="{{ $file->type == "image" ? "{$file->new_directory}/resized/{$file->filename}" : "{$file->new_directory}/{$file->filename}" }}" class="form-control input-xs focus" readonly="readonly">
              @if($file->type == "image")
              <img src="{{"{$file->new_directory}/resized/$file->filename"}}" alt="" class="img-thumbnail">
              @else
              <a target="_blank" href="{{$file->new_directory.'/'.$file->filename}}">{{$file->new_directory.'/'.$file->filename}}</a>
              @endif



              @else
              <label for="">File Uploaded</label>
              <p>No uploaded file</p>
              @endif
            </div>

            <div class="form-group {{$errors->first('type') ? 'has-error' : NULL}}">
              <label>File Type</label>
              {!!Form::select('type',$file_types,old('type','active'),['class' => "form-control"])!!}
              @if($errors->first('type'))
              <span class="help-block">{{$errors->first('type')}}</span>
              @endif
            </div>
            
            <div class="row xs-pt-15">
              <div class="col-xs-6">
                  <button type="submit" class="btn btn-space btn-success">Update Record</button>
                  <a href="{{route('system.file.index')}}" class="btn btn-space btn-default">Cancel</a>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('page-scripts')

<script type="text/javascript">
  $(function(){
    $(".focus").on("click",function(){
      $(this).select();
    })
  })
</script> 
@stop


