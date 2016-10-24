@extends('layouts.app')

@section('content')

<h1>{{ $tinbds->tieu_de }}</h1>
<hr>

<p>{{ link_to_route('tinbds.create', 'Tạo tin mới') }}</p>

<div class="panel panel-primary">
  	<div class="panel-heading">{{ $tinbds->tieu_de }}</div>
  	<div class="panel-body">
  		
  	</div>
</div>

<p>{{ link_to_route('tinbds.index', 'Danh sách tin đăng') }}</p>

@stop