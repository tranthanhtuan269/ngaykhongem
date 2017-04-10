@extends('layouts.app')

@section('content')

<div class="panel panel-primary main-content">
  	<div class="panel-heading">{{ $diadanh->ten_diadanh }}</div>
  	<div class="panel-body">            
            <div class="row">
                <div class="col-xs-12 col-md-12 show-detail"><?php echo $diadanh->mo_ta; ?></div>
            </div>
  	</div>
</div>

<p>{{ link_to_route('nhatkyhanhtrinh.index', 'Danh sách nhật ký') }} | {{ link_to_route('nhatkyhanhtrinh.create', 'Tạo nhật ký mới') }}</p>

@stop