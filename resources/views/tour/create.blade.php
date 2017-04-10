@extends('layouts.app_admin')

@section('content')
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

<div class="panel panel-default main-content">
    <div class="panel-heading">
        <h3 class="panel-title">Tạo Tour</h3>
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
        'route' => 'tour.store','method'=>'POST', 'files'=>true, 'class' => 'form-horizontal', 'id' => 'create_tour'
    ]) !!}


    <div class="form-group">
        {!! Form::label('ten_tour', 'Tên Tour:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('ten_tour', null, ['class' => 'form-control', 'placeholder' => 'Tên Tour']) !!}
        </div>
    </div>
    
    <div class="form-group">
        {!! Form::label('ngay_khoi_hanh', 'Ngày khởi hành:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
        {!! Form::text('ngay_khoi_hanh', null, ['class' => 'form-control', 'id' => 'ngay_khoi_hanh', 'placeholder' => 'Ngày khởi hành']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('ngay_ket_thuc', 'Ngày kết thúc:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
        {!! Form::text('ngay_ket_thuc', null, ['class' => 'form-control', 'id' => 'ngay_ket_thuc', 'placeholder' => 'Ngày kết thúc']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('lich_trinh', 'Lịch trình:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('lich_trinh', null, ['class' => 'form-control', 'id' => 'summernote', 'placeholder' => 'Lịch trình']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('images[]', 'Ảnh:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <input type="file" name="images1[]" multiple>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('gia_tour', 'Giá tour:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-4">
        {!! Form::text('gia_tour', null, ['class' => 'form-control', 'placeholder' => 'Giá ( VNĐ )']) !!}
        </div>
        <div class="col-sm-2">
<!--        {{ Form::select('don_vi', ['Lựa chọn tour', 'Thám hiểm', 'Mạo hiểm', 'Chụp hình'], null, ['class' => 'field']) }}-->
            {{ Form::select('don_vi', ['Lựa chọn đơn vị', 'Ngàn', 'Triệu'], 1, ['class' => 'form-control']) }}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('phuong_tien', 'Phương tiện:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-2">
            Xe Đạp: {{ Form::checkbox('xe_dap') }}
        </div>
        <div class="col-sm-2">
            Xe Máy: {{ Form::checkbox('xe_may') }}
        </div>
        <div class="col-sm-2">
            Ô tô: {{ Form::checkbox('o_to') }}
        </div>
        <div class="col-sm-2">
            Máy bay: {{ Form::checkbox('may_bay') }}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('kieu_tour', 'Kiểu tour:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
            {{ Form::select('don_vi', ['Lựa chọn tour', 'Thám hiểm', 'Mạo hiểm', 'Chụp hình'], null, ['class' => 'form-control']) }}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('nguoi_dan', 'Người dẫn:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
        {!! Form::select('nguoi_dan', $hdvs, null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Tạo mới', ['class' => 'btn btn-primary']) !!}
        <div class="btn btn-default">{{ link_to_route('tour.index', 'Danh sách tours') }}</div>
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
  
  $('#summernote').summernote({
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
  
    addEventListener('DOMContentLoaded', function () {
        pickmeup('input#ngay_khoi_hanh', {
            position       : 'right',
            hide_on_select : true
        });

        pickmeup('input#ngay_ket_thuc', {
            position       : 'right',
            hide_on_select : true
        });
    });
});
</script> 



@stop