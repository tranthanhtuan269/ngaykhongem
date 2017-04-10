@extends('layouts.app_admin')

@section('content')
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

<div class="panel panel-primary main-content">
    <div class="panel-heading">
        <h3 class="panel-title">Sửa bài trang chủ</h3>
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
        {!! Form::label('gioi_thieu', 'Trang chủ:', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::textarea('gioi_thieu', $gioithieu->textout, ['class' => 'form-control', 'id' => 'summernote', 'placeholder' => 'Lịch trình']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div id="suagioithieu_btn" class="btn btn-primary">Lưu lại</div>
        </div>
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
            url: "{{ URL::to('/') }}/ajaximage",
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                $(el).summernote('editor.insertImage', url);
            }
        });
    }
    
    $("#suagioithieu_btn").click(function(){
        var _sefl = $(this);

        var gioi_thieu = $("#summernote").val();

        var request = $.ajax({
            url: "{{ URL::to('/') }}/sua-gioi-thieu",
            method: "POST",
            data: { 
                "gioi_thieu" : gioi_thieu, 
                "_token" : "{!! csrf_token() !!}",
            },
            dataType: "json"
        });

        request.done(function( msg ) {
            if(msg.code==1){
                $.toast({
                    text: 'Bạn đã sửa trang chủ thành công! Xin cám ơn!', // Text that is to be shown in the toast
                    heading: 'Sửa trang chủ thành công', // Optional heading to be shown on the toast
                    icon: 'success', // Type of toast icon
                    showHideTransition: 'plain', // fade, slide or plain
                    allowToastClose: true, // Boolean value true or false
                    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    textAlign: 'left',  // Text alignment i.e. left, right or center
                    loader: true,  // Whether to show loader or not. True by default
                    loaderBg: '#9EC600',  // Background color of the toast loader
                });
            }else if(msg.code==0){
                $.toast({
                    text: 'Bạn đã sửa trang chủ không thành công! <br />Xin hãy liên hệ ban quản trị!', // Text that is to be shown in the toast
                    heading: 'Sửa trang chủ không thành công', // Optional heading to be shown on the toast
                    icon: 'error', // Type of toast icon
                    showHideTransition: 'plain', // fade, slide or plain
                    allowToastClose: true, // Boolean value true or false
                    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    textAlign: 'left',  // Text alignment i.e. left, right or center
                    loader: true,  // Whether to show loader or not. True by default
                    loaderBg: '#9EC600',  // Background color of the toast loader
                });
            }else if(msg.code==3){
                $.toast({
                    text: 'Bạn phải đăng nhập để sử dụng tác vụ này! Xin cám ơn!', // Text that is to be shown in the toast
                    heading: 'Sửa trang chủ không thành công', // Optional heading to be shown on the toast
                    icon: 'error', // Type of toast icon
                    showHideTransition: 'plain', // fade, slide or plain
                    allowToastClose: true, // Boolean value true or false
                    hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    textAlign: 'left',  // Text alignment i.e. left, right or center
                    loader: true,  // Whether to show loader or not. True by default
                    loaderBg: '#9EC600',  // Background color of the toast loader
                });

                window.setTimeout(function() {
                    window.location.href = "{{ URL::to('/') }}/login";
                }, 5000);
            }
        });

        request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        });
    });
});
</script> 



@stop