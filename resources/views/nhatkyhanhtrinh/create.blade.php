@extends('layouts.app_admin')

@section('content')
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

<div class="panel panel-default main-content">
    <div class="panel-heading">
        <h3 class="panel-title">Tạo nhật ký hành trình</h3>
    </div>
    <div class="panel-body">
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif

    {!! Form::open([
        'route' => 'nhatkyhanhtrinh.store','method'=>'POST', 'files'=>true, 'class' => 'form-horizontal', 'id' => 'create_tour'
    ]) !!}


    <div class="form-group">
        {!! Form::label('ten_diadanh', 'Tên hành trình:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('ten_diadanh', null, ['class' => 'form-control', 'placeholder' => 'Tên hành trình']) !!}
        </div>
    </div>
    
    <div class="form-group">
        {!! Form::label('sub_mo_ta', 'Sub mô tả:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('sub_mo_ta', null, ['class' => 'form-control summernote', 'placeholder' => 'Sub mô tả']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('mo_ta', 'Mô tả:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('mo_ta', null, ['class' => 'form-control summernote', 'placeholder' => 'Mô tả']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('images[]', 'Ảnh:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <input type="file" name="images1[]" multiple>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('type', 'Kiểu tour:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
            {{ Form::select('type', ['Thám hiểm', 'Mạo hiểm', 'Chụp hình'], 0, ['class' => 'form-control']) }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Tạo mới', ['class' => 'btn btn-primary']) !!}
        <div class="btn btn-default">{{ link_to_route('nhatkyhanhtrinh.index', 'Danh sách nhật ký hành trình') }}</div>
    </div>

    {!! Form::close() !!}
</div>

<script type="text/javascript">
$(document).ready(function(){
  $('#create_tour').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) { 
      e.preventDefault();
      return false;
    }
  });
  
  $('.summernote').summernote({
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontsize', ['fontsize']],
        ['fontname', ['fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'hr']],
        ['view', ['fullscreen', 'codeview']],
        ['help', ['help']]
      ],
    height:300,
    callbacks: {
        onImageUpload : function(files, editor, welEditable) {
             for(var i = files.length - 1; i >= 0; i--) {
                     sendFile(files[i], this);
            }
        }
    }
  });
    
    function sendFile(file, el) {
        var form_data = new FormData();
        form_data.append("_token","{{ csrf_token() }}");
        form_data.append('file', file);
        $.ajax({
            data: form_data,
            type: "POST",
            url: '{{ URL::to('/') }}/ajaximage',
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                $(el).summernote('editor.insertImage', url);
            }
        });
    }
});
</script> 



@stop