  @extends('SMS.Coordinator.CoordinatorMain')
  @section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Announcements
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('coordinator/index') }}"><i class="fa fa-dashboard"></i> Coordinator</a></li>
        <li>Mail</li>
        <li class="active">Announcements</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="container col-sm-12">
          <div class="box box-danger">
            <div class="modal fade" id="add_announcement">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    {{ Form::button('&times;', [
                      'class' => 'close',
                      'type' => '',
                      'data-dismiss' => 'modal'
                      ]) 
                    }}
                    <h4>Create Announcement</h4>
                  </div>
                  <div class="modal-body">
                    {{ Form::open([
                      'id' => 'frmAnnouncement', 'data-parsley-whitespace' => 'squish'])
                    }}

                    <div class="form-group">
                      <input class="form-control" type="text" name="title" placeholder="Subject:">
                    </div>
                    <div class="form-group">
                      <textarea id="compose-textarea" name="description" class="form-control" style="resize: none; height: 300px"></textarea>
                    </div>
                    <div class="form-group">
                      <div class="btn btn-default btn-file">
                        <i class="fa fa-paperclip"></i> Attachment
                        <input type="file" name="pdf">
                      </div>
                      <p class="help-block">Max. 32MB</p>
                    </div>
                    <div class="form-group">
                      {{ Form::button('Submit', [
                        'id' => 'btn-save',
                        'class' => 'btn btn-success btn-block',
                        'value' => 'add',
                        'type' => ''
                        ]) 
                      }}
                    </div>
                    {{ Form::close() }}
                  </div>
                </div>
              </div>
            </div>
            <div class="box-body table-responsive">
              {{ Form::button("<i class='fa fa-plus'></i> Create Announcement", [
                'id' => 'btn-add',
                'class' => 'btn btn-primary btn-sm',
                'value' => 'add',
                'type' => '',
                'style' => 'margin-bottom: 10px;'
                ]) 
              }}
              <table id="district-table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                <thead>
                  <th>Title</th>
                  <th>Date Posted</th>
                  <th>Action</th>
                </thead>
                <tbody id="district-list">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
    @endsection
    @section('script')
    {!! Html::script("custom/CoordinatorAnnouncementAjax.js") !!}
    <script type="text/javascript">
      var dataurl = "{!! route('coordinatorannouncements.data') !!}";
    </script>
    @endsection