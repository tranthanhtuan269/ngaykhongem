@extends('layouts.app')

@section('content')
<div class="panel panel-default main-content xem-tour">
    <div class="panel-heading">
        <h3 class="panel-title">Danh sách tour</h3>
    </div>
    <div class="panel-body">
        <div class="row end-row">
            
        <?php 
//            var_dump($tourdats);die;
            if(count($tours) <= 0) :
                echo "Không có tour nào được tìm thấy!";
            else :
            foreach ($tours as $tour) {
                $temp = substr($tour->images,0,-1);
                $images = explode( ';', $temp ); 
                //var_dump($tinbds);
                
        ?>
            <div class="col-xs-12 col-md-12 col-sm-12 product">
                <div class="col-xs-4 col-md-4 col-sm-12 image-prod">
                    <a href="{{URL::to('/')}}/tour/{{ $tour->id }}"><img src="{{ URL::to('/') }}/images/{{ $images[0] }}" class="img-thumbnail" alt="Responsive image"></a>
                </div>
                <div class="col-xs-8 col-md-8 col-sm-12 detail-prod">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <span class="name-tour"> {{ $tour->ten_tour }} </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <span class="price-product"> Trọn gói: <span class="gia-tour">{{ $tour->gia_tour }} <?php if($tour->don_vi == 1){ echo "Triệu"; } else if($tour->don_vi == 0){ echo "Nghìn"; } ?></span> đồng.</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12 address-product">
                            Từ ngày <span class="date-start">{{substr(date_format(date_create($tour->ngay_khoi_hanh),"d/m/Y H:i:s"),0,10)}}</span> đến ngày <span class="date-start">{{substr(date_format(date_create($tour->ngay_ket_thuc),"d/m/Y H:i:s"),0,10)}}</span>.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <h4 class="title-product">
                                <?php echo $tour->lich_trinh; ?>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            {{ link_to_route('tour.show', 'Xem', array($tour->id), array('class' => 'btn btn-primary')) }}
                            {{ link_to_route('tour.edit', 'Sửa', array($tour->id), array('class' => 'btn btn-info')) }}
                            
                            {{ Form::open(array('method' => 'DELETE', 'route' => array('tour.destroy', $tour->id), 'class'=>'delete_btn' )) }}                       
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        <?php 
        }
        ?>
        </div>
        <div class="row text-center">
            {{ $tours->links() }}
        </div>
        <?php
            endif
        ?>
    </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
        
    });
</script>
@endsection
