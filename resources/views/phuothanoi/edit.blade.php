@extends('layouts.app_admin')

@section('content')
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

<div class="panel panel-default main-content">
    <div class="panel-heading">
        <h3 class="panel-title">Sửa Tour</h3>
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
<?php 
//    $phuongtien = explode(";",'phuongtien' . $tour['phuong_tien']);
    $xe_dap = strpos('phuongtien' . $tour['phuong_tien'], '1');
    $xe_may = strpos('phuongtien' . $tour['phuong_tien'], '2');
    $o_to = strpos('phuongtien' . $tour['phuong_tien'], '3');
    $may_bay = strpos('phuongtien' . $tour['phuong_tien'], '4');
//            var_dump($tour->type);die;
    
    ?>
{{ Form::model($tour, array('method' => 'PATCH', 'route' => array('tour.update', $tour->id), 'files'=>true, 'class' => 'form-horizontal')) }}
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <?php
        $temp = substr($tour->images,0,-1);
        $images = explode( ';', $temp ); 
        
        foreach ($images as $image) {
    ?>
       <img src="{{ URL::to('/') }}/images/{{ $image }}" alt="" width="120px" height="90px" /></td> 
    <?php 
        }
        ?>
    </div>
</div>
<div class="form-group">
        {!! Form::label('ten_tour', 'Tên Tour:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('ten_tour', null, ['class' => 'form-control', 'placeholder' => 'Tên Tour']) !!}
        </div>
    </div>
    
    <div class="form-group">
        {!! Form::label('ngay_khoi_hanh', 'Ngày khởi hành:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
        {!! Form::text('ngay_khoi_hanh', $tour->ngay_khoi_hanh, ['class' => 'form-control', 'id' => 'ngay_khoi_hanh', 'placeholder' => 'Ngày khởi hành']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('ngay_ket_thuc', 'Ngày kết thúc:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
        {!! Form::text('ngay_ket_thuc', $tour->ngay_ket_thuc, ['class' => 'form-control', 'id' => 'ngay_ket_thuc', 'placeholder' => 'Ngày kết thúc']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('lich_trinh', 'Lịch trình:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('lich_trinh', $tour->lich_trinh, ['class' => 'form-control summernote', 'placeholder' => 'Lịch trình']) !!}
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
        <div class="col-sm-6">
        {!! Form::text('gia_tour', $tour->gia_tour, ['class' => 'form-control', 'placeholder' => 'Giá ( VNĐ )']) !!}
        </div>
        <div class="col-sm-2">
            {{ Form::select('don_vi', ['Lựa chọn đơn vị', 'Ngàn', 'Triệu'], 1, ['class' => 'form-control']) }}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('phuong_tien', 'Phương tiện:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-2">
            Xe Đạp: {{ Form::checkbox('xe_dap', 1, $xe_dap) }}
        </div>
        <div class="col-sm-2">
            Xe Máy: {{ Form::checkbox('xe_may', 1, $xe_may) }}
        </div>
        <div class="col-sm-2">
            Ô tô: {{ Form::checkbox('o_to', 1, $o_to) }}
        </div>
        <div class="col-sm-2">
            Máy bay: {{ Form::checkbox('may_bay', 1, $may_bay) }}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('kieu_tour', 'Kiểu tour:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
            {{ Form::select('kieu_tour', ['Lựa chọn tour', 'Thám hiểm', 'Mạo hiểm', 'Chụp hình'], $tour->kieu_tour, ['class' => 'form-control']) }}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('nguoi_dan', 'Người dẫn:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
        {!! Form::select('nguoi_dan', $hdvs, $tour->nguoi_dan, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        {{ Form::submit('Lưu', array('class' => 'btn btn-info')) }} 
        {{ link_to_route('tour.show', 'Cancel', $tour->id, array('class' => 'btn btn-default')) }}
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
    
    addEventListener('DOMContentLoaded', function () {
        var ngay_khoi_hanh = new Date('{{$tour->ngay_khoi_hanh}}');
        var ngay_ket_thuc = new Date('{{$tour->ngay_ket_thuc}}');
        pickmeup('input#ngay_khoi_hanh', {
            position       : 'right',
            hide_on_select : true
        }).set_date(ngay_khoi_hanh);

        pickmeup('input#ngay_ket_thuc', {
            position       : 'right',
            hide_on_select : true
        }).set_date(ngay_ket_thuc);
    });
});
</script> 

@stop