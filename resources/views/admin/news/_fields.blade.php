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
    {{ Form::label('news_title', 'Judul') }}
    {{ Form::text('title',$news->title,['class'=>'form-control border-input','placeholder'=>'Berita Museum']) }}
    <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
    {{ Form::label('news_content', 'Konten Berita') }}
    {{ Form::textarea('content',$news->content,['class'=>'form-control border-input','placeholder'=>'Isi Berita']) }}
    <span class="text-danger">{{ $errors->has('content') ? $errors->first('content') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
    <input type="hidden" name="created_by" value="<?php
        echo auth()->guard('admin')->check() ? auth()->guard()->user()->name : 'Account'
    ?>">
</div>

<div class="form-group">
    <label for="email" class="col-md-4 control-label">Gambar</label>
    <div class="col-md-6">
        @if($news->id == '')
        <img width="200" height="200" />
        <input type="file" class="uploads form-control" style="margin-top: 20px;" name="image">
        @else
        <img width="200" height="200" src="{{ url('uploads').'/news/500/'. $news->image }}">
        <input type="file" class="uploads form-control" style="margin-top: 20px;" name="image">
        {{ $news->image == url('uploads').'/news/500/'. $news->image }}
        @endif
    </div>
</div>