@section('js')
    <script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
                return false
            })
        })
    </script>
@stop

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    {{ Form::label('event_title', 'Judul') }}
    {{ Form::text('title',$event->title,['class'=>'form-control border-input','placeholder'=>'Event Museum']) }}
    <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
    {{ Form::label('event_content', 'Konten Event') }}
    {{ Form::textarea('content',$event->content,['class'=>'form-control border-input','placeholder'=>'Isi Event']) }}
    <span class="text-danger">{{ $errors->has('content') ? $errors->first('content') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('tempat') ? 'has-error' : '' }}">
    {{ Form::label('tempat', 'Tempat Berlangsung Event') }}
    @if($event->id == '')
        {{ Form::select('tempat', array('Museum Perjuangan Yogyakarta' => 'Museum Perjuangan Yogyakarta', 'Museum Vredeburg Yogyakarta' => 'Museum Vredeburg Yogyakarta'), 'Museum Perjuangan Yogyakarta', ['class'=>'form-control border-input']) }}
    @else
        {{ Form::select('tempat', array('Museum Perjuangan Yogyakarta' => 'Museum Perjuangan Yogyakarta', 'Museum Vredeburg Yogyakarta' => 'Museum Vredeburg Yogyakarta'), '$event->tempat', ['class'=>'form-control border-input']) }}
    @endif
    <span class="text-danger">{{ $errors->has('tempat') ? $errors->first('tempat') : '' }}</span>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('tgl_mulai') ? ' has-error' : '' }}">
            <label for="tgl_mulai" class="col-md-4 control-label">Tanggal Mulai Event</label>
            <div class="col-md-3">
                @if($event->id == '')
                    <input id="tgl_mulai" type="date" class="form-control" name="tgl_mulai" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required>
                @else
                    <input id="tgl_mulai" type="date" class="form-control" name="tgl_mulai" value="<?php echo date("Y-m-d", strtotime($event->tgl_mulai)); ?>" required>
                @endif
                <!-- -->
                @if ($errors->has('tgl_mulai'))
                <span class="help-block">
                    <strong>{{ $errors->first('tgl_mulai') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('jam_mulai') ? ' has-error' : '' }}">
            <label for="jam_mulai" class="col-md-4 control-label">JAM Mulai</label>
            <div class="col-md-3">
                @if($event->id == '')
                    <input id="jam_mulai" type="time"  class="form-control" name="jam_mulai" value="{{ date('H:i', strtotime(Carbon\Carbon::today()->toDateString().'+8 hours')) }}">
                @else
                    <input id="jam_mulai" type="time"  class="form-control" name="jam_mulai" value="<?php echo date("H:i", strtotime($event->tgl_mulai)); ?>">
                @endif
                <!-- -->
                @if ($errors->has('jam_mulai'))
                <span class="help-block">
                    <strong>{{ $errors->first('jam_mulai') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('tgl_selesai') ? ' has-error' : '' }}">
            <label for="tgl_selesai" class="col-md-4 control-label">Tanggal Berakhir Event</label>
            <div class="col-md-3">
                @if($event->id == '')
                    <input id="tgl_selesai" type="date"  class="form-control" name="tgl_selesai" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(5)->toDateString())) }}" required="">
                @else
                    <input id="tgl_selesai" type="date"  class="form-control" name="tgl_selesai" value="<?php echo date("Y-m-d", strtotime($event->tgl_selesai)); ?>" required="">
                @endif
                <!-- -->
                @if ($errors->has('tgl_selesai'))
                <span class="help-block">
                    <strong>{{ $errors->first('tgl_selesai') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    <!-- JAM -->
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('jam_selesai') ? ' has-error' : '' }}">
            <label for="jam_selesai" class="col-md-4 control-label">JAM Berakhir</label>
            <div class="col-md-3">
                @if($event->id == '')
                    <input id="jam_selesai" type="time"  class="form-control" name="jam_selesai" value="{{ date('H:i', strtotime(Carbon\Carbon::today()->toDateString().'+12 hours')) }}">
                @else
                    <input id="jam_selesai" type="time"  class="form-control" name="jam_selesai" value="<?php echo date("H:i", strtotime($event->tgl_selesai)); ?>">
                @endif
                <!-- -->
                @if ($errors->has('jam_selesai'))
                <span class="help-block">
                    <strong>{{ $errors->first('jam_selesai') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('created_by') ? 'has-error' : '' }}">
    <input type="hidden" name="created_by" value="<?php
        echo auth()->guard('admin')->check() ? auth()->guard()->user()->name : 'Account'
    ?>">
    <span class="text-danger">{{ $errors->has('created_by') ? $errors->first('created_by') : '' }}</span>
</div>

<div class="form-group">
    <label for="email" class="col-md-4 control-label">Gambar</label>
    <div class="col-md-6">
        @if($event->id == '')
        <img width="200" height="200" />
        <input type="file" class="uploads form-control" style="margin-top: 20px;" name="image">
        @else
        <img width="200" height="200" src="{{ url('uploads').'/event/500/'. $event->image }}">
        <input type="file" class="uploads form-control" style="margin-top: 20px;" name="image">
        {{ $event->image == url('uploads').'/event/500/'. $event->image }}
        @endif
    </div>
</div>