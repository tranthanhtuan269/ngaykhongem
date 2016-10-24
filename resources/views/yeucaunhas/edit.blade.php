@extends('layouts.app')

@section('content')

<!-- include libraries(jQuery, bootstrap) -->
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> 
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

<h1>Sửa Loại BDS</h1>
<hr>

<p>{{ link_to_route('loaibds.index', 'Danh sách Loại BDS') }}</p>

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

{{ Form::model($loaibds, array('method' => 'PATCH', 'route' => array('loaibds.update', $loaibds->id))) }}
    <div class="panel panel-primary">
        <div class="panel-heading">Loại BDS {{ $loaibds->name }}</div>
        <table class="table table-bordered">
            <tr>
                <td class="text-right">{{ Form::label('name', 'Tên Loại BDS:') }}</td>
                <td>{{ Form::text('name') }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">{{ Form::submit('Lưu', array('class' => 'btn btn-info')) }} {{ link_to_route('loaibds.show', 'Cancel', $loaibds->id, array('class' => 'btn btn-default')) }}</td>
            </tr>
        </table>
    </div>

{{ Form::close() }}

@stop