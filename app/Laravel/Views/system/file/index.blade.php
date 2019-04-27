@extends('system._layouts.main')

@section('content')
<div class="main-content container-fluid">
  <div class="row">
    <div class="col-md-12">
      @include('system._components.notifications')
      <div class="panel panel-default panel-table  panel-border-color panel-border-color-success">
        <div class="panel-heading">Record Data
          <div class="tools dropdown">
            <a href="#" type="button" data-toggle="dropdown" class="dropdown-toggle"><span class="icon mdi mdi-more-vert"></span></a>
            <ul role="menu" class="dropdown-menu pull-right">
              <li><a href="{{route('system.file.create')}}">Add new record</a></li>
              {{-- <li><a href="#">Import Calendar</a></li> --}}
              {{-- <li class="divider"></li> --}}
              {{-- <li><a href="#">Export calendar</a></li> --}}
            </ul>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-hover table-wrapper">
            <thead>
              <tr>
                <th >Filename</th>
                <th style="width:50%;" class="text-left">File</th>
                <th class="text-center">Type</th>
                <th style="width:10%;">Date Added</th>
                <th class="actions" style="width:15%;"></th>
              </tr>
            </thead>
            <tbody>
              @forelse($files as $index => $file)
              <tr>
                <td class="cell-detail"> 
                  <span>
                    <a target="_blank"
                      @if($file->type == "image")
                      href="{{"{$file->new_directory}/resized/{$file->filename}"}}"
                      @else
                      href="{{"{$file->new_directory}/{$file->filename}"}}"
                      @endif 
                      >
                      {{$file->custom_filename}}
                    </a>
                  </span>
                  <span class="cell-detail-description">{{"ID ".str_pad($file->id, 4, "0", STR_PAD_LEFT)}}</span>
                </td>
                <td class="cell-detail">
                  <span>
                    <input type="text" value="{{ $file->type == "image" ? "{$file->new_directory}/resized/{$file->filename}" : "{$file->new_directory}/{$file->filename}" }}" class="form-control input-xs focus" readonly="readonly">
                  </span>
                  <span class="cell-detail-description">Full Path</span>
                </td>
                <td class="cell-detail text-center">
                  @if($file->type == "image")
                  <span><small class="label label-success">IMAGE</small></span>
                  @else
                  <span><small class="label label-primary">FILE</small></span>
                  @endif
                </td>
                <td class="cell-detail">
                  <span>{{Helper::date_only($file->created_at)}}</span>
                  <span class="cell-detail-description">{{Helper::date_format($file->created_at,"h:i A")}}</span>
                </td>
                <td class="actions">
                    <div class="btn-group btn-hspace">
                      <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false"><i class="icon icon-left mdi mdi-settings"></i> Actions <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                      <ul role="menu" class="dropdown-menu">
                        <li><a href="{{route('system.file.edit',[$file->id])}}">Edit Record</a></li>
                        <li class="divider"></li>
                        <li><a class="action-delete" href="#" data-url="{{route('system.file.destroy',[$file->id])}}" data-toggle="modal" data-target="#confirm-delete" title="Remove Record">Remove Record</a></li>
                      </ul>
                    </div>
                </td>
              </tr>
              @empty
              <td colspan="4" class="text-left"><i>No record found yet.</i> <a href="{{route('system.file.create')}}"><strong>Click here</strong></a> to upload one.</td>
              @endforelse
            </tbody>
          </table>
          
        </div>
        <div class="panel-footer">
          <div class="pagination-wrapper text-center">
            {!!$files->render()!!}
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@stop

@section('page-modals')
<div id="confirm-delete" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h1 class="modal-title">Confirm your action</h1>
      </div>

      <div class="modal-body">
        <div role="alert" class="alert alert-warning alert-icon alert-icon-border alert-dismissible">
          <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
          <div class="message">
            <strong>Warning!</strong> This action can not be undone.
          </div>
        </div>
        <h3 class="text-semibold">Are you sure ...</h3>
        <p>You are about to delete the record?</strong></p>

        <hr>

        <h3 class="text-semibold">What is this message?</h3>
        <p>This dialog appears everytime when the chosen action could hardly affect the system. Usually, it occurs when the system is issued a delete command or upon submission of your task of the day.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
        <a href="#" data-loading-text="<i class='icon-spinner2 spinner position-left'></i> Removing record ..." class="btn btn-primary btn-raised btn-loading" id="btn-confirm-delete">Delete Record</a>
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
    $(".action-delete").on("click",function(){
      var btn = $(this);
      $("#btn-confirm-delete").attr({"href" : btn.data('url')});
    });

    $(".focus").on("click",function(){
      $(this).select();
    })

    $('#btn-confirm-delete').on('click', function() {
      $('.btn-link').hide();
          $('.btn-loading').button('loading');
          $('#target').submit();
     });

  });
</script>
@stop

