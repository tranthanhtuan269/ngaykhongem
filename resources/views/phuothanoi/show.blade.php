@extends('layouts.app')

@section('content')

<?php 
    $phuong_tien = '';
    $xe_dap = strpos('phuongtien' . $tour->phuong_tien, '1');
    $xe_may = strpos('phuongtien' . $tour->phuong_tien, '2');
    $o_to = strpos('phuongtien' . $tour->phuong_tien, '3');
    $may_bay = strpos('phuongtien' . $tour->phuong_tien, '4');
//    var_dump($xe_dap);die;
    if($xe_dap) $phuong_tien .= ' xe đạp,';
    if($xe_may) $phuong_tien .= ' xe máy,';
    if($o_to) $phuong_tien .= ' ô tô,';
    if($may_bay) $phuong_tien .= ' máy bay,';
    $phuong_tien = substr($phuong_tien, 0, strlen($phuong_tien) - 1);

?>

<div class="panel panel-primary main-content">
  	<div class="panel-heading">{{ $tour->ten_tour }}</div>
  	<div class="panel-body">
            <div class="row">
                <div class="col-xs-4 col-md-4 text-right">Ảnh</div>
                <div class="col-xs-8 col-md-8">
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
            <div class="row">
                <div class="col-xs-4 col-md-4 text-right">Ngày khởi hành</div>
                <div class="col-xs-8 col-md-8">{{substr($tour->ngay_khoi_hanh, 0, 10)}}</div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-4 text-right">Ngày kết thúc</div>
                <div class="col-xs-8 col-md-8">{{substr($tour->ngay_ket_thuc, 0, 10)}}</div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-4 text-right">Giá tour</div>
                <div class="col-xs-8 col-md-8">{{$tour->gia_tour}}</div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-4 text-right">Phương tiện</div>
                <div class="col-xs-8 col-md-8">{{ $phuong_tien }}</div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-4 text-right">Lịch trình</div>
                <div class="col-xs-8 col-md-8"><?php echo $tour->lich_trinh; ?></div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-4 text-right">Người dẫn</div>
                <div class="col-xs-8 col-md-8">{{$hdv->name}}</div>
            </div>
  	</div>
</div>

<p>{{ link_to_route('tour.index', 'Danh sách tour') }} | {{ link_to_route('tour.create', 'Tạo tour mới') }}</p>

@stop