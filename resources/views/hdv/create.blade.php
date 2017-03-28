@extends('layouts.app')

@section('content')
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

<div class="panel panel-default main-content">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm Hướng dẫn viên</h3>
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
        'route' => 'hdv.store','method'=>'POST', 'files'=>true, 'class' => 'form-horizontal', 'id' => 'create_hdv'
    ]) !!}


    <div class="form-group">
        {!! Form::label('name', 'Tên HDV:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Tên HDV']) !!}
        </div>
    </div>
    
    <div class="form-group">
        {!! Form::label('email', 'Email HDV:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email HDV']) !!}
        </div>
    </div>
    
    <div class="form-group">
        {!! Form::label('address', 'Địa chỉ HDV:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Địa chỉ HDV']) !!}
        </div>
    </div>
    
    <div class="form-group">
        {!! Form::label('phone', 'Phone HDV:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Phone HDV']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('images[]', 'Ảnh:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <input type="file" name="images1[]">
        </div>
    </div>
    
    <div class="form-group">
        {!! Form::label('tieu_su', 'Mô tả:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('tieu_su', null, ['class' => 'form-control summernote', 'placeholder' => 'Mô tả']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Tạo mới', ['class' => 'btn btn-primary']) !!}
        <div class="btn btn-default">{{ link_to_route('hdv.index', 'Danh sách HDV') }}</div>
    </div>

    {!! Form::close() !!}
</div>

<script type="text/javascript">
$(document).ready(function(){
  $('#create_hdv').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) { 
      e.preventDefault();
      return false;
    }
  });
  
  $('.summernote').summernote({
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