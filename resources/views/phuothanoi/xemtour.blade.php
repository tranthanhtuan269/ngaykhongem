@extends('layouts.app')

@section('fb_url')
    {{URL::to('/')}}/xem-tour/{{$tour->id}}
@endsection

@section('fb_image')
    <?php
    if(count($tour) > 0) {
        $temp = substr($tour->images,0,-1);
        $images = explode( ';', $temp );
    }
    echo URL::to('/') . '/images/' . $images[0];
    ?>
@endsection

@section('fb_title')
    <?php
        if(count($tour) > 0) {
            echo "chodatso.com";
        }
    ?>
@endsection

@section('fb_description')

@endsection


@section('content')
<div class="panel panel-default main-content xem-tour">
    <div class="panel-heading">
        <h3 class="panel-title">Xem tour</h3>
    </div>
    <div class="panel-body">
        <div class="row end-row">
            
        <?php 
            if(count($tour) <= 0) :
                echo "Không có tour nào được tìm thấy!";
            else :
//                var_dump($tour); die;
                $temp = substr($tour->images,0,-1);
                $images = explode( ';', $temp ); 
//                var_dump($images);die;
                
        ?>
            <div class="col-xs-12 col-md-12 col-sm-12 product">
                <div class="col-xs-4 col-md-4 col-sm-12 image-prod">
                    <a href="{{URL::to('/')}}/xem-tour/{{ $tour->id }}"><img src="{{ URL::to('/') }}/images/{{ $images[0] }}" class="img-thumbnail" alt="Responsive image"></a>
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
                    @if(!in_array($tour->id, $tourdats))
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <button class="btn btn-primary" id="dat-tour" data-accept-id="{{ $tour->id }}">Đặt tour</button>
                            <!-- Your share button code -->
                        </div>
                        <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Chia sẻ</a></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <?php
            endif
        ?>
    </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
        $("#dat-tour").click(function(){
            var _sefl = $(this);
        
            var id = $(this).attr('data-accept-id');

            var request = $.ajax({
                url: "{{ URL::to('/') }}/dat-tour/" + id,
                method: "POST",
                data: { 
                    "id" : id, 
                    "_token" : "{!! csrf_token() !!}",
                },
                dataType: "json"
            });

            request.done(function( msg ) {
                if(msg.code==1){
                    $.toast({
                        text: 'Bạn đã đặt tour thành công! <br />Chúng tôi sẽ gọi điện cho bạn để xác thực trong thời gian gần nhất! Xin cám ơn!', // Text that is to be shown in the toast
                        heading: 'Đặt tour thành công', // Optional heading to be shown on the toast
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
                    _sefl.hide();
                }else if(msg.code==0){
                    $.toast({
                        text: 'Hệ thống không tìm thấy Tour bạn muốn đăng kí. <br />Xin hãy liên hệ ban quản trị!', // Text that is to be shown in the toast
                        heading: 'Đăng kí không thành công', // Optional heading to be shown on the toast
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
                        text: 'Bạn phải đăng nhập để sử dụng dịch vụ này! Xin cám ơn!', // Text that is to be shown in the toast
                        heading: 'Đăng kí không thành công', // Optional heading to be shown on the toast
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
@endsection
