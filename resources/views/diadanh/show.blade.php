@extends('layouts.app')

@section('content')

<div class="panel panel-primary main-content">
  	<div class="panel-heading">{{ $diadanh->ten_diadanh }}</div>
  	<div class="panel-body">            
            <div class="row">
                <div class="col-xs-12 col-md-12"><?php echo $diadanh->mo_ta; ?></div>
            </div>
  	</div>
</div>

<p>{{ link_to_route('diadanh.index', 'Danh sách địa danh') }} | {{ link_to_route('diadanh.create', 'Tạo địa danh mới') }}</p>

@stop