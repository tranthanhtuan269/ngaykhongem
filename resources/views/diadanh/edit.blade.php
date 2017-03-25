@extends('layouts.app')

@section('content')

<!-- include libraries(jQuery, bootstrap) -->
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> 
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

<div class="panel panel-default main-content">
    <div class="panel-heading">
        <h3 class="panel-title">Sửa địa danh</h3>
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
        
        {{ Form::model($diadanh, array('method' => 'PATCH', 'route' => array('diadanh.update', $diadanh->id), 'files'=>true, 'class' => 'form-horizontal')) }}
        <div class="form-group">
            {!! Form::label('ten_diadanh', 'Tên địa danh:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('ten_diadanh', null, ['class' => 'form-control', 'placeholder' => 'Tên địa danh']) !!}
            </div>
        </div>
        
        <div class="form-group">
            {!! Form::label('sub_mo_ta', 'Sub mô tả:', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('sub_mo_ta', $diadanh->sub_mo_ta, ['class' => 'form-control summernote', 'placeholder' => 'Sub mô tả']) !!}
            </div>
        </div>

            <div class="form-group">
                {!! Form::label('mo_ta', 'Mô tả:', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('mo_ta', $diadanh->mo_ta, ['class' => 'form-control summernote', 'placeholder' => 'Mô tả']) !!}
                </div>
            </div>
        
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <?php
                    $temp = substr($diadanh->images,0,-1);
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
                {!! Form::label('images[]', 'Ảnh:', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    <input type="file" name="images1[]" multiple>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('type', 'Kiểu tour:', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                    {{ Form::select('type', ['Thám hiểm', 'Mạo hiểm', 'Chụp hình'], $diadanh->type, ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                {{ Form::submit('Lưu', array('class' => 'btn btn-info')) }} 
                {{ link_to_route('diadanh.show', 'Cancel', $diadanh->id, array('class' => 'btn btn-default')) }}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
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
    height:300,
  });
});
</script> 

@stop