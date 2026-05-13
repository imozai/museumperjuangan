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

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {{ Form::label('koleksi_name', 'Nama Koleksi') }}
    {{ Form::text('name',$koleksi->name,['class'=>'form-control border-input','placeholder'=>'Patung']) }}
    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    {{ Form::label('description', 'Deskripsi') }}
    {{ Form::textarea('description',$koleksi->description,['class'=>'form-control border-input','placeholder'=>'Description']) }}
    <span class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('sejarah') ? 'has-error' : '' }}">
    {{ Form::label('sejarah', 'Sejarah Singkat') }}
    {{ Form::textarea('sejarah',$koleksi->sejarah,['class'=>'form-control border-input','placeholder'=>'Sejarah Singkat Koleksi']) }}
    <span class="text-danger">{{ $errors->has('sejarah') ? $errors->first('sejarah') : '' }}</span>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('lantai') ? 'has-error' : '' }}">
            {{ Form::label('lantai', 'Lantai') }}
            @if($koleksi->id == '')
                {{ Form::select('lantai', array('Atas' => 'Atas', 'Bawah' => 'Bawah'), 'Atas', ['class'=>'form-control border-input']) }}
            @else
                {{ Form::select('lantai', array('Atas' => 'Atas', 'Bawah' => 'Bawah'), '$koleksi->lantai', ['class'=>'form-control border-input']) }}
            @endif
            <span class="text-danger">{{ $errors->has('lantai') ? $errors->first('lantai') : '' }}</span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('slide') ? 'has-error' : '' }}">
            {{ Form::label('slide', 'Tampil Slider Halaman Utama') }}<br>
            @if($koleksi->slide != '1')
                <input name="slide" type="checkbox" data-toggle="toggle" data-on="<span class='mdi mdi-folder-multiple-image'></span> Tampil" data-off="<span class='mdi mdi-folder-multiple-image'></span> Tidak Tampil" data-size="small" data-width="130" data-onstyle="outline-dark bg-dark text-white" data-offstyle="outline-light text-black" data-style="border">
            @else
                <input name="slide" type="checkbox" data-toggle="toggle" data-on="<span class='mdi mdi-folder-multiple-image'></span> Tampil" data-off="<span class='mdi mdi-folder-multiple-image'></span> Tidak Tampil" data-size="small" data-width="130" data-onstyle="outline-dark bg-dark text-white" data-offstyle="outline-light text-black" data-style="border" checked>
            @endif
        </div>
    </div>
</div>


<div class="form-group">
    <label for="email" class="col-md-4 control-label">Gambar</label>
    <div class="col-md-6">
        @if($koleksi->id == '')
        <img width="200" height="200" />
        <input type="file" class="uploads form-control" style="margin-top: 20px;" name="image">
        @else
        <img width="200" height="200" src="{{ url('uploads').'/image/500/'. $koleksi->image }}">
        <input type="file" class="uploads form-control" style="margin-top: 20px;" name="image">
        {{ $koleksi->image == url('uploads').'/image/500/'. $koleksi->image }}
        @endif
    </div>
</div>